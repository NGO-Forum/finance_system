<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Mpdf\Mpdf;
use Mpdf\HTMLParserMode;


class PurchaseRequestController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        $query = PurchaseRequest::with([
            'preparer',
            'reviewer',
            'approver',
        ])->latest();

        // Search
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('purchase_no', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhere('donor', 'like', "%{$search}%")
                    ->orWhere('donor_code', 'like', "%{$search}%")
                    ->orWhere('budget_line', 'like', "%{$search}%");
            });
        }

        // Status Filter
        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        // Permission
        if ($user->role?->name !== 'Admin') {
            $query->where('prepared_by', $user->id);
        }

        $purchaseRequests = $query
            ->paginate(10);

        return view(
            'purchase-requests.index',
            compact('purchaseRequests')
        );
    }

    public function create()
    {
        $user = auth()->user();

        $lastPurchase = PurchaseRequest::orderByDesc('id')->first();

        if ($lastPurchase) {

            $lastNumber = (int) substr($lastPurchase->purchase_no, -5);

            $nextNumber = $lastNumber + 1;
        } else {

            $nextNumber = 1;
        }

        $purchaseNo = sprintf(
            'PR-%s-%05d',
            date('Y'),
            $nextNumber
        );

        return view(
            'purchase-requests.create',
            compact(
                'purchaseNo',
                'user'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'request_date' => 'required|date',

            'donor' => 'nullable|string|max:255',

            'donor_code' => 'nullable|string|max:255',

            'budget_line' => 'nullable|string|max:255',

            'purpose' => 'required|string',

            'reviewed_by' => 'nullable|exists:users,id',

            'approved_by' => 'nullable|exists:users,id',

            // Purchase Items
            'items' => 'required|array|min:1',

            'items.*.item_name' => 'required|string|max:255',

            'items.*.specification' => 'nullable|string',

            'items.*.unit' => 'nullable|string|max:50',

            'items.*.unit_cost' => 'required|numeric|min:0',

            'items.*.quantity' => 'required|numeric|min:1',

        ]);

        try {

            DB::transaction(function () use ($request) {

                $lastPurchase = PurchaseRequest::orderByDesc('id')->first();

                if ($lastPurchase) {

                    $lastNumber = (int) substr($lastPurchase->purchase_no, -5);

                    $nextNumber = $lastNumber + 1;
                } else {

                    $nextNumber = 1;
                }

                $purchaseNo = sprintf(
                    'PR-%s-%05d',
                    date('Y'),
                    $nextNumber
                );


                $purchaseRequest = PurchaseRequest::create([

                    'purchase_no' => $purchaseNo,

                    'request_date' => $request->request_date,

                    'donor' => $request->donor,

                    'donor_code' => $request->donor_code,

                    'budget_line' => $request->budget_line,

                    'purpose' => $request->purpose,

                    'prepared_by' => auth()->id(),

                    'reviewed_by' => $request->reviewed_by,

                    'approved_by' => $request->approved_by,

                    'grand_total' => 0,

                    'status' => 'Pending Manager Approval',

                ]);

                $grandTotal = 0;

                foreach ($request->items as $item) {

                    $unitCost = (float) $item['unit_cost'];

                    $quantity = (float) $item['quantity'];

                    $total = $unitCost * $quantity;

                    $grandTotal += $total;

                    $purchaseRequest->items()->create([

                        'item_name'     => $item['item_name'],

                        'specification' => $item['specification'] ?? null,

                        'unit'          => $item['unit'] ?? null,

                        'unit_cost'     => $unitCost,

                        'quantity'      => $quantity,

                        'total'         => $total,

                    ]);
                }



                $purchaseRequest->update([

                    'grand_total' => $grandTotal,

                ]);



                // $reviewer = User::find($purchaseRequest->reviewed_by);

                // if ($reviewer && $reviewer->email) {
                //     Mail::to($reviewer->email)
                //         ->send(new PurchaseRequestNotification(
                //             $purchaseRequest,
                //             $reviewer,
                //             'reviewer'
                //         ));
                // }

            });
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Failed to create Purchase Request. ' . $e->getMessage()
                );
        }

        return redirect()
            ->route('purchase-requests.index')
            ->with(
                'success',
                'Purchase Request created successfully.'
            );
    }

    public function show(PurchaseRequest $purchaseRequest)
    {
        $user = auth()->user();

        if (!in_array($user->role?->name, ['Admin', 'Finance'])) {

            if (
                $purchaseRequest->prepared_by != $user->id &&
                $purchaseRequest->reviewed_by != $user->id &&
                $purchaseRequest->approved_by != $user->id
            ) {
                abort(403, 'Unauthorized.');
            }
        }

        $purchaseRequest->load([
            'preparer',
            'reviewer',
            'approver',
            'items',
        ]);

        return view(
            'purchase-requests.show',
            compact('purchaseRequest')
        );
    }

    public function edit(PurchaseRequest $purchaseRequest)
    {
        $user = auth()->user();

        if (!in_array($user->role?->name, ['Admin', 'Finance'])) {

            if ($purchaseRequest->prepared_by != $user->id) {
                abort(403, 'Unauthorized.');
            }
        }

        if (in_array($purchaseRequest->status, [
            'Approved',
            'Cancelled',
        ])) {

            return redirect()
                ->route('purchase-requests.index')
                ->with(
                    'error',
                    'This Purchase Request cannot be edited.'
                );
        }

        $purchaseRequest->load([
            'items',
            'preparer',
            'reviewer',
            'approver',
        ]);

        $managers = User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('name', 'Manager');
            })
            ->orderBy('name')
            ->get();

        $finances = User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('name', 'Finance');
            })
            ->orderBy('name')
            ->get();

        return view(
            'purchase-requests.edit',
            compact(
                'purchaseRequest',
                'managers',
                'finances',
                'user'
            )
        );
    }

    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        $request->validate([

            'request_date' => 'required|date',

            'donor' => 'nullable|string|max:255',

            'donor_code' => 'nullable|string|max:255',

            'budget_line' => 'nullable|string|max:255',

            'purpose' => 'required|string',

            'reviewed_by' => 'nullable|exists:users,id',

            'approved_by' => 'nullable|exists:users,id',

            // Purchase Items
            'items' => 'required|array|min:1',

            'items.*.item_name' => 'required|string|max:255',

            'items.*.specification' => 'nullable|string',

            'items.*.unit' => 'nullable|string|max:50',

            'items.*.unit_cost' => 'required|numeric|min:0',

            'items.*.quantity' => 'required|numeric|min:1',

        ]);

        if (
            auth()->user()->role?->name != 'Admin' &&
            $purchaseRequest->prepared_by != auth()->id()
        ) {
            abort(403, 'Unauthorized.');
        }

        DB::transaction(function () use ($request, $purchaseRequest) {

            $purchaseRequest->update([

                'request_date' => $request->request_date,

                'donor' => $request->donor,

                'donor_code' => $request->donor_code,

                'budget_line' => $request->budget_line,

                'purpose' => $request->purpose,

                'reviewed_by' => $request->reviewed_by,

                'approved_by' => $request->approved_by,

                // Reset workflow after editing
                'status' => 'Pending Manager Approval',

                'reviewed_at' => null,

                'approved_at' => null,

            ]);

            $purchaseRequest->items()->delete();

            $grandTotal = 0;

            foreach ($request->items as $item) {

                $unitCost = (float) $item['unit_cost'];

                $quantity = (float) $item['quantity'];

                $total = $unitCost * $quantity;

                $grandTotal += $total;

                $purchaseRequest->items()->create([

                    'item_name'     => $item['item_name'],

                    'specification' => $item['specification'] ?? null,

                    'unit'          => $item['unit'] ?? null,

                    'unit_cost'     => $unitCost,

                    'quantity'      => $quantity,

                    'total'         => $total,

                ]);
            }

            $purchaseRequest->update([

                'grand_total' => $grandTotal,

            ]);
        });

        return redirect()
            ->route('purchase-requests.index', $purchaseRequest)
            ->with(
                'success',
                'Purchase Request updated successfully.'
            );
    }

    public function destroy(PurchaseRequest $purchaseRequest)
    {
        $user = auth()->user();


        if (
            !in_array($user->role?->name, ['Admin', 'Finance']) &&
            $purchaseRequest->prepared_by != $user->id
        ) {
            abort(403, 'Unauthorized.');
        }

        if (in_array($purchaseRequest->status, [
            'Approved',
            'Pending Finance Approval',
        ])) {

            return redirect()
                ->route('purchase-requests.index')
                ->with(
                    'error',
                    'This Purchase Request cannot be deleted.'
                );
        }

        DB::transaction(function () use ($purchaseRequest) {

            /*
        |--------------------------------------------------------------------------
        | Delete Signature
        |--------------------------------------------------------------------------
        */

            if (
                $purchaseRequest->prepared_signature &&
                Storage::disk('public')->exists($purchaseRequest->prepared_signature)
            ) {
                Storage::disk('public')->delete(
                    $purchaseRequest->prepared_signature
                );
            }


            if (
                $purchaseRequest->reviewer_signature &&
                Storage::disk('public')->exists($purchaseRequest->reviewer_signature)
            ) {
                Storage::disk('public')->delete(
                    $purchaseRequest->reviewer_signature
                );
            }


            if (
                $purchaseRequest->approver_signature &&
                Storage::disk('public')->exists($purchaseRequest->approver_signature)
            ) {
                Storage::disk('public')->delete(
                    $purchaseRequest->approver_signature
                );
            }


            $purchaseRequest->delete();
        });

        return redirect()
            ->route('purchase-requests.index')
            ->with(
                'success',
                'Purchase Request deleted successfully.'
            );
    }


    public function exportPdf(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->load([
            'items',
            'preparer.department',
            'reviewer',
            'approver',
        ]);

        $html = view('purchase-requests.pdf', compact('purchaseRequest'))->render();

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

            $mpdf->SetTitle('Purchase Request');

            $mpdf->SetAuthor(config('app.name'));

            $mpdf->SetDisplayMode('fullpage');

            // Watermark
            $logo = public_path('images/logo.png');

            if (file_exists($logo)) {

                $mpdf->SetWatermarkImage(
                    $logo,
                    0.05,
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
                    'Purchase_Request_' . $purchaseRequest->purchase_no . '.pdf',
                    \Mpdf\Output\Destination::STRING_RETURN
                ),
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="Purchase_Request_' . $purchaseRequest->purchase_no . '.pdf"',
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
