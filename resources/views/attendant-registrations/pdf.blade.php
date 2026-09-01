<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'battambang', sans-serif !important;
            font-size: 8px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        /* Header Formatting */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }

        .header-table td {
            vertical-align: middle;
            padding: 3px;
        }

        .dotted-line {
            border-bottom: 1px dotted #000;
            display: inline-block;
        }

        .title-green {
            color: #1e5631;
            font-weight: bold;
            text-align: right;
            line-height: 2;

        }

        .title-sub {
            color: #1e5631;
            text-align: right;
            font-weight: bold;
            font-size: 12px;
            line-height: 2;
        }

        .activity-table {
            width: 100%;
            border: none;
            font-size: 10px;
            margin-top: 20px;
        }

        .activity-table td {
            border: none;
            padding: 2px 0;
            font-size: 10px;
        }

        /* Disclaimer Styling */
        .consent-box {
            border: 1px solid #000;
            padding: 4px;
            font-size: 8.5px;
            line-height: 1.5;
            text-align: justify;
        }

        /* Data Grid Formatting */
        .grid-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .grid-table th,
        .grid-table td {
            border: 1px solid #000;
            text-align: center;
            vertical-align: middle;
            padding: 1px 1px;
            font-size: 10px;
            line-height: 1.5;
            font-weight: normal;
        }

        .grid-table td {
            height: 32px;
            font-size: 9px;
        }

        .align-left {
            text-align: left !important;
            padding-left: 4px !important;
        }

        /* Custom Vertical Header for mPDF compatibility */
        .narrow-column-header {
            font-size: 9px !important;
            padding: 5px 1px !important;
            line-height: 1.2 !important;
        }


        /* Inline Layout Styling for Continuous Summary Rows */
        .summary-container {
            width: 100%;
            font-size: 8.5px;
            line-height: 1.5;
            /* Generous line height matches original document format */
            margin-top: 4px;
            color: #000;
        }

        .summary-row {
            margin-bottom: 1px;
            text-align: justify;
        }

        .summary-heading {
            font-weight: bold;
            font-size: 8.5px;
            margin-bottom: 1px;
            text-decoration: underline;
        }

        .val-field {
            display: inline-block;
            min-width: 45px;
            text-align: center;
        }
    </style>
</head>

<body>

    @php
        $chunkedRegistrations = $registrations->chunk(10)->map->values(); ;
    @endphp

    @foreach ($chunkedRegistrations as $chunk)
        <table class="header-table">

            <tr>

                {{-- NGO Logo --}}
                <td style="width:10%; text-align:left;">

                    <img src="{{ public_path('images/logo.png') }}" style="height:60px;">

                </td>

                {{-- Activity --}}
                <td style="width:40%;">

                    <table class="activity-table">

                        <tr>
                            <td style="width:100px;">
                                សកម្មភាព (Activity):
                            </td>

                            <td style="border-bottom:1px dotted #000;">
                                {{ $attendantList->title }}
                            </td>
                        </tr>

                        <tr>
                            <td>ទីតាំង (Venue):</td>

                            <td style="border-bottom:1px dotted #000;">
                                {{ $attendantList->venue }}
                            </td>
                        </tr>

                        <tr>
                            <td>កាលបរិច្ឆេទ (Date):</td>

                            <td style="border-bottom:1px dotted #000;">
                                {{ \Carbon\Carbon::parse($attendantList->start_date)->format('d F Y') }}
                            </td>
                        </tr>

                    </table>

                </td>

                {{-- NGO Title --}}
                <td style="width:25%; height:70px; text-align:center;">

                    <div class="title-green">

                        <img src="{{ public_path('images/exp.jpg') }}" style="height:50px; text-align:top;">

                    </div>

                    <div style="font-size:14px; margin-top: 4px;">

                        បញ្ជីវត្តមាន (Attendance List)

                    </div>

                </td>

                {{-- 40 Years Logo --}}
                <td style="width:25%; text-align:right; vertical-align:middle;">

                    <table cellpadding="0" cellspacing="0" border="0" style="margin-left:auto;">
                        <tr>
                            @foreach ($donorLogos as $logo)
                                @if ($logo->logo && file_exists(public_path('storage/' . $logo->logo)))
                                    <td style="padding-left:10px; vertical-align:middle;">
                                        <img src="{{ public_path('storage/' . $logo->logo) }}"
                                            style="height:50px; width:auto; display:block;">
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    </table>

                </td>

            </tr>

        </table>

        <div class="consent-box">
            នៅពេលជ្រើសរើសប្រអប់សញ្ញាគ្រីសឬហត្ថលេខា នៅក្នុងប្រអប់"អនុញ្ញាតឱ្យថត និងប្រើប្រាស់រូបថត" មានន័យថា
            ខ្ញុំយល់ព្រមឱ្យអង្គការ វេទិកានៃអង្គការមិនមែនរដ្ឋាភិបាល ស្តីពីកម្ពុជា និង/ឬដៃគូសហការ និង/ឬម្ចាស់ជំនួយ
            មានសិទ្ធិផលិតឡើងវិញ បោះពុម្ព និង/ឬប្រើប្រាស់រូបភាព វីដេអូ និង/ឬប្រវត្តិរឿងរ៉ាវរបស់ខ្ញុំ
            ក្នុងទម្រង់ជាព្រីននិងអេឡិចត្រូនិកផ្សេងៗនៅលើគេហទំព័រ
            និងបណ្តាញសង្គមដែលនឹងជួយផ្សព្វផ្សាយគំនិតផ្តួចផ្តើមដែលទាក់ទងនឹងគម្រោង
            ឬការអភិវឌ្ឍផ្សេងៗដែលផ្សារភ្ជាប់ជាមួយសកម្មភាពអង្គការ វេទិកានៃអង្គការមិនមែនរដ្ឋាភិបាល ស្តីពីកម្ពុជា។
            ខ្ញុំយល់ថា រូបភាព វីដេអូ ឬសាច់រឿង អាចនឹងត្រូវផលិតឡើងវិញ ឬបោះពុម្ព ក្នុងវិធីណាមួយដោយមិនទាក់ទំនិញ។
            By selecting to check or sign "Allow" in the "Allow to take and use my photos" signature column, it means
            that I
            consent to the NGO FORUM ON CAMBODIA and/or its partners and/or funders to reproduce and/or
            publish and/or otherwise use pictures and/or videos of me and/or my story in print or electronic formats,
            and on
            websites and social media that will help promote initiatives related to the program or development related
            to
            THE NGO FORUM ON CAMBODIA activities. I understand that my pictures, videos, or stories may be
            reproduced or published in any way without restriction.
        </div>

        <table class="grid-table">

            <thead>
                <tr>
                    <th rowspan="2" style="width: 2.5%;">ល.រ<br>No.</th>

                    <th rowspan="2" style="width: 11%;">ឈ្មោះអ្នកចូលរួម<br>Participant's Name</th>

                    <th rowspan="2" style="width: 5%;">ភេទ/យេនឌ័រ<br>Sex/Gender<br>
                        <span style="font-size: 8.5px; font-weight: normal;">1. ស្រី Female<br>2. ប្រុស Male<br>3.
                            ផ្សេងៗ
                            Others<br>4. សុំមិនបង្ហាញយេនឌ័រ Prefer to say</span>
                    </th>

                    <th rowspan="2" style="width: 4.5%;">អាយុ<br>Age<br>
                        <span style="font-size: 9px; font-weight: normal;">1. &lt;15<br>2. 15-&lt;=30<br>3.
                            &gt;30-60<br>4. &gt;60</span>
                    </th>

                    <!-- Narrow Columns using natural wrapping (No rotation) -->
                    <th rowspan="2" style="width: 2%;" class="narrow-column-header">
                        <img src="{{ public_path('images/woman.png') }}" style="width:13px;">
                    </th>

                    <th rowspan="2" style="width: 2%;" class="narrow-column-header">
                        <img src="{{ public_path('images/People.png') }}" style="width:13px;">
                    </th>

                    <th rowspan="2" style="width: 2%;" class="narrow-column-header">
                        <img src="{{ public_path('images/poor.png') }}" style="width:13px;">
                    </th>

                    <th rowspan="2" style="width: 2%;" class="narrow-column-header">
                        <img src="{{ public_path('images/indigenous.png') }}" style="width:15px;">
                    </th>

                    <th colspan="2" style="width: 16%;">អាសយដ្ឋាន (Address)</th>

                    <th rowspan="2" style="width: 6.5%;">ស្ថាប័ន<br>Institutions</th>

                    <th rowspan="2" style="width: 9%;">តួនាទី<br>Position</th>

                    <th rowspan="2" style="width: 13.5%;">លេខទូរស័ព្ទ/អ៊ីម៉ែល<br>Contact No./Email</th>

                    <th rowspan="2" style="width: 2%;" class="narrow-column-header">
                        <img src="{{ public_path('images/unit.png') }}" style="width:15px;">
                    </th>

                    <th rowspan="2" style="width: 7%; line-height: 2;">
                        ហត្ថលេខា <br> (អនុញ្ញាតឱ្យថត និងប្រើប្រាស់រូបថត)<br>
                        <span style="font-size: 10px; font-weight: normal;">Signature (Allow to take and use my
                            photos)</span>
                    </th>

                    <th rowspan="2" style="width: 7%;">ហត្ថលេខា<br>Signature</th>
                </tr>
                <tr>
                    <th style="font-size: 9px; font-weight: normal; width: 6.5%; line-height: 1.8;">ភូមិ (Village) និង
                        ឃុំ/សង្កាត់ (Commune)</th>
                    <th style="font-size: 9px; font-weight: normal; width: 6.5%; line-height: 1.8;">ក្រុង/ស្រុក/ខណ្ឌ និង
                        ខេត្ត (District) (Province)</th>
                </tr>
            </thead>

            <tbody>
                @for ($i = 0; $i < 10; $i++)
                    @php
                        $registration = $chunk->get($i);
                    @endphp

                    <tr>
                        <td>
                            {{ $i + 1 }}
                        </td>
                        @if ($registration)
                            <td class="align-left">{{ $registration->full_name }}</td>
                            <td>
                                @if ($registration->gender == 'Female')
                                    1
                                @elseif($registration->gender == 'Male')
                                    2
                                @elseif($registration->gender == 'Other')
                                    3
                                @elseif($registration->gender == 'Prefer not to say')
                                    4
                                @endif
                            </td>
                            <td>
                                @if ($registration->age_group == '<15')
                                    1
                                @elseif($registration->age_group == '15-30')
                                    2
                                @elseif($registration->age_group == '31-60')
                                    3
                                @elseif($registration->age_group == '>60')
                                    4
                                @endif
                            </td>
                            <td>{{ $registration->indigenous == 'Yes' ? '1' : '0' }}</td>
                            <td>{{ $registration->disability == 'Yes' ? '1' : '0' }}</td>
                            <td>
                                @if ($registration->poor_status == 'ID Poor 1')
                                    1
                                @elseif($registration->poor_status == 'ID Poor 2')
                                    2
                                @else
                                    0
                                @endif
                            </td>
                            <td>{{ $registration->vulnerable_women == 'Yes' ? '1' : '0' }}</td>
                            <td class="align-left">
                                {{ $registration->residence_type === 'Community' ? $registration->village . ', ' . $registration->commune : ' ' }}
                            </td>
                            <td class="align-left">
                                {{ $registration->residence_type === 'Community' ? $registration->district . ', ' . $registration->province : 'Phnom Penh' }}
                            </td>
                            <td class="align-left">{{ $registration->institution }}</td>
                            <td class="align-left">{{ $registration->position }}</td>
                            <td>
                                <div>{{ $registration->phone }}/{{ $registration->email }}</div>
                            </td>
                            <td>{{ $registration->unique_count == 'Yes' ? '1' : '0' }}</td>
                            <td></td>
                            <td style="padding: 1px;">
                                @if ($registration->signature && file_exists(public_path('storage/' . $registration->signature)))
                                    <img src="{{ public_path('storage/' . $registration->signature) }}"
                                        style="height: 18px; width: auto;" alt="signature">
                                @else
                                    <span style="font-size: 5pt; color: #aaa;"></span>
                                @endif
                            </td>
                        @else
                            {{-- EMPTY ROW --}}

                            @for ($column = 1; $column <= 15; $column++)
                                <td>&nbsp;</td>
                            @endfor
                        @endif
                    </tr>
                @endfor

            </tbody>
        </table>


        {{-- Body --}}
        <div class="summary-container">
            <div class="summary-heading">សង្ខេបលទ្ធផលនិងស្ថានភាពអ្នកចូលរួម៖</div>

            <div class="summary-row">
                អ្នកចូលរួមសរុប (Total Participants): <span
                    class="val-field">{{ $totalParticipants > 0 ? $totalParticipants : '.....' }}</span> នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ស្រី (Female): <span class="val-field">{{ $totalFemale > 0 ? $totalFemale : '.....' }}</span> នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ផ្សេងៗ (Others): <span
                    class="val-field">{{ $totalOtherGender > 0 ? $totalOtherGender : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): <span
                    class="val-field">{{ $totalPreferNotToSayGender > 0 ? $totalPreferNotToSayGender : '.....' }}</span>
                នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ស្រីងាយរងគ្រោះ (Vulnerable women): <span
                    class="val-field">{{ $totalVulnerableWomen > 0 ? $totalVulnerableWomen : '.....' }}</span> នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                យុវជនសរុប (Youth): <span class="val-field">{{ $totalYouth > 0 ? $totalYouth : '.....' }}</span>នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ស្រី (Female): <span class="val-field">{{ $totalYouthFemale > 0 ? $totalYouthFemale : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                ផ្សេងៗ (Others): <span class="val-field">{{ $totalYouthOther > 0 ? $totalYouthOther : '.....' }}</span>
                នាក់
            </div>

            <div class="summary-row">
                សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): <span
                    class="val-field">{{ $totalYouthPrefer > 0 ? $totalYouthPrefer : '.....' }}</span> នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ជនមានពិការភាពសរុប (People with disabilities): <span
                    class="val-field">{{ $totalDisabilities > 0 ? $totalDisabilities : '.....' }}</span>នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ស្រី (Female): <span
                    class="val-field">{{ $totalDisabilitiesFemale > 0 ? $totalDisabilitiesFemale : '.....' }}</span>
                នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ផ្សេងៗ (Others): <span
                    class="val-field">{{ $totalDisabilitiesOther > 0 ? $totalDisabilitiesOther : '.....' }}</span>
                នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): <span
                    class="val-field">{{ $totalIDPoorPrefer > 0 ? $totalIDPoorPrefer : '.....' }}</span> នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ក្រីក្រសរុប (People with ID poor): <span
                    class="val-field">{{ $totalIDPoor > 0 ? $totalIDPoor : '.....' }}</span>នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ស្រី (Female): <span
                    class="val-field">{{ $totalIDPoorFemale > 0 ? $totalIDPoorFemale : '.....' }}</span>
                នាក់
            </div>


            <div class="summary-row">
                ផ្សេងៗ (Others): <span
                    class="val-field">{{ $totalIDPoorOther > 0 ? $totalIDPoorOther : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): <span
                    class="val-field">{{ $totalIDPoorPrefer > 0 ? $totalIDPoorPrefer : '.....' }}</span> នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ជនជាតិដើមភាគតិចសរុប (Indigenous people): <span
                    class="val-field">{{ $totalIndigenous > 0 ? $totalIndigenous : '.....' }}</span>នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ស្រី (Female): <span
                    class="val-field">{{ $totalIndigenousFemale > 0 ? $totalIndigenousFemale : '.....' }}</span> នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ផ្សេងៗ (Others): <span
                    class="val-field">{{ $totalIndigenousOther > 0 ? $totalIndigenousOther : '.....' }}</span> នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): <span
                    class="val-field">{{ $totalIndigenousPrefer > 0 ? $totalIndigenousPrefer : '.....' }}</span> នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                បុគ្គលិកអង្គការសរុប (CSO staff): <span
                    class="val-field">{{ $registrations->where('institution', 'CSO')->count() > 0
                        ? $registrations->where('institution', 'CSO')->count()
                        : '.....' }}</span>នាក់
            </div>

            <div class="summary-row">
                ស្រី (Female): <span
                    class="val-field">{{ $registrations->where('institution', 'CSO')->where('gender', 'Female')->count() > 0
                        ? $registrations->where('institution', 'CSO')->where('gender', 'Female')->count()
                        : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                ផ្សេងៗ (Others): <span
                    class="val-field">{{ $registrations->where('institution', 'CSO')->where('gender', 'Other')->count() > 0
                        ? $registrations->where('institution', 'CSO')->where('gender', 'Other')->count()
                        : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                អាជ្ញាធរ (Authorities): <span
                    class="val-field">{{ $registrations->where('institution', 'Authority')->count() > 0 ? $registrations->where('institution', 'Authority')->count() : '.....' }}</span>នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ស្រី (Female): <span
                    class="val-field">{{ $registrations->where('institution', 'Authority')->where('gender', 'Female')->count() > 0 ? $registrations->where('institution', 'Authority')->where('gender', 'Female')->count() : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                ផ្សេងៗ (Others): <span
                    class="val-field">{{ $registrations->where('institution', 'Authority')->where('gender', 'Other')->count() > 0 ? $registrations->where('institution', 'Authority')->where('gender', 'Other')->count() : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): <span
                    class="val-field">{{ $registrations->where('institution', 'Authority')->where('gender', 'Prefer not to say')->count() > 0 ? $registrations->where('institution', 'Authority')->where('gender', 'Prefer not to say')->count() : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                ចូលរួមលើកដំបូង សរុប (Unique counting): <span
                    class="val-field">{{ $totalUnique > 0 ? $totalUnique : '.....' }}</span>នាក់
                &nbsp;&nbsp;&nbsp;&nbsp;
                ស្រី (Female): <span
                    class="val-field">{{ $totalUniqueFemale > 0 ? $totalUniqueFemale : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                ផ្សេងៗ (Others): <span
                    class="val-field">{{ $totalUniqueOther > 0 ? $totalUniqueOther : '.....' }}</span>
                នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
                សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): <span
                    class="val-field">{{ $totalUniquePrefer > 0 ? $totalUniquePrefer : '.....' }}</span> នាក់
            </div>
        </div>

        <div style="text-align: left; font-size: 10px; line-height: 1.5;">
            <div style="margin-top: 10px; height: 20px;">
                <span>PREPARED BY: .................................</span>
            </div>

            <div>
                (Signature/name/position/date)
            </div>
        </div>

        @if (!$loop->last)
            <pagebreak />
        @endif
    @endforeach

</body>

</html>
