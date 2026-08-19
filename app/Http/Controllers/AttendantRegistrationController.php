<?php

namespace App\Http\Controllers;

use App\Models\AttendantList;
use App\Models\AttendantRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use App\Models\DonorLogo;


class AttendantRegistrationController extends Controller
{
    /**
     * Display registrations for an attendance list.
     */
    public function index(AttendantList $attendantList)
    {
        $registrations = $attendantList->registrations()
            ->latest()
            ->paginate(10);

        return view('attendant-registrations.index', compact(
            'attendantList',
            'registrations'
        ));
    }

    /**
     * Public registration form.
     */
    public function create(string $token)
    {
        $attendantList = AttendantList::where('registration_token', $token)
            ->where('registration_enabled', true)
            ->firstOrFail();

        if (
            $attendantList->max_participants &&
            $attendantList->registrations()->count() >= $attendantList->max_participants
        ) {
            return redirect()->route('attendant.registration.full');
        }

        return view('attendant-registrations.create', compact('attendantList'));
    }

    /**
     * Store registration.
     */
    public function store(Request $request, string $token)
    {
        $attendantList = AttendantList::where('registration_token', $token)
            ->where('registration_enabled', true)
            ->firstOrFail();

        $request->validate([
            'full_name'       => 'required|string|max:255',
            'gender'          => 'nullable|in:Female,Male,Other,Prefer not to say',
            'age_group'       => 'nullable|in:<15,15-30,31-60,>60',
            'indigenous'      => 'required|in:Yes,No',
            'poor_status'     => 'nullable|in:ID Poor 1,ID Poor 2,Non Poor',
            'disability'      => 'required|in:Yes,No',
            'vulnerable_women'  => 'required|in:Yes,No',
            'unique_count'  => 'required|in:Yes,No',

            'residence_type'  => 'nullable|in:Phnom Penh,Community',

            'village'         => 'required_if:residence_type,Community|max:255',
            'commune'         => 'required_if:residence_type,Community|max:255',
            'district'        => 'required_if:residence_type,Community|max:255',
            'province'        => 'required_if:residence_type,Community|max:255',

            'institution'     => 'nullable|string|max:255',
            'position'        => 'nullable|string|max:255',

            'phone'           => 'nullable|string|max:30',
            'email'           => 'nullable|email|max:255',

            'allow_photos'    => 'nullable|image|mimes:png,jpg,jpeg|max:2048',

            'signature'       => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $signature = null;

        if ($request->hasFile('signature')) {
            $signature = $request->file('signature')
                ->store('attendant-signatures', 'public');
        }

        $allow_photos = null;
        if ($request->hasFile('allow_photos')) {
            $signature = $request->file('allow_photos')
                ->store('attendant-allow_photos', 'public');
        }

        $registration = AttendantRegistration::create([
            'attendant_list_id' => $attendantList->id,

            'full_name'         => $request->full_name,
            'gender'            => $request->gender,
            'age_group'         => $request->age_group,
            'indigenous'        => $request->indigenous,
            'poor_status'       => $request->poor_status,
            'disability'        => $request->disability,
            'vulnerable_women'  => $request->vulnerable_women,
            'unique_count'      => $request->unique_count,

            'residence_type'    => $request->residence_type,

            'village'           => $request->village,
            'commune'           => $request->commune,
            'district'          => $request->district,
            'province'          => $request->province,

            'institution'       => $request->institution,
            'position'          => $request->position,

            'phone'             => $request->phone,
            'email'             => $request->email,

            'allow_photos'      => $allow_photos,

            'signature'         => $signature,
        ]);

        return view('attendant-registrations.thank-you', [
            'registration' => $registration,
            'attendantList' => $attendantList,
        ]);
    }

    /**
     * Show one registration.
     */
    public function show(AttendantRegistration $attendantRegistration)
    {
        $attendantRegistration->load('attendantList');

        return view('attendant-registrations.show', compact('attendantRegistration'));
    }

    /**
     * Delete registration.
     */
    public function destroy(AttendantRegistration $attendantRegistration)
    {
        if (
            $attendantRegistration->signature &&
            Storage::disk('public')->exists($attendantRegistration->signature)
        ) {
            Storage::disk('public')->delete($attendantRegistration->signature);
        }

        $attendantRegistration->delete();

        return redirect()
            ->back()
            ->with('success', 'Registration deleted successfully.');
    }

    public function exportPdf(AttendantList $attendantList)
    {
        $registrations = $attendantList->registrations()
            ->orderBy('full_name')
            ->get();

        $donorLogos = $attendantList->donorLogos()->get();

        // Count totals for the bottom summary section
        $totalParticipants = $registrations->count();
        $totalFemale = $registrations->where('gender', 'Female')->count();
        $totalOtherGender = $registrations->where('gender', 'Other')->count();
        $totalPreferNotToSayGender = $registrations->where('gender', 'Prefer not to say')->count();

        $totalYouth = $registrations->whereIn('age_group', ['<15', '15-30'])->count();
        $totalYouthFemale = $registrations->whereIn('age_group', ['<15', '15-30'])->where('gender', 'Female')->count();
        $totalYouthOther = $registrations->whereIn('age_group', ['<15', '15-30'])->where('gender', 'Other')->count();
        $totalYouthPrefer = $registrations->whereIn('age_group', ['<15', '15-30'])->where('gender', 'Prefer not to say')->count();

        $totalVulnerableWomen = $registrations->where('vulnerable_women', 'Yes')->count();
        $totalDisabilities = $registrations->where('disability', 'Yes')->count();
        $totalDisabilitiesFemale = $registrations->where('disability', 'Yes')->where('gender', 'Female')->count();
        $totalDisabilitiesOther = $registrations->where('disability', 'Yes')->where('gender', 'Other')->count();

        $totalIndigenous = $registrations->where('indigenous', 'Yes')->count();
        $totalIndigenousFemale = $registrations->where('indigenous', 'Yes')->where('gender', 'Female')->count();
        $totalIndigenousOther = $registrations->where('indigenous', 'Yes')->where('gender', 'Other')->count();
        $totalIndigenousPrefer = $registrations->where('indigenous', 'Yes')->where('gender', 'Prefer not to say')->count();

        $totalIDPoor = $registrations->whereIn('poor_status', ['ID Poor 1', 'ID Poor 2'])->count();
        $totalIDPoorFemale = $registrations->whereIn('poor_status', ['ID Poor 1', 'ID Poor 2'])->where('gender', 'Female')->count();
        $totalIDPoorOther = $registrations->whereIn('poor_status', ['ID Poor 1', 'ID Poor 2'])->where('gender', 'Other')->count();
        $totalIDPoorPrefer = $registrations->whereIn('poor_status', ['ID Poor 1', 'ID Poor 2'])->where('gender', 'Prefer not to say')->count();

        $totalUnique = $registrations->where('unique_count', true)->count();
        $totalUniqueFemale = $registrations->where('unique_count', true)->where('gender', 'Female')->count();
        $totalUniqueOther = $registrations->where('unique_count', true)->where('gender', 'Other')->count();
        $totalUniquePrefer = $registrations->where('unique_count', true)->where('gender', 'Prefer not to say')->count();

        $html = view(
            'attendant-registrations.pdf',
            compact(
                'attendantList',
                'registrations',
                'totalParticipants',
                'totalFemale',
                'totalOtherGender',
                'totalPreferNotToSayGender',
                'totalYouth',
                'donorLogos',
                'totalYouthFemale',
                'totalYouthOther',
                'totalYouthPrefer',
                'totalVulnerableWomen',
                'totalDisabilities',
                'totalDisabilitiesFemale',
                'totalDisabilitiesOther',
                'totalIndigenous',
                'totalIndigenousFemale',
                'totalIndigenousOther',
                'totalIndigenousPrefer',
                'totalIDPoor',
                'totalIDPoorFemale',
                'totalIDPoorOther',
                'totalIDPoorPrefer',
                'totalUnique',
                'totalUniqueFemale',
                'totalUniqueOther',
                'totalUniquePrefer'
            )
        )->render();

        // TOFU FIX: Replace all UTF-8 non-breaking spaces with standard normal spaces
        $html = str_replace("\xc2\xa0", ' ', $html);

        // Initialize mPDF using automatic script detection instead of custom font data configuration
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 6,
            'margin_right' => 6,
            'margin_top' => 2,
            'margin_bottom' => 3,

            // Auto-detect Khmer and load system/embedded Khmer fonts automatically
            'autoScriptToLang' => true,
            'autoLangToFont'   => true,

            'tempDir' => storage_path('app/mpdf'),
        ]);

        $mpdf->SetWatermarkImage(
            public_path('images/logo.png'),
            0.05,
            [150, 100],   // width, height (mm)
            [75, 55]      // x, y position (mm)
        );

        $mpdf->showWatermarkImage = true;

        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output('Attendance List.pdf', 'S'),
            200
        )->header('Content-Type', 'application/pdf');
    }
}
