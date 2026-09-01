<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DsaClaim;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DsaTravel;
use App\Models\DsaClaimItem;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Mpdf\HTMLParserMode;
use Mpdf\Output\Destination;

class DsaClaimController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = DsaClaim::with([
            'user',
            'department',
        ])->latest();

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('claim_no', 'like', "%{$search}%")
                    ->orWhere('budget_code', 'like', "%{$search}%")
                    ->orWhere('donor', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($qq) use ($search) {
                        $qq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Department Filter
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        // Permission
        if ($user->role?->name !== 'Admin') {
            $query->where('user_id', $user->id);
        }

        $claims = $query->paginate(10);

        return view('dsa-claims.index', compact('claims'));
    }

    public function create()
    {
        return view('dsa-claims.create', [

            'claimNo' => $this->generateClaimNo(),

            'departments' => Department::orderBy('name')->get(),

            'users' => User::orderBy('name')->get(),

        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'date_requested' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'donor_code' => 'nullable|string|max:255',
            'budget_code' => 'nullable|string|max:255',
            'donor' => 'nullable|string|max:255',
            'purpose_of_travel' => 'nullable|string',

            'travel_date.*' => 'nullable|date',
            'from_location.*' => 'nullable|string|max:255',
            'to_location.*' => 'nullable|string|max:255',
            'purpose.*' => 'nullable|string',
            'departure_time.*' => 'nullable',
            'arrival_time.*' => 'nullable',
            'km.*' => 'nullable|numeric|min:0',

            'expense_date.*' => 'nullable|date',
            'breakfast.*' => 'nullable|numeric|min:0',
            'lunch.*' => 'nullable|numeric|min:0',
            'dinner.*' => 'nullable|numeric|min:0',
            'accommodation.*' => 'nullable|numeric|min:0',
            'transport.*' => 'nullable|numeric|min:0',
            'incident.*' => 'nullable|numeric|min:0',

            'note' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            $claim = DsaClaim::create([

                'claim_no' => $this->generateClaimNo(),

                'date_requested' => $request->date_requested,

                'user_id' => auth()->id(),

                'department_id' => $request->department_id,

                'donor_code' => $request->donor_code,

                'budget_code' => $request->budget_code,

                'donor' => $request->donor,

                'purpose_of_travel' => $request->purpose_of_travel,

                'note' => $request->note,

                'grand_total' => 0,

                'status' => 'Draft',

            ]);

            /*
        |--------------------------------------------------------------------------
        | Save Travel Information
        |--------------------------------------------------------------------------
        */

            if ($request->travel_date) {

                foreach ($request->travel_date as $key => $date) {

                    if (!$date) {
                        continue;
                    }

                    DsaTravel::create([

                        'dsa_claim_id' => $claim->id,

                        'travel_date' => $date,

                        'from_location' => $request->from_location[$key] ?? null,

                        'to_location' => $request->to_location[$key] ?? null,

                        'purpose' => $request->purpose[$key] ?? null,

                        'departure_time' => $request->departure_time[$key] ?? null,

                        'km' => $request->km[$key] ?? null,

                        'arrival_time' => $request->arrival_time[$key] ?? null,

                    ]);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Save Expense Items
        |--------------------------------------------------------------------------
        */

            $grandTotal = 0;

            if ($request->expense_date) {

                foreach ($request->expense_date as $key => $date) {

                    if (!$date) {
                        continue;
                    }

                    $breakfast = $request->breakfast[$key] ?? 0;
                    $lunch = $request->lunch[$key] ?? 0;
                    $dinner = $request->dinner[$key] ?? 0;
                    $accommodation = $request->accommodation[$key] ?? 0;
                    $transport = $request->transport[$key] ?? 0;
                    $incident = $request->incident[$key] ?? 0;

                    $total =
                        $breakfast +
                        $lunch +
                        $dinner +
                        $accommodation +
                        $transport +
                        $incident;

                    DsaClaimItem::create([

                        'dsa_claim_id' => $claim->id,

                        'expense_date' => $date,

                        'breakfast' => $breakfast,

                        'lunch' => $lunch,

                        'dinner' => $dinner,

                        'accommodation' => $accommodation,

                        'transport' => $transport,

                        'incident' => $incident,

                        'total' => $total,

                    ]);

                    $grandTotal += $total;
                }
            }

            $claim->update([
                'grand_total' => $grandTotal,
            ]);
        });

        return redirect()
            ->route('dsa-claims.index')
            ->with('success', 'DSA Claim created successfully.');
    }

    public function show(DsaClaim $dsaClaim)
    {
        $dsaClaim->load([
            'user',
            'department',
            'travels',
            'items',
        ]);

        return view('dsa-claims.show', compact('dsaClaim'));
    }

    public function edit(DsaClaim $dsaClaim)
    {
        $dsaClaim->load([
            'travels',
            'items',
        ]);

        return view('dsa-claims.edit', [
            'claim' => $dsaClaim,
            'claimNo' => $dsaClaim->claim_no,
            'departments' => Department::orderBy('name')->get(),
            'users' => User::orderBy('name')->get(),
        ]);
    }


    public function update(Request $request, DsaClaim $dsaClaim)
    {
        $request->validate([
            'date_requested' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'donor_code' => 'nullable|string|max:255',
            'budget_code' => 'nullable|string|max:255',
            'donor' => 'nullable|string|max:255',
            'purpose_of_travel' => 'nullable|string',

            'travel_date.*' => 'nullable|date',
            'from_location.*' => 'nullable|string|max:255',
            'to_location.*' => 'nullable|string|max:255',
            'purpose.*' => 'nullable|string',
            'departure_time.*' => 'nullable',
            'arrival_time.*' => 'nullable',
            'km.*' => 'nullable|numeric|min:0',

            'expense_date.*' => 'nullable|date',
            'breakfast.*' => 'nullable|numeric|min:0',
            'lunch.*' => 'nullable|numeric|min:0',
            'dinner.*' => 'nullable|numeric|min:0',
            'accommodation.*' => 'nullable|numeric|min:0',
            'transport.*' => 'nullable|numeric|min:0',
            'incident.*' => 'nullable|numeric|min:0',

            'note' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $dsaClaim) {

            $dsaClaim->update([

                'date_requested' => $request->date_requested,

                'department_id' => $request->department_id,

                'donor_code' => $request->donor_code,

                'budget_code' => $request->budget_code,

                'donor' => $request->donor,

                'purpose_of_travel' => $request->purpose_of_travel,

                'note' => $request->note,

            ]);


            $dsaClaim->travels()->delete();

            $dsaClaim->items()->delete();


            if ($request->travel_date) {

                foreach ($request->travel_date as $key => $date) {

                    if (!$date) {
                        continue;
                    }

                    DsaTravel::create([

                        'dsa_claim_id' => $dsaClaim->id,

                        'travel_date' => $date,

                        'from_location' => $request->from_location[$key] ?? null,

                        'to_location' => $request->to_location[$key] ?? null,

                        'purpose' => $request->purpose[$key] ?? null,

                        'km' => $request->km[$key] ?? null,

                        'departure_time' => $request->departure_time[$key] ?? null,

                        'arrival_time' => $request->arrival_time[$key] ?? null,

                    ]);
                }
            }

            $grandTotal = 0;

            if ($request->expense_date) {

                foreach ($request->expense_date as $key => $date) {

                    if (!$date) {
                        continue;
                    }

                    $breakfast = $request->breakfast[$key] ?? 0;
                    $lunch = $request->lunch[$key] ?? 0;
                    $dinner = $request->dinner[$key] ?? 0;
                    $accommodation = $request->accommodation[$key] ?? 0;
                    $transport = $request->transport[$key] ?? 0;
                    $incident = $request->incident[$key] ?? 0;

                    $total =
                        $breakfast +
                        $lunch +
                        $dinner +
                        $accommodation +
                        $transport +
                        $incident;

                    DsaClaimItem::create([

                        'dsa_claim_id' => $dsaClaim->id,

                        'expense_date' => $date,

                        'breakfast' => $breakfast,

                        'lunch' => $lunch,

                        'dinner' => $dinner,

                        'accommodation' => $accommodation,

                        'transport' => $transport,

                        'incident' => $incident,

                        'total' => $total,

                    ]);

                    $grandTotal += $total;
                }
            }

            $dsaClaim->update([
                'grand_total' => $grandTotal,
            ]);
        });

        return redirect()
            ->route('dsa-claims.index')
            ->with('success', 'DSA Claim updated successfully.');
    }


    public function destroy(DsaClaim $dsaClaim)
    {
        DB::transaction(function () use ($dsaClaim) {

            // Delete child records
            $dsaClaim->travels()->delete();
            $dsaClaim->items()->delete();

            // Delete main claim
            $dsaClaim->delete();
        });

        return redirect()
            ->route('dsa-claims.index')
            ->with('success', 'DSA Claim deleted successfully.');
    }


    private function generateClaimNo()
    {
        $last = DsaClaim::latest()->first();

        if (!$last) {
            return 'DSA-' . date('Y') . '-0001';
        }

        $number = (int) substr($last->claim_no, -4);

        $number++;

        return 'DSA-' . date('Y') . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function exportPdf(DsaClaim $dsaClaim)
    {
        $dsaClaim->load([
            'department',
            'travels',
            'items',
            'verifier',
            'payer',
            'receiver',
        ]);

        $html = view('dsa-claims.pdf', compact('dsaClaim'))->render();

        // Replace non-breaking spaces
        $html = str_replace("\xc2\xa0", ' ', $html);

        try {

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_left'   => 6,
                'margin_right'  => 6,
                'margin_top'    => 6,
                'margin_bottom' => 6,
                'margin_header' => 3,
                'margin_footer' => 3,
                'autoScriptToLang' => true,
                'autoLangToFont'   => true,
                'tempDir' => storage_path('app/mpdf'),
            ]);

            $mpdf->SetTitle('DSA Claim Form');

            $mpdf->SetAuthor(config('app.name'));

            $mpdf->SetDisplayMode('fullpage');

            // Watermark Logo
            $logo = public_path('images/logo.png');

            if (file_exists($logo)) {

                $mpdf->SetWatermarkImage(
                    $logo,
                    0.06,
                    [120, 100],
                    [45, 70]
                );

                $mpdf->showWatermarkImage = true;
            }

            $mpdf->WriteHTML(
                $html,
                HTMLParserMode::DEFAULT_MODE
            );

            return response(
                $mpdf->Output(
                    'DSA_Claim_' . $dsaClaim->claim_no . '.pdf',
                    Destination::STRING_RETURN
                ),
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="DSA_Claim_' . $dsaClaim->claim_no . '.pdf"',
                ]
            );
        } catch (\Throwable $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ], 500);
        }
    }


    public function templatePdf()
    {
        $html = view('dsa-claims.template')->render();

        // Remove non-breaking spaces
        $html = str_replace("\xc2\xa0", ' ', $html);

        try {

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',

                'margin_left'   => 6,
                'margin_right'  => 6,
                'margin_top'    => 6,
                'margin_bottom' => 6,

                'margin_header' => 3,
                'margin_footer' => 3,

                'autoScriptToLang' => true,
                'autoLangToFont'   => true,

                'tempDir' => storage_path('app/mpdf'),
            ]);

            $mpdf->SetTitle(
                'DSA Claim Form - FM02-06'
            );

            $mpdf->SetAuthor(
                config('app.name')
            );

            $mpdf->SetDisplayMode('fullpage');


            $logo = public_path('images/logo.png');

            if (file_exists($logo)) {

                $mpdf->SetWatermarkImage(
                    $logo,
                    0.06,
                    [120, 100],
                    [45, 70]
                );

                $mpdf->showWatermarkImage = true;
            }


            $mpdf->WriteHTML(
                $html,
                HTMLParserMode::DEFAULT_MODE
            );

            return response(
                $mpdf->Output(
                    'DSA_Claim_FM02-06_Template.pdf',
                    Destination::STRING_RETURN
                ),
                200,
                [
                    'Content-Type' => 'application/pdf',

                    'Content-Disposition' =>
                    'inline; filename="DSA_Claim_FM02-06_Template.pdf"',
                ]
            );
        } catch (\Throwable $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ], 500);
        }
    }
}
