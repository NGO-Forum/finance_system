<?php

namespace App\Http\Controllers;

use App\Models\AttendantList;
use App\Models\DonorLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Browsershot\Browsershot;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;

class AttendantListController extends Controller
{
    /**
     * Display a listing.
     */
    public function index()
    {
        $query = AttendantList::with(['donorLogos', 'creator']);

        if (auth()->user()->role->name !== 'Admin') {
            $query->where('created_by', auth()->id());
        }

        $attendantLists = $query->latest()->paginate(10);

        $donorLogos = DonorLogo::orderBy('name')->get();

        return view('attendant-lists.index', compact(
            'attendantLists',
            'donorLogos'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $donorLogos = DonorLogo::orderBy('name')->get();

        return view('attendant-lists.create', compact('donorLogos'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|string|max:255',

            'start_date' => 'required|date',

            'end_date' => 'required|date',

            'start_time' => 'required|date_format:H:i',

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'venue' => 'nullable|string|max:255',

            'donor_logo_ids' => 'nullable|array',

            'donor_logo_ids.*' => 'exists:donor_logos,id',

            'max_participants' => 'nullable|integer|min:1',

            'registration_closed_at' => 'nullable|date|after:now',

        ]);

        $token = Str::random(40);

        $link = route('attendant.register', $token);

        $filename = 'qr-codes/' . time() . '.svg';

        Storage::disk('public')->put(
            $filename,
            QrCode::format('svg')
                ->size(300)
                ->generate($link)
        );

        $attendantList = AttendantList::create([

            'title' => $request->title,

            'start_date' => $request->start_date,

            'end_date' => $request->end_date,

            'start_time' => $request->start_time,

            'end_time' => $request->end_time,

            'venue' => $request->venue,

            'registration_enabled' => $request->boolean('registration_enabled'),

            'registration_closed_at' => $request->registration_closed_at,

            'registration_token' => $token,

            'registration_link' => $link,

            'qr_code_path' => $filename,

            'max_participants' => $request->max_participants,

            'created_by' => auth()->id(),

        ]);

        if ($request->filled('donor_logo_ids')) {

            $attendantList->donorLogos()->sync($request->donor_logo_ids);
        }

        return redirect()
            ->route('attendant-lists.index')
            ->with('success', 'Attendance list created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendantList $attendantList)
    {
        $attendantList->load([
            'donorLogos',
            'creator',
            'registrations'
        ]);

        return view('attendant-lists.show', compact('attendantList'));
    }

    /**
     * Show the form for editing.
     */
    public function edit(AttendantList $attendantList)
    {
        $donorLogos = DonorLogo::orderBy('name')->get();

        $attendantList->load('donorLogos');

        return view('attendant-lists.edit', compact(
            'attendantList',
            'donorLogos'
        ));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, AttendantList $attendantList)
    {
        $request->validate([

            'title' => 'required|string|max:255',

            'start_date' => 'required|date',

            'end_date' => 'required|date',

            'start_time' => 'required|date_format:H:i',

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],


            'venue' => 'nullable|string|max:255',

            'donor_logo_ids' => 'nullable|array',

            'donor_logo_ids.*' => 'exists:donor_logos,id',

            'max_participants' => 'nullable|integer|min:1',

            'registration_closed_at' => 'nullable|date',

        ]);

        $attendantList->update([

            'title' => $request->title,

            'start_date' => $request->start_date,

            'end_date' => $request->end_date,

            'start_time' => $request->start_time,

            'end_time' => $request->end_time,

            'venue' => $request->venue,

            'registration_enabled' => $request->boolean('registration_enabled'),

            'max_participants' => $request->max_participants,

            'registration_closed_at' => $request->registration_closed_at,

        ]);

        $attendantList->donorLogos()->sync(
            $request->donor_logo_ids ?? []
        );

        return redirect()
            ->route('attendant-lists.index')
            ->with('success', 'Attendance list updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(AttendantList $attendantList)
    {
        $attendantList->donorLogos()->detach();

        $attendantList->delete();

        return redirect()
            ->route('attendant-lists.index')
            ->with('success', 'Attendance list deleted successfully.');
    }


    public function previewQrCard(AttendantList $attendantList)
    {
        return view(
            'attendant-lists.qr-card',
            compact('attendantList')
        );
    }


    public function exportPdf(Request $request)
    {
        if ($request->filled('donor_logo_ids')) {

            $donorLogos = DonorLogo::whereIn(
                'id',
                $request->donor_logo_ids
            )->get();
        } else {

            $donorLogos = collect();
        }

        $registrations = collect();

        // Optional blank activity information
        $attendantList = (object) [
            'title' => '',
            'venue' => '',
            'activity_date' => '',
        ];

        // Render Blade to HTML
        $html = view(
            'attendant-lists.template',
            compact(
                'attendantList',
                'registrations',
                'donorLogos'
            )
        )->render();

        // Replace UTF-8 non-breaking spaces
        $html = str_replace("\xc2\xa0", ' ', $html);

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 6,
            'margin_right' => 6,
            'margin_top' => 2,
            'margin_bottom' => 3,
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'tempDir' => storage_path('app/mpdf'),
        ]);

        $mpdf->SetWatermarkImage(
            public_path('images/logo.png'),
            0.06,
            [150, 100],   // width, height (mm)
            [75, 55]      // x, y position (mm)
        );

        $mpdf->showWatermarkImage = true;

        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output('Attendance-Template.pdf', 'D'),
            200
        )->header('Content-Type', 'application/pdf');
    }

    public function dsaParticipants(AttendantList $attendantList)
    {

        $registrations = $attendantList->registrations()
            ->where('dsa', 'Need')
            ->where('dsa_status', 'Approved')
            ->orderBy('full_name')
            ->get();

        return response()->json([
            'success' => true,

            'attendant_list' => [
                'id' => $attendantList->id,
                'title' => $attendantList->title,
                'start_date' => $attendantList->start_date?->format('Y-m-d'),
                'end_date' => $attendantList->end_date?->format('Y-m-d'),
                'venue' => $attendantList->venue,
            ],

            'participants' => $registrations->map(function ($registration) {

                return [
                    'registration_id' => $registration->id,

                    'name' => $registration->full_name ?? '',

                    'organization' => $registration->institution ?? '',

                    'position' => $registration->position ?? '',

                    'gender' => $registration->gender ?? 'Male',

                    'village' => $registration->village ?? '',

                    'commune' => $registration->commune ?? '',

                    'district' => $registration->district ?? '',

                    'province' => collect([
                        $registration->village,
                        $registration->commune,
                        $registration->district,
                        $registration->province,
                    ])
                        ->filter(fn($value) => filled($value))
                        ->implode(', '),

                    'distance' => 0,

                    'remarks' => $registration->remark ?? '',

                    'costs' => [],
                ];
            })->values(),
        ]);
    }
}
