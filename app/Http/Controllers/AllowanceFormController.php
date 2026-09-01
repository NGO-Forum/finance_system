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
use App\Models\AttendantList;

class AllowanceFormController extends Controller
{
    /**
     * Display a listing of allowance forms.
     */
    public function index(Request $request)
    {
        $query = AllowanceForm::with([
            'participants',
            'user',
        ])->latest();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'allowance_no',
                    'like',
                    '%' . $request->search . '%'
                )
                    ->orWhere(
                        'activity',
                        'like',
                        '%' . $request->search . '%'
                    )
                    ->orWhere(
                        'venue',
                        'like',
                        '%' . $request->search . '%'
                    )
                    ->orWhere(
                        'donor',
                        'like',
                        '%' . $request->search . '%'
                    )
                    ->orWhere(
                        'budget_code',
                        'like',
                        '%' . $request->search . '%'
                    );
            });
        }

        $allowances = $query->paginate(10);

        return view(
            'allowance_forms.index',
            compact('allowances')
        );
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $donorLogos = DonorLogo::orderBy('name')->get();

        $attendantLists = AttendantList::query()
            ->whereDoesntHave('allowanceForms')
            ->withCount([
                'registrations' => function ($query) {
                    $query->where('dsa', 'Need');
                },
            ])
            ->latest('start_date')
            ->get();

        return view(
            'allowance_forms.create',
            compact(
                'attendantLists',
                'donorLogos'
            )
        );
    }

    /**
     * Store new allowance form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'attendant_list_id' => [
                'nullable',
                'exists:attendant_lists,id',
                'unique:allowance_forms,attendant_list_id',
            ],
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
            'attendant_list_id' => $request->attendant_list_id,
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
    /**
     * Edit allowance form.
     */
    public function edit(AllowanceForm $allowanceForm)
    {

        $allowanceForm->load([
            'participants',
            'donorLogos',
            'attendantList',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Attendant Lists
        |--------------------------------------------------------------------------
        */

        $attendantLists = AttendantList::query()
            ->withCount([
                'registrations' => function ($query) {
                    $query->where('dsa', 'Need');
                },
            ])
            ->latest('start_date')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Donor Logos
        |--------------------------------------------------------------------------
        */

        $donorLogos = DonorLogo::query()
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Selected Donors
        |--------------------------------------------------------------------------
        */

        $selectedDonors = old(
            'donor_logo_ids',
            $allowanceForm
                ->donorLogos
                ->pluck('id')
                ->toArray()
        );


        /*
        |--------------------------------------------------------------------------
        | Participants
        |--------------------------------------------------------------------------
        */

        $participants = old(
            'participants',

            $allowanceForm->participants
                ->map(function ($participant) {

                    return [

                        /*
                    |--------------------------------------------------------------------------
                    | Keep relationship ID
                    |--------------------------------------------------------------------------
                    */

                        'registration_id' =>
                        $participant->attendant_registration_id,

                        /*
                    |--------------------------------------------------------------------------
                    | Participant information
                    |--------------------------------------------------------------------------
                    */

                        'name' =>
                        $participant->name ?? '',

                        'organization' =>
                        $participant->organization ?? '',

                        'position' =>
                        $participant->position ?? '',

                        'gender' =>
                        $participant->gender ?? 'M',

                        'province' =>
                        $participant->province ?? '',

                        'distance' =>
                        $participant->distance ?? 0,

                        'remarks' =>
                        $participant->remarks ?? '',

                        /*
                    |--------------------------------------------------------------------------
                    | Daily costs
                    |--------------------------------------------------------------------------
                    */

                        'costs' =>
                        $participant->costs ?? [],

                        /*
                    |--------------------------------------------------------------------------
                    | Totals
                    |--------------------------------------------------------------------------
                    */

                        'breakfast' =>
                        $participant->breakfast ?? 0,

                        'lunch' =>
                        $participant->lunch ?? 0,

                        'dinner' =>
                        $participant->dinner ?? 0,

                        'accommodation' =>
                        $participant->accommodation ?? 0,

                        'taxi' =>
                        $participant->taxi ?? 0,

                        'local_transport' =>
                        $participant->local_transport ?? 0,

                        'other' =>
                        $participant->other ?? 0,

                        'total' =>
                        $participant->total ?? 0,

                    ];
                })
                ->values()
                ->toArray()
        );


        /*
        |--------------------------------------------------------------------------
        | Dates
        |--------------------------------------------------------------------------
        */

        $dates = old(
            'dates',
            $allowanceForm->dates ?? []
        );


        return view(
            'allowance_forms.edit',
            compact(
                'allowanceForm',
                'attendantLists',
                'donorLogos',
                'selectedDonors',
                'dates',
                'participants'
            )
        );
    }


    public function update(
        Request $request,
        AllowanceForm $allowanceForm
    ) {
        $validated = $request->validate([

            /*
        |--------------------------------------------------------------------------
        | Attendant List
        |--------------------------------------------------------------------------
        */

            'attendant_list_id' => [
                'nullable',
                'exists:attendant_lists,id',
            ],

            /*
        |--------------------------------------------------------------------------
        | General information
        |--------------------------------------------------------------------------
        */

            'activity' => [
                'required',
                'string',
                'max:255',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],

            'venue' => [
                'nullable',
                'string',
                'max:255',
            ],

            'program' => [
                'required',
                'in:RITI,SACHAS,MACOR,PALI',
            ],

            'donor_code' => [
                'nullable',
                'string',
                'max:255',
            ],

            'donor' => [
                'nullable',
                'string',
                'max:255',
            ],

            'budget_code' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
        |--------------------------------------------------------------------------
        | Dates
        |--------------------------------------------------------------------------
        */

            'dates' => [
                'required',
                'array',
                'min:1',
            ],

            'dates.*' => [
                'required',
                'string',
                'max:100',
            ],

            /*
        |--------------------------------------------------------------------------
        | Donor Logos
        |--------------------------------------------------------------------------
        */

            'donor_logo_ids' => [
                'nullable',
                'array',
            ],

            'donor_logo_ids.*' => [
                'exists:donor_logos,id',
            ],

            /*
        |--------------------------------------------------------------------------
        | Participants
        |--------------------------------------------------------------------------
        */

            'participants' => [
                'required',
                'array',
                'min:1',
            ],

            'participants.*.registration_id' => [
                'nullable',
                'exists:attendant_registrations,id',
            ],

            'participants.*.name' => [
                'required',
                'string',
                'max:255',
            ],

            'participants.*.gender' => [
                'nullable',
                'string',
                'max:10',
            ],

            'participants.*.organization' => [
                'nullable',
                'string',
                'max:255',
            ],

            'participants.*.position' => [
                'nullable',
                'string',
                'max:255',
            ],

            'participants.*.province' => [
                'nullable',
                'string',
                'max:255',
            ],

            'participants.*.distance' => [
                'nullable',
                'numeric',
            ],

            'participants.*.remarks' => [
                'nullable',
                'string',
            ],

            /*
        |--------------------------------------------------------------------------
        | Costs
        |--------------------------------------------------------------------------
        */

            'participants.*.costs' => [
                'required',
                'array',
            ],

            'participants.*.breakfast' => [
                'nullable',
                'numeric',
            ],

            'participants.*.lunch' => [
                'nullable',
                'numeric',
            ],

            'participants.*.dinner' => [
                'nullable',
                'numeric',
            ],

            'participants.*.accommodation' => [
                'nullable',
                'numeric',
            ],

            'participants.*.taxi' => [
                'nullable',
                'numeric',
            ],

            'participants.*.local_transport' => [
                'nullable',
                'numeric',
            ],

            'participants.*.other' => [
                'nullable',
                'numeric',
            ],

            'participants.*.total' => [
                'nullable',
                'numeric',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate dates from Start Date -> End Date
        |--------------------------------------------------------------------------
        */

        $dates = [];

        $current = Carbon::parse(
            $validated['start_date']
        );

        $end = Carbon::parse(
            $validated['end_date']
        );


        while ($current->lte($end)) {

            $dates[] =
                $current->format('Y-m-d');

            $current->addDay();
        }


        /*
        |--------------------------------------------------------------------------
        | Check Attendant List ownership
        |--------------------------------------------------------------------------
        */

        $attendantList = null;

        if (!empty($validated['attendant_list_id'])) {

            $attendantList = AttendantList::query()
                ->where(
                    'id',
                    $validated['attendant_list_id']
                )
                ->firstOrFail();
        }


        /*
        |--------------------------------------------------------------------------
        | Update Allowance Form
        |--------------------------------------------------------------------------
        */

        $allowanceForm->update([

            'attendant_list_id' =>
            $validated['attendant_list_id']
                ?? null,

            'activity' =>
            $validated['activity'],

            'start_date' =>
            $validated['start_date'],

            'end_date' =>
            $validated['end_date'],

            'program' =>
            $validated['program'],

            'venue' =>
            $validated['venue']
                ?? null,

            'donor_code' =>
            $validated['donor_code']
                ?? null,

            'donor' =>
            $validated['donor']
                ?? null,

            'budget_code' =>
            $validated['budget_code']
                ?? null,

            'dates' =>
            $dates,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Sync Donor Logos
        |--------------------------------------------------------------------------
        */

        $allowanceForm
            ->donorLogos()
            ->sync(
                $validated['donor_logo_ids']
                    ?? []
            );


        /*
        |--------------------------------------------------------------------------
        | Remove Existing Participants
        |--------------------------------------------------------------------------
        */

        $allowanceForm
            ->participants()
            ->delete();


        /*
        |--------------------------------------------------------------------------
        | Create Updated Participants
        |--------------------------------------------------------------------------
        */

        foreach (
            $validated['participants']
            as $participant
        ) {

            $allowanceForm
                ->participants()
                ->create([

                    /*
                |--------------------------------------------------------------------------
                | Registration relationship
                |--------------------------------------------------------------------------
                */

                    'attendant_registration_id' =>
                    $participant['registration_id']
                        ?? null,

                    /*
                |--------------------------------------------------------------------------
                | Participant information
                |--------------------------------------------------------------------------
                */

                    'name' =>
                    $participant['name'],

                    'gender' =>
                    $participant['gender']
                        ?? null,

                    'organization' =>
                    $participant['organization']
                        ?? null,

                    'position' =>
                    $participant['position']
                        ?? null,

                    'province' =>
                    $participant['province']
                        ?? null,

                    'distance' =>
                    $participant['distance']
                        ?? 0,

                    'remarks' =>
                    $participant['remarks']
                        ?? null,

                    /*
                |--------------------------------------------------------------------------
                | Costs
                |--------------------------------------------------------------------------
                */

                    'costs' =>
                    $participant['costs']
                        ?? [],

                    /*
                |--------------------------------------------------------------------------
                | Totals
                |--------------------------------------------------------------------------
                */

                    'breakfast' =>
                    $participant['breakfast']
                        ?? 0,

                    'lunch' =>
                    $participant['lunch']
                        ?? 0,

                    'dinner' =>
                    $participant['dinner']
                        ?? 0,

                    'accommodation' =>
                    $participant['accommodation']
                        ?? 0,

                    'taxi' =>
                    $participant['taxi']
                        ?? 0,

                    'local_transport' =>
                    $participant['local_transport']
                        ?? 0,

                    'other' =>
                    $participant['other']
                        ?? 0,

                    'total' =>
                    $participant['total']
                        ?? 0,

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'allowance-forms.index'
            )
            ->with(
                'success',
                'Allowance form updated successfully.'
            );
    }


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


    public function templatePdf()
    {

        $html = view('allowance_forms.template')->render();

        // Remove non-breaking spaces
        $html = str_replace("\xC2\xA0", ' ', $html);

        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new Mpdf([
            'mode' => 'utf-8',

            // A4 Landscape
            'format' => 'A4-L',

            'margin_left'   => 6,
            'margin_right'  => 6,
            'margin_top'    => 2,
            'margin_bottom' => 2,

            'autoScriptToLang' => true,
            'autoLangToFont'   => true,

            'tempDir' => storage_path('app/mpdf'),

            'fontDir' => array_merge(
                $fontDirs,
                [
                    public_path('fonts'),
                ]
            ),

            'fontdata' => $fontData + [
                'khmer' => [
                    'R' => 'Battambang-Regular.ttf',
                    'B' => 'Battambang-Bold.ttf',
                ],
            ],

            'default_font' => 'khmer',
        ]);

        $logo = public_path('images/logo.png');

        if (file_exists($logo)) {

            $mpdf->SetWatermarkImage(
                $logo,
                0.06,
                [150, 100],
                [60, 55]
            );

            $mpdf->showWatermarkImage = true;
        }

        $mpdf->SetTitle(
            'Allowance Form FM02-06 Template'
        );

        $mpdf->SetAuthor(
            config('app.name')
        );


        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output(
                'Allowance-FM02-06-Template.pdf',
                'S'
            ),
            200,
            [
                'Content-Type' => 'application/pdf',

                'Content-Disposition' =>
                'inline; filename="Allowance-FM02-06-Template.pdf"',
            ]
        );
    }
}
