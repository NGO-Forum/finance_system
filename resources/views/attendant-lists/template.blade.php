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

        /*
        .watermark {
            position: fixed;
            top: 28%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1000;
        }

        .watermark img {
            width: 300px;
            opacity: 0.05;
        } */

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
            margin-top: 20px;
            font-size: 10px;
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
            font-size: 9px;
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
            line-height: 1.8;
            font-weight: normal;
        }

        .grid-table td {
            padding: 6px 1px;
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
            margin-top: 3px;
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

    {{-- <div class="watermark">
        <img src="{{ public_path('images/logo.png') }}">
    </div> --}}

    <table class="header-table">

        <tr>

            {{-- NGO Logo --}}
            <td style="width:11%; text-align:left;">

                <img src="{{ public_path('images/logo.png') }}" style="height:60px;">

            </td>

            {{-- Activity --}}
            <td style="width:30%;">

                <table class="activity-table">

                    <tr>
                        <td style="width:100px;">
                            សកម្មភាព (Activity):
                        </td>

                        <td style="border-bottom:1px dotted #000;">

                        </td>
                    </tr>

                    <tr>
                        <td>ទីតាំង (Venue):</td>

                        <td style="border-bottom:1px dotted #000;">

                        </td>
                    </tr>

                    <tr>
                        <td>កាលបរិច្ឆេទ (Date):</td>

                        <td style="border-bottom:1px dotted #000;">

                        </td>
                    </tr>

                </table>

            </td>

            {{-- NGO Title --}}
            <td style="width:27%; height:70px; text-align:center;">

                <div class="title-green">

                    <img src="{{ public_path('images/exp.jpg') }}" style="height:50px;">

                </div>

                <div style="border-top:2px solid #0b8d43; margin:4px 30px;"></div>

                <div style="font-size:12px;">

                    បញ្ជីវត្តមាន (Attendance List)

                </div>

            </td>

            <td style="width:32%; text-align:right; vertical-align:middle;">

                <table cellpadding="0" cellspacing="0" border="0" style="margin-left:auto;">
                    <tr>

                        @foreach ($donorLogos as $logo)
                            @php
                                $path = public_path('storage/' . $logo->logo);
                            @endphp

                            @if (file_exists($path))
                                <td style="padding-left:10px; vertical-align:middle; text-align:center;">
                                    <img src="{{ $path }}" style="height:55px; width:auto; display:block;">
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
        By selecting to check or sign "Allow" in the "Allow to take and use my photos" signature column, it means that I
        consent to the NGO FORUM ON CAMBODIA and/or its partners and/or funders to reproduce and/or
        publish and/or otherwise use pictures and/or videos of me and/or my story in print or electronic formats, and on
        websites and social media that will help promote initiatives related to the program or development related to
        THE NGO FORUM ON CAMBODIA activities. I understand that my pictures, videos, or stories may be
        reproduced or published in any way without restriction.
    </div>

    <table class="grid-table">

        <thead>
            <tr>
                <th rowspan="2" style="width: 2.5%;">ល.រ<br>No.</th>

                <th rowspan="2" style="width: 11%;">ឈ្មោះអ្នកចូលរួម<br>Participant's Name</th>

                <th rowspan="2" style="width: 6%;">ភេទ/យេនឌ័រ<br>Sex/Gender<br>
                    <span style="font-size: 8.5px; font-weight: normal;">1. ស្រី Female<br>2. ប្រុស Male<br>3. ផ្សេងៗ
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

                <th colspan="2" style="width: 15%;">អាសយដ្ឋាន (Address)</th>

                <th rowspan="2" style="width: 6.5%;">ស្ថាប័ន<br>Institutions</th>

                <th rowspan="2" style="width: 7%;">តួនាទី<br>Position</th>

                <th rowspan="2" style="width: 13.5%;">លេខទូរស័ព្ទ/អ៊ីម៉ែល<br>Contact No./Email</th>

                <th rowspan="2" style="width: 2%;" class="narrow-column-header">
                    <img src="{{ public_path('images/unit.png') }}" style="width:15px;">
                </th>

                <th rowspan="2" style="width: 7%; line-height: 2;">
                    ហត្ថលេខា (អនុញ្ញាតឱ្យថត និងប្រើប្រាស់រូបថត)<br>
                    <span style="font-size: 10px; font-weight: normal;">Signature (Allow to take and use my
                        photos)</span>
                </th>

                <th rowspan="2" style="width: 7%;">ហត្ថលេខា<br>Signature</th>
            </tr>
            <tr>
                <th style="font-size: 9px; font-weight: normal; width: 7.5%; line-height: 1.8;">ភូមិ (Village) និង
                    ឃុំ/សង្កាត់ (Commune)</th>
                <th style="font-size: 9px; font-weight: normal; width: 7.5%; line-height: 1.8;">ក្រុង/ស្រុក/ខណ្ឌ និង
                    ខេត្ត (District) (Province)</th>
            </tr>
        </thead>

        <tbody>

            @for ($i = count($registrations); $i < 10; $i++)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @endfor
        </tbody>
    </table>

    {{-- Body --}}
    <div class="summary-container">
        <div class="summary-heading">សង្ខេបលទ្ធផលនិងស្ថានភាពអ្នកចូលរួម៖</div>

        <div class="summary-row">
            អ្នកចូលរួមសរុប (Total Participants): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ស្រី (Female): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ផ្សេងៗ (Others): ......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): ......
            នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ស្រីងាយរងគ្រោះ (Vulnerable women): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            យុវជនសរុប (Youth): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ស្រី (Female): ......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            ផ្សេងៗ (Others): .......
            នាក់
        </div>

        <div class="summary-row">
            សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ជនមានពិការភាពសរុប (People with disabilities): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ស្រី (Female): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ផ្សេងៗ (Others): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): ....... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ក្រីក្រសរុប (People with ID poor): ....... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ស្រី (Female): .......
            នាក់
        </div>


        <div class="summary-row">
            ផ្សេងៗ (Others): ......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): ....... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ជនជាតិដើមភាគតិចសរុប (Indigenous people): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ស្រី (Female): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ផ្សេងៗ (Others): ....... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): ....... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            បុគ្គលិកអង្គការសរុប (CSO staff): ...... នាក់
        </div>

        <div class="summary-row">
            ស្រី (Female): .......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            ផ្សេងៗ (Others): ......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            អាជ្ញាធរ (Authorities): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ស្រី (Female): ......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            ផ្សេងៗ (Others): ......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): .......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            ចូលរួមលើកដំបូង សរុប (Unique counting): ...... នាក់
            &nbsp;&nbsp;&nbsp;&nbsp;
            ស្រី (Female): .......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            ផ្សេងៗ (Others): ......
            នាក់ &nbsp;&nbsp;&nbsp;&nbsp;
            សុំមិនបង្ហាញយេនឌ័រ (Prefer to say): ..... នាក់
        </div>
    </div>

    <div style="text-align: left; font-size: 10px; line-height: 1.5;">
        <div style="margin-top: 15px; height: 20px;">
            <span>PREPARED BY: .................................</span>
        </div>

        <div>
            (Signature/name/position/date)
        </div>
    </div>

</body>

</html>
