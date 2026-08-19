<?php

namespace App\Http\Controllers;

use App\Models\AllowanceForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DonorLogo;
use Mpdf\Mpdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AllowanceFormController extends Controller
{
    /**
     * Display a listing of allowance forms.
     */
    public function index(Request $request)
    {
        $query = AllowanceForm::with(['participants', 'user'])->latest();

        // Admin can see all, others only their own records
        if (auth()->user()->role !== 'Admin') {
            $query->where('created_by', auth()->id());
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('allowance_no', 'like', '%' . $request->search . '%')
                    ->orWhere('activity', 'like', '%' . $request->search . '%')
                    ->orWhere('venue', 'like', '%' . $request->search . '%')
                    ->orWhere('donor', 'like', '%' . $request->search . '%')
                    ->orWhere('budget_code', 'like', '%' . $request->search . '%');
            });
        }

        $allowances = $query->paginate(10);

        return view('allowance_forms.index', compact('allowances'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $donorLogos = DonorLogo::orderBy('name')->get();

        return view('allowance_forms.create', [
            'donorLogos' => $donorLogos,
        ]);
    }

    /**
     * Store new allowance form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity'      => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'venue'         => 'nullable|string|max:255',
            'program' => 'required|in:RITI,SACHAS,MACOR,PALI',
            'donor'         => 'nullable|string|max:255',
            'donor_code'    => 'nullable|string|max:255',
            'budget_code'   => 'nullable|string|max:255',

            'participants' => 'required|array|min:1',
            'participants.*.costs' => 'required|array',

            'dates' => 'required|array|min:1',
            'dates.*' => 'required|string|max:100',

            'donor_logo_ids' => 'nullable|array',
            'donor_logo_ids.*' => 'exists:donor_logos,id',

            'participants.*.name'         => 'required|string|max:255',
            'participants.*.gender'       => 'nullable|string|max:10',
            'participants.*.organization' => 'nullable|string|max:255',
            'participants.*.position'     => 'nullable|string|max:255',
            'participants.*.province'     => 'nullable|string|max:255',
            'participants.*.distance'     => 'nullable|numeric|min:0',


            'participants.*.breakfast'        => 'nullable|numeric|min:0',
            'participants.*.lunch'            => 'nullable|numeric|min:0',
            'participants.*.dinner'           => 'nullable|numeric|min:0',
            'participants.*.accommodation'    => 'nullable|numeric|min:0',
            'participants.*.taxi'             => 'nullable|numeric|min:0',
            'participants.*.local_transport'  => 'nullable|numeric|min:0',
            'participants.*.other'            => 'nullable|numeric|min:0',
            'participants.*.total'            => 'nullable|numeric|min:0',
            'participants.*.remarks'          => 'nullable|string',
        ]);

        $nextNumber = (AllowanceForm::max('id') ?? 0) + 1;

        $allowanceNo = 'AF-' .
            date('Y') .
            '-' .
            str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $dates = [];

        $current = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        while ($current->lte($end)) {
            $dates[] = $current->format('Y-m-d');
            $current->addDay();
        }

        $allowance = AllowanceForm::create([
            'allowance_no' => $allowanceNo,
            'activity'      => $request->activity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'venue'         => $request->venue,
            'program' => $request->program,
            'donor'         => $request->donor,
            'donor_code'    => $request->donor_code,
            'budget_code'   => $request->budget_code,
            'dates'         => $dates,
            'created_by'    => Auth::id(),
        ]);

        $allowance->donorLogos()->sync(
            $request->donor_logo_ids ?? []
        );


        foreach ($request->participants as $participant) {

            $allowance->participants()->create([

                'name' => $participant['name'] ?? '',

                'gender' => $participant['gender'] ?? null,

                'organization' => $participant['organization'] ?? null,

                'position' => $participant['position'] ?? null,

                'province' => $participant['province'] ?? null,

                'distance' => $participant['distance'] ?? 0,

                'breakfast' => $participant['breakfast'] ?? 0,

                'lunch' => $participant['lunch'] ?? 0,

                'dinner' => $participant['dinner'] ?? 0,

                'costs' => $participant['costs'] ?? [],

                'accommodation' => $participant['accommodation'] ?? 0,

                'taxi' => $participant['taxi'] ?? 0,

                'local_transport' => $participant['local_transport'] ?? 0,

                'other' => $participant['other'] ?? 0,

                'total' => $participant['total'] ?? 0,

                'remarks' => $participant['remarks'] ?? null,

            ]);
        }

        return redirect()
            ->route('allowance-forms.index')
            ->with('success', 'Allowance form created successfully.');
    }

    /**
     * Display allowance form.
     */
    public function show(AllowanceForm $allowanceForm)
    {
        $allowanceForm->load([
            'participants',
            'donorLogos',
        ]);

        return view('allowance_forms.show', [
            'allowanceForm' => $allowanceForm,
            'dates' => $allowanceForm->dates ?? [],
            'participants' => $allowanceForm->participants,
        ]);
    }

    /**
     * Edit allowance form.
     */
    public function edit(AllowanceForm $allowanceForm)
    {
        $allowanceForm->load([
            'participants',
            'donorLogos',
        ]);

        $donorLogos = DonorLogo::orderBy('name')->get();

        return view('allowance_forms.edit', [
            'allowanceForm' => $allowanceForm,

            'donorLogos' => $donorLogos,

            // IDs of selected donors
            'selectedDonors' => old(
                'donor_logo_ids',
                $allowanceForm->donorLogos->pluck('id')->toArray()
            ),

            'dates' => old('dates', $allowanceForm->dates ?? ['Day 1']),

            'participants' => old(
                'participants',
                $allowanceForm->participants->map(function ($participant) {
                    return [
                        'name' => $participant->name,
                        'organization' => $participant->organization,
                        'position' => $participant->position,
                        'gender' => $participant->gender,
                        'province' => $participant->province,
                        'distance' => $participant->distance,
                        'remarks' => $participant->remarks,
                        'costs' => $participant->costs ?? [],

                        'breakfast' => $participant->breakfast,
                        'lunch' => $participant->lunch,
                        'dinner' => $participant->dinner,
                        'accommodation' => $participant->accommodation,
                        'taxi' => $participant->taxi,
                        'local_transport' => $participant->local_transport,
                        'other' => $participant->other,
                        'total' => $participant->total,
                    ];
                })->values()->toArray()
            ),
        ]);
    }

    /**
     * Update allowance form.
     */
    public function update(Request $request, AllowanceForm $allowanceForm)
    {
        $validated = $request->validate([
            'activity' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'venue' => 'nullable|string|max:255',
            'program' => 'required|in:RITI,SACHAS,MACOR,PALI',
            'donor_code' => 'nullable|string|max:255',
            'donor' => 'nullable|string|max:255',
            'budget_code' => 'nullable|string|max:255',

            'dates' => 'required|array|min:1',
            'dates.*' => 'required|string|max:100',

            'donor_logo_ids' => 'nullable|array',
            'donor_logo_ids.*' => 'exists:donor_logos,id',

            'participants' => 'required|array|min:1',
            'participants.*.name' => 'required|string|max:255',
            'participants.*.gender' => 'nullable|string|max:10',
            'participants.*.organization' => 'nullable|string|max:255',
            'participants.*.position' => 'nullable|string|max:255',
            'participants.*.province' => 'nullable|string|max:255',
            'participants.*.distance' => 'nullable|numeric',
            'participants.*.remarks' => 'nullable|string',

            'participants.*.costs' => 'required|array',

            'participants.*.breakfast' => 'nullable|numeric',
            'participants.*.lunch' => 'nullable|numeric',
            'participants.*.dinner' => 'nullable|numeric',
            'participants.*.accommodation' => 'nullable|numeric',
            'participants.*.taxi' => 'nullable|numeric',
            'participants.*.local_transport' => 'nullable|numeric',
            'participants.*.other' => 'nullable|numeric',
            'participants.*.total' => 'nullable|numeric',
        ]);

        $dates = [];

        $current = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);

        while ($current->lte($end)) {
            $dates[] = $current->format('Y-m-d');
            $current->addDay();
        }

        $allowanceForm->update([
            'activity' => $validated['activity'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'program' => $validated['program'],
            'venue' => $validated['venue'] ?? null,
            'donor_code' => $validated['donor_code'] ?? null,
            'donor' => $validated['donor'] ?? null,
            'budget_code' => $validated['budget_code'] ?? null,
            'dates' => $dates,
        ]);

        $allowanceForm->donorLogos()->sync(
            $request->donor_logo_ids ?? []
        );

        // Remove old participants
        $allowanceForm->participants()->delete();

        // Create updated participants
        foreach ($validated['participants'] as $participant) {

            $allowanceForm->participants()->create([
                'name' => $participant['name'],
                'gender' => $participant['gender'] ?? null,
                'organization' => $participant['organization'] ?? null,
                'position' => $participant['position'] ?? null,
                'province' => $participant['province'] ?? null,
                'distance' => $participant['distance'] ?? 0,
                'remarks' => $participant['remarks'] ?? null,

                'costs' => $participant['costs'] ?? [],

                'breakfast' => $participant['breakfast'] ?? 0,
                'lunch' => $participant['lunch'] ?? 0,
                'dinner' => $participant['dinner'] ?? 0,
                'accommodation' => $participant['accommodation'] ?? 0,
                'taxi' => $participant['taxi'] ?? 0,
                'local_transport' => $participant['local_transport'] ?? 0,
                'other' => $participant['other'] ?? 0,
                'total' => $participant['total'] ?? 0,
            ]);
        }

        return redirect()
            ->route('allowance-forms.index')
            ->with('success', 'Allowance form updated successfully.');
    }

    /**
     * Delete allowance form.
     */
    public function destroy(AllowanceForm $allowanceForm)
    {
        $allowanceForm->delete();

        return redirect()
            ->route('allowance-forms.index')
            ->with('success', 'Allowance form deleted successfully.');
    }

    public function exportPdf(AllowanceForm $allowanceForm)
    {
        $allowanceForm->load([
            'participants',
            'donorLogos',
            'user.department',
        ]);

        $html = view('allowance_forms.PDF', [
            'allowanceForm' => $allowanceForm,
            'dates'          => $allowanceForm->dates ?? [],
            'participants'   => $allowanceForm->participants,
        ])->render();

        // Remove non-breaking spaces
        $html = str_replace("\xC2\xA0", ' ', $html);

        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',

            'margin_left' => 6,
            'margin_right' => 6,
            'margin_top' => 2,
            'margin_bottom' => 2,

            'autoScriptToLang' => true,
            'autoLangToFont' => true,

            'tempDir' => storage_path('app/mpdf'),

            'fontDir' => array_merge($fontDirs, [
                public_path('fonts'),
            ]),

            'fontdata' => $fontData + [
                'khmer' => [
                    'R' => 'Battambang-Regular.ttf',
                    'B' => 'Battambang-Bold.ttf',
                ],
            ],

            'default_font' => 'khmer',
        ]);

        $mpdf->SetWatermarkImage(
            public_path('images/logo.png'),
            0.05,
            [150, 100],   // width, height (mm)
            [60, 55]      // x, y position (mm)
        );

        $mpdf->showWatermarkImage = true;

        $mpdf->SetTitle('Allowance Form');
        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output(
                'Allowance-' . $allowanceForm->allowance_no . '.pdf',
                'S'
            ),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="Allowance-' . $allowanceForm->allowance_no . '.pdf"',
            ]
        );
    }

    public function print(AllowanceForm $allowance)
    {
        // Load relationships
        $allowance->load([
            'participants',
            'donorLogos',
            'user.department',
        ]);

        $participants = $allowance->participants;

        // Generate dates from start_date to end_date
        $dates = [];

        if ($allowance->start_date && $allowance->end_date) {
            $period = CarbonPeriod::create(
                Carbon::parse($allowance->start_date),
                Carbon::parse($allowance->end_date)
            );

            foreach ($period as $date) {
                $dates[] = $date->format('Y-m-d');
            }
        }

        return view('allowance_forms.Print', [
            'allowanceForm' => $allowance,
            'participants'  => $participants,
            'dates'         => $dates,
        ]);
    }

}
