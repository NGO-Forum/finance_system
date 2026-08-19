@extends('layout.app')

@section('content')
    @php
        $totalAv = $expenditureSummary->items->sum('av_amount');
        $totalActual = $expenditureSummary->items->sum('actual_expense');
        $totalVariance = $expenditureSummary->items->sum('variance_amount');
        $totalVariancePercent = $expenditureSummary->items->sum('variance_percent');

        $totalVariancePercent = max($totalVariancePercent, -100);
    @endphp

    <div class="mb-4">

        <a href="{{ route('expenditure-summaries.index') }}"
            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">

            ← Back

        </a>

    </div>

    <div class="max-w-full mx-auto bg-white">

        <table class="w-full border-collapse text-sm">

            {{-- HEADER --}}
            <tr>

                <td colspan="10" class="border border-black p-2">

                    <div class="flex items-start">

                        <div class="w-32">

                            <img src="{{ asset('/images/logo.png') }}" style="height:70px" class="w-full">

                        </div>

                        <div class="flex-1 text-center">

                            <div class="text-green-700 font-bold text-lg">
                                វេទិការនៃអង្គការមិនមែនរដ្ឋាភិបាល ស្ដីកម្ពុជា
                            </div>

                            <div class="text-green-700 font-bold text-sm">
                                THE NGO FORUM ON CAMBODIA
                            </div>

                        </div>

                    </div>

                </td>

                <td colspan="2" class="border border-black text-center align-center p-2 font-bold text-lg">

                    EXPENDITURE SUMMARY

                </td>

            </tr>

            {{-- INFO --}}
            <tr>

                <td colspan="8" class="border border-black p-2">

                    <strong>NAME & POSITION:</strong>

                    {{ $expenditureSummary->user?->name }}

                </td>

                <td colspan="2" class="border border-black p-2">

                    <strong>DATE:</strong>

                    {{ \Carbon\Carbon::parse($expenditureSummary->date)->format('d M Y') }}

                </td>

                <td colspan="2" rowspan="4" class="border border-black p-2 align-top">

                    <table class="w-full text-sm">

                        <tr>

                            <td class="align-top pr-4 w-1/2">

                                <div class="font-bold border-b border-gray-400 pb-1 mb-2">
                                    Transaction Type
                                </div>

                                <div class="space-y-1">

                                    <div class="flex items-center gap-2">
                                        <span class="w-5 inline-block text-center">
                                            <input type="checkbox"
                                                {{ $expenditureSummary->transaction_type == 'Advance Settlement' ? 'checked' : '' }}>
                                        </span>
                                        <span>Advance Settlement</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="w-5 inline-block text-center">
                                            <input type="checkbox"
                                                {{ $expenditureSummary->transaction_type == 'Reimbursement' ? 'checked' : '' }}>
                                        </span>
                                        <span>Reimbursement</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="w-5 inline-block text-center">
                                            <input type="checkbox"
                                                {{ $expenditureSummary->transaction_type == 'Direct Pay' ? 'checked' : '' }}>
                                        </span>
                                        <span>Direct Pay</span>
                                    </div>

                                </div>

                            </td>

                            <td class="align-top pl-4 border-l border-gray-400 w-1/2">

                                <div class="font-bold border-b border-gray-400 pb-1 mb-2">
                                    Payment Type
                                </div>

                                <div class="space-y-1">

                                    <div class="flex items-center gap-2">
                                        <span class="w-5 inline-block text-center">
                                            <input type="checkbox"
                                                {{ $expenditureSummary->payment_type == 'Cash/QR Code' ? 'checked' : '' }}>
                                        </span>
                                        <span>Cash / QR Code</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="w-5 inline-block text-center">
                                            <input type="checkbox"
                                                {{ $expenditureSummary->payment_type == 'Check/Bank Transfer' ? 'checked' : '' }}>
                                        </span>
                                        <span>Check / Bank Transfer</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="w-5 inline-block text-center">
                                            <input type="checkbox"
                                                {{ $expenditureSummary->payment_type == 'Internet Banking' ? 'checked' : '' }}>
                                        </span>
                                        <span>Internet Banking</span>
                                    </div>

                                </div>

                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

            <tr>

                <td colspan="10" class="border border-black p-2">

                    <strong>ACTIVITY:</strong>

                    {{ $expenditureSummary->activity }}

                </td>

            </tr>

            <tr>

                <td colspan="6" class="border border-black p-2">

                    <strong>PROGRAM:</strong>

                    {{ $expenditureSummary->program }}

                </td>

                <td colspan="4" class="border border-black p-2">

                    <strong>PLACE:</strong>

                    {{ $expenditureSummary->place }}

                </td>

            </tr>

        </table>

        {{-- EXPENSE TABLE --}}
        <table class="w-full border-collapse text-sm">

            <thead>

                <tr>

                    <th rowspan="2" class="border border-black">No.</th>

                    <th rowspan="2" class="border border-black">
                        DESCRIPTION
                    </th>

                    <th rowspan="2" class="border border-black">
                        Ref.
                    </th>

                    <th rowspan="2" class="border border-black">
                        AV/PO/Agr#
                        <br>
                        AMOUNT
                    </th>

                    <th rowspan="2" class="border border-black">
                        ACTUAL
                        <br>
                        EXPENSES
                    </th>

                    <th colspan="2" class="border border-black">
                        VARIANCE
                    </th>

                    <th rowspan="2" class="border border-black">
                        Budget Code
                    </th>

                    <th rowspan="2" class="border border-black">
                        Donor
                    </th>

                    <th rowspan="2" class="border border-black">
                        Donor Code
                    </th>

                </tr>

                <tr>

                    <th class="border border-black">$</th>

                    <th class="border border-black">%</th>

                </tr>

            </thead>

            <tbody>

                @for ($i = 0; $i < 7; $i++)
                    @php
                        $item = $expenditureSummary->items[$i] ?? null;
                    @endphp

                    <tr>

                        <td class="border border-black text-center h-8">
                            {{ $i + 1 }}
                        </td>

                        <td class="border border-black p-2 w-[400px]">
                            {{ $item?->description }}
                        </td>

                        <td class="border border-black p-2 w-[250px]">

                            @if ($item && $item->attachments->count())
                                @foreach ($item->attachments as $attachment)
                                    <a href="{{ asset('storage/' . $attachment->file) }}" target="_blank"
                                        class="text-blue-600 underline">

                                        {{ $attachment->original_name }}

                                    </a>

                                    @if (!$loop->last)
                                        <br>
                                    @endif
                                @endforeach
                            @else
                                -
                            @endif

                        </td>

                        <td class="border border-black text-right p-2">
                            {{ $item ? number_format($item->av_amount, 2) : '' }}
                        </td>

                        <td class="border border-black text-right p-2">
                            {{ $item ? number_format($item->actual_expense, 2) : '' }}
                        </td>

                        <td class="border border-black text-right p-2">
                            @if ($item)
                                {{ $item->variance_amount < 0
                                    ? '(' . number_format(abs($item->variance_amount), 2) . ')'
                                    : number_format($item->variance_amount, 2) }}
                            @endif
                        </td>

                        <td class="border border-black text-right p-2">
                            {{ $item ? number_format($item->variance_percent, 2) . '%' : '' }}
                        </td>

                        <td class="border border-black p-2 text-center">
                            {{ $item?->budget_code }}
                        </td>

                        <td class="border border-black p-2 text-center">
                            {{ $item?->donor }}
                        </td>

                        <td class="border border-black p-2 text-center">
                            {{ $item?->donor_code }}
                        </td>

                    </tr>
                @endfor

                <tr class="font-bold">

                    <td colspan="3" class="border border-black text-center">
                        TOTAL
                    </td>

                    <td class="border border-black text-right p-2">
                        {{ number_format($totalAv, 2) }}
                    </td>

                    <td class="border border-black text-right p-2">
                        {{ number_format($totalActual, 2) }}
                    </td>

                    <td class="border border-black text-right p-2">
                        @if ($totalVariance < 0)
                            ({{ number_format(abs($totalVariance), 2) }})
                        @else
                            {{ number_format($totalVariance, 2) }}
                        @endif
                    </td>

                    <td class="border border-black text-right p-2">
                        {{ number_format($totalVariancePercent, 2) }}%
                    </td>

                    <td class="border border-black text-center">

                    </td>

                    <td class="border border-black text-center">

                    </td>

                    <td class="border border-black text-center">

                    </td>

                </tr>

            </tbody>

        </table>

        {{-- ADVANCE SECTION --}}
        <table class="w-full border-collapse text-sm">

            <tr>

                <td class="border border-black p-2 w-1/2">

                    <strong>Advance voucher #:</strong>

                    {{ $expenditureSummary->advance_voucher_no }}

                </td>

                <td class="border border-black p-2 w-1/2">

                    <strong>Advance Dated:</strong>

                    {{ $expenditureSummary->advance_date }}

                </td>

            </tr>

        </table>

        {{-- VARIANCE --}}
        <table class="w-full border-collapse text-xs">

            <tr>

                <td class="border border-black p-2">

                    There are the variance require to explain

                </td>

                <td class="border border-black p-2 w-20 text-center">

                    YES

                    {{ $expenditureSummary->variance_required ? '☑' : '☐' }}

                </td>

                <td class="border border-black p-2 w-20 text-center">

                    NO

                    {{ !$expenditureSummary->variance_required ? '☑' : '☐' }}

                </td>

            </tr>

            <tr>

                <td colspan="3" class="border border-black h-20 p-2">

                    {{ $expenditureSummary->variance_explanation }}

                </td>

            </tr>

        </table>

        {{-- LATE LIQUIDATION --}}
        <table class="w-full border-collapse text-xs">

            <tr>

                <td class="border border-black p-2">

                    There is late advance liquidation require to explain

                </td>

                <td class="border border-black p-2 w-20 text-center">

                    YES

                    {{ $expenditureSummary->late_liquidation ? '☑' : '☐' }}

                </td>

                <td class="border border-black p-2 w-20 text-center">

                    NO

                    {{ !$expenditureSummary->late_liquidation ? '☑' : '☐' }}

                </td>

            </tr>

            <tr>

                <td colspan="3" class="border border-black h-20 p-2">

                    {{ $expenditureSummary->late_liquidation_explanation }}

                </td>

            </tr>

        </table>

        {{-- Signature Section --}}
        <div class="bg-white px-12 py-8">

            <div class="flex justify-between">

                {{-- Prepared By --}}
                <div>

                    <p class="text-base">
                        <span class="font-bold">Prepared by:</span>
                        {{ $expenditureSummary->user?->name }}
                    </p>

                    <div class="h-28 flex items-start justify-start my-4">

                        @if ($expenditureSummary->prepared_signature)
                            <img src="{{ asset('storage/' . $expenditureSummary->prepared_signature) }}"
                                alt="Prepared Signature" class="max-h-24 object-contain">
                        @endif

                    </div>

                    <div class="space-y-2">
                        <p>
                            <span class="font-bold">Position:</span>
                            {{ $expenditureSummary->user?->position ?? '' }}
                        </p>

                        <p>
                            <span class="font-bold">Date:</span>
                            {{ \Carbon\Carbon::parse($expenditureSummary->date)->format('d M Y') }}
                        </p>

                    </div>

                </div>

                {{-- Reviewed By --}}
                <div>

                    <p class="text-base">
                        <span class="font-bold">Reviewed by:</span>
                        {{ $expenditureSummary->reviewer?->name ?? '' }}
                    </p>

                    <div class="h-28 flex items-center justify-center my-4">

                        @if ($expenditureSummary->reviewer_signature)
                            <img src="{{ asset('storage/' . $expenditureSummary->reviewer_signature) }}"
                                alt="Reviewer Signature" class="max-h-24 object-contain">
                        @endif

                    </div>

                    <div class="space-y-2">

                        <p>
                            <span class="font-bold">Position:</span>
                            {{ $expenditureSummary->reviewer?->position ?? '' }}
                        </p>

                        <p>
                            <span class="font-bold">Date:</span>

                            @if ($expenditureSummary->date)
                                {{ \Carbon\Carbon::parse($expenditureSummary->date)->format('d M Y') }}
                            @endif

                        </p>

                    </div>

                </div>


                {{-- Approved By --}}
                <div>

                    <p class="text-base">
                        <span class="font-bold">Reviewed by:</span>
                        {{ $expenditureSummary->approver?->name ?? '' }}
                    </p>

                    <div class="h-28 flex items-center justify-center my-4">

                        @if ($expenditureSummary->approved_signature)
                            <img src="{{ asset('storage/' . $expenditureSummary->approved_signature) }}"
                                alt="approver Signature" class="max-h-24 object-contain">
                        @endif

                    </div>

                    <div class="space-y-2">

                        <p>
                            <span class="font-bold">Position:</span>
                            {{ $expenditureSummary->approver?->position ?? '' }}
                        </p>

                        <p>
                            <span class="font-bold">Date:</span>

                            @if ($expenditureSummary->date)
                                {{ \Carbon\Carbon::parse($expenditureSummary->date)->format('d M Y') }}
                            @endif

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ===========================
            Manager Review
        =========================== --}}
        @if (auth()->user()->role?->name === 'Manager' &&
                auth()->user()->department_id == $expenditureSummary->user?->department_id &&
                $expenditureSummary->status === 'Pending Manager Approval')
            <form method="POST" action="{{ route('expenditure-summaries.approve-manager', $expenditureSummary) }}"
                enctype="multipart/form-data">

                @csrf

                <div class="bg-gray-50 border rounded-2xl p-5 mb-5">

                    <h4 class="font-semibold text-gray-800 mb-4">
                        Reviewer Signature
                    </h4>

                    <div class="flex gap-3 mb-4">

                        <button type="button" onclick="showReviewerCanvas()"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg">

                            Draw Signature

                        </button>

                        <button type="button" onclick="showReviewerUpload()"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg">

                            Upload Signature

                        </button>

                    </div>

                    <div id="reviewer-canvas-section">

                        <div class="border-2 border-dashed border-gray-300 rounded-xl overflow-hidden">

                            <canvas id="reviewer-signature-pad" class="w-full bg-white" height="200">
                            </canvas>

                        </div>

                        <input type="hidden" name="reviewer_signature" id="reviewer_signature">

                        <button type="button" id="clear-reviewer-signature"
                            class="mt-3 px-4 py-2 bg-red-500 text-white rounded-lg">

                            Clear

                        </button>

                    </div>

                    <div id="reviewer-upload-section" class="hidden">

                        <input type="file" name="reviewer_signature_upload" accept="image/*"
                            class="block w-full border rounded-lg p-3">

                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

                    <h3 class="font-semibold text-lg mb-4">

                        Approval Actions

                    </h3>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                        Review & Send to Final Approver

                    </button>

                </div>

            </form>
        @endif


        {{-- ===========================
            Final Approval
        =========================== --}}
        @if (auth()->id() == $expenditureSummary->approved_by && $expenditureSummary->status == 'Pending ED Approval')
            <form method="POST" action="{{ route('expenditure-summaries.approve-ed', $expenditureSummary) }}"
                enctype="multipart/form-data">

                @csrf

                <div class="bg-gray-50 border rounded-2xl p-5 mb-5">

                    <h4 class="font-semibold text-gray-800 mb-4">

                        Final Approver Signature

                    </h4>

                    <div class="flex gap-3 mb-4">

                        <button type="button" onclick="showApproverCanvas()"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg">

                            Draw Signature

                        </button>

                        <button type="button" onclick="showApproverUpload()"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg">

                            Upload Signature

                        </button>

                    </div>

                    <div id="approver-canvas-section">

                        <div class="border-2 border-dashed border-gray-300 rounded-xl overflow-hidden">

                            <canvas id="approver-signature-pad" class="w-full bg-white" height="200">
                            </canvas>

                        </div>

                        <input type="hidden" name="approved_signature" id="approved_signature">

                        <button type="button" id="clear-approver-signature"
                            class="mt-3 px-4 py-2 bg-red-500 text-white rounded-lg">

                            Clear

                        </button>

                    </div>

                    <div id="approver-upload-section" class="hidden">

                        <input type="file" name="approved_signature_upload" accept="image/*"
                            class="block w-full border rounded-lg p-3">

                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

                    <h3 class="font-semibold text-lg mb-4">

                        Approval Actions

                    </h3>

                    <div class="flex gap-3">

                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                            Final Approve

                        </button>

                    </div>

                </div>

            </form>

        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const reviewerCanvas = document.getElementById('reviewer-signature-pad');
            const approverCanvas = document.getElementById('approver-signature-pad');

            const reviewerPad = reviewerCanvas ?
                new SignaturePad(reviewerCanvas, {
                    penColor: '#1d4ed8',
                    minWidth: 1,
                    maxWidth: 2.5
                }) :
                null;

            const approverPad = approverCanvas ?
                new SignaturePad(approverCanvas, {
                    penColor: '#1d4ed8',
                    minWidth: 1,
                    maxWidth: 2.5
                }) :
                null;

            // ==========================
            // Resize Canvas
            // ==========================
            function resizeCanvas(canvas, pad) {
                if (!canvas || !pad) return;

                const ratio = Math.max(window.devicePixelRatio || 1, 1);

                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = 200 * ratio;

                const ctx = canvas.getContext('2d');
                ctx.setTransform(1, 0, 0, 1, 0, 0);
                ctx.scale(ratio, ratio)

                pad.clear();
            }

            resizeCanvas(reviewerCanvas, reviewerPad);
            resizeCanvas(approverCanvas, approverPad);

            window.addEventListener('resize', function() {
                resizeCanvas(reviewerCanvas, reviewerPad);
                resizeCanvas(approverCanvas, approverPad);
            });

            // ==========================
            // Trim Signature
            // ==========================
            function trimCanvas(canvas) {

                if (!canvas) return null;

                const ctx =
                    canvas.getContext('2d');

                const pixels =
                    ctx.getImageData(
                        0,
                        0,
                        canvas.width,
                        canvas.height
                    );

                let top = null;
                let left = null;
                let right = null;
                let bottom = null;

                for (let y = 0; y < canvas.height; y++) {

                    for (let x = 0; x < canvas.width; x++) {

                        const alpha =
                            pixels.data[
                                (y * canvas.width + x) * 4 + 3
                            ];

                        if (alpha > 0) {

                            if (top === null) top = y;

                            if (left === null || x < left)
                                left = x;

                            if (right === null || x > right)
                                right = x;

                            bottom = y;
                        }
                    }
                }

                if (top === null) {
                    return canvas;
                }

                const padding = 10;

                const trimmedCanvas =
                    document.createElement('canvas');

                const width =
                    (right - left) + padding * 2;

                const height =
                    (bottom - top) + padding * 2;

                trimmedCanvas.width = width;
                trimmedCanvas.height = height;

                trimmedCanvas
                    .getContext('2d')
                    .drawImage(
                        canvas,
                        left - padding,
                        top - padding,
                        width,
                        height,
                        0,
                        0,
                        width,
                        height
                    );

                return trimmedCanvas;
            }

            // ==========================
            // Resize Signature
            // ==========================
            function resizeSignature(canvas) {

                const maxWidth = 300;

                if (canvas.width <= maxWidth) {
                    return canvas;
                }

                const scale =
                    maxWidth / canvas.width;

                const resizedCanvas =
                    document.createElement('canvas');

                resizedCanvas.width =
                    maxWidth;

                resizedCanvas.height =
                    canvas.height * scale;

                resizedCanvas
                    .getContext('2d')
                    .drawImage(
                        canvas,
                        0,
                        0,
                        resizedCanvas.width,
                        resizedCanvas.height
                    );

                return resizedCanvas;
            }

            // =====================================
            // Reviewer Toggle
            // =====================================
            window.showReviewerCanvas = function() {

                document.getElementById('reviewer-canvas-section')
                    ?.classList.remove('hidden');

                document.getElementById('reviewer-upload-section')
                    ?.classList.add('hidden');

            };

            window.showReviewerUpload = function() {

                document.getElementById('reviewer-upload-section')
                    ?.classList.remove('hidden');

                document.getElementById('reviewer-canvas-section')
                    ?.classList.add('hidden');

            };

            // =====================================
            // Approver Toggle
            // =====================================
            window.showApproverCanvas = function() {

                document.getElementById('approver-canvas-section')
                    ?.classList.remove('hidden');

                document.getElementById('approver-upload-section')
                    ?.classList.add('hidden');

            };

            window.showApproverUpload = function() {

                document.getElementById('approver-upload-section')
                    ?.classList.remove('hidden');

                document.getElementById('approver-canvas-section')
                    ?.classList.add('hidden');

            };

            // ==========================
            // Clear Signature
            // ==========================
            document
                .getElementById('clear-reviewer-signature')
                ?.addEventListener(
                    'click',
                    function() {
                        reviewerPad?.clear();
                    }
                );

            const clearApproverBtn = document.getElementById('clear-approver-signature');

            if (clearApproverBtn && approverPad) {
                clearApproverBtn.addEventListener('click', function() {
                    approverPad.clear();
                });
            }

            // =====================================
            // Reviewer Form Submit
            // =====================================
            const reviewerForm =
                document.getElementById('reviewer_signature')
                ?.closest('form');

            reviewerForm?.addEventListener('submit', function() {

                if (reviewerPad && !reviewerPad.isEmpty()) {

                    let canvas = trimCanvas(reviewerCanvas);

                    canvas = resizeSignature(canvas);

                    if (canvas) {
                        document.getElementById('reviewer_signature').value =
                            canvas.toDataURL('image/png');
                    }
                }

            });

            // =====================================
            // Approver Form Submit
            // =====================================
            const approverForm =
                document.getElementById('approved_signature')
                ?.closest('form');

            approverForm?.addEventListener('submit', function() {

                if (approverPad && !approverPad.isEmpty()) {

                    let canvas = trimCanvas(approverCanvas);

                    canvas = resizeSignature(canvas);

                    if (canvas) {
                        document.getElementById('approved_signature').value =
                            canvas.toDataURL('image/png');
                    }
                }

            });

        });
    </script>
@endsection
