@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto space-y-4">

        <div class="bg-gradient-to-r from-green-600 via-emerald-600 to-green-700 rounded-3xl shadow-xl overflow-hidden">

            <div class="p-8">

                <div class="flex justify-between items-start">

                    <div>

                        <h1 class="text-3xl font-bold text-white mt-4">
                            {{ $fundRequest->title }}
                        </h1>

                        <p class="text-green-100 mt-2">
                            Submitted by {{ $fundRequest->user?->name }}
                        </p>

                    </div>

                    <a href="{{ route('fund-requests.index') }}"
                        class="bg-white text-green-600 px-5 py-2 rounded-xl font-medium hover:shadow-lg">

                        Back

                    </a>

                </div>

            </div>

        </div>

        <div class="grid lg:grid-cols-4 gap-6">

            {{-- Budget --}}
            <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl shadow-xl p-6 text-white">

                <div class="flex justify-between items-start">

                    <div>

                        <p class="text-green-100 text-sm">
                            Total Budget
                        </p>

                        <h2 class="text-3xl font-bold mt-2">
                            ${{ number_format($fundRequest->total_budget, 2) }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center">

                        <i class="fas fa-dollar-sign text-2xl"></i>

                    </div>

                </div>

            </div>

            {{-- Location --}}
            <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition">

                <div class="flex justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Location
                        </p>

                        <h3 class="text-xl font-bold text-slate-800 mt-2">
                            {{ $fundRequest->place ?? 'N/A' }}
                        </h3>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">

                        <i class="fas fa-building"></i>

                    </div>

                </div>

            </div>

            {{-- Date --}}
            <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition">

                <div class="flex justify-between">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Request Date
                        </p>

                        <h3 class="text-xl font-bold text-slate-800 mt-2">
                            {{ \Carbon\Carbon::parse($fundRequest->request_date)->format('d M Y') }}
                        </h3>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">

                        <i class="fas fa-calendar-alt"></i>

                    </div>

                </div>

            </div>

            {{-- Status --}}
            <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition">

                <p class="text-gray-500 text-sm mb-3">
                    Approval Status
                </p>

                @if ($fundRequest->status == 'Approved')
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-full font-semibold">

                        <i class="fas fa-check-circle"></i>
                        Approved

                    </div>
                @elseif($fundRequest->status == 'Rejected')
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 text-red-700 rounded-full font-semibold">

                        <i class="fas fa-times-circle"></i>
                        Rejected

                    </div>
                @elseif($fundRequest->status == 'Pending ED Approval')
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-full font-semibold">

                        <i class="fas fa-user-tie"></i>
                        ED Review

                    </div>
                @else
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full font-semibold">

                        <i class="fas fa-clock"></i>
                        Manager Review

                    </div>
                @endif

            </div>

        </div>

        {{-- Objectives --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <h3 class="font-semibold text-lg text-green-700">
                Rationale
            </h3>

            <div class="text-gray-700 whitespace-pre-line">
                {{ $fundRequest->rationale }}
            </div>

        </div>

        {{-- Objectives --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <h3 class="font-semibold text-lg text-green-700">
                Objectives
            </h3>

            <div class="text-gray-700 whitespace-pre-line">
                {{ $fundRequest->objectives }}
            </div>

        </div>

        {{-- Expected Results --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <h3 class="font-semibold text-lg text-green-700">
                Expected Results
            </h3>

            <div class="text-gray-700 whitespace-pre-line">
                {{ $fundRequest->expectation }}
            </div>

        </div>

        {{-- Participants List --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <h3 class="font-semibold text-lg text-green-700">
                Participants List
            </h3>

            <div class="text-gray-700 whitespace-pre-line">
                {{ $fundRequest->participant_list }}
            </div>

        </div>

        {{-- Collaboration with Partner --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <h3 class="font-semibold text-lg text-green-700">
                Collaboration with Partner
            </h3>

            <div class="text-gray-700 whitespace-pre-line">
                {{ $fundRequest->fund_by }}
            </div>

        </div>

        {{-- Budget Items --}}
        {{-- Budget Items --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

            <div class="px-6 py-4 border-b">
                <h2 class="font-semibold text-lg text-green-700">
                    Budget Details
                </h2>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full border border-gray-300">

                    <thead>

                        <tr class="bg-lime-500 text-black">

                            <th rowspan="3" class="border px-1 py-2 text-center">
                                No.
                            </th>

                            <th rowspan="3" class="border px-3 py-2 text-center w-96">
                                Description
                            </th>

                            <th colspan="3" class="border px-3 py-2 text-center">
                                Detail Budget Calculation
                            </th>

                            <th rowspan="2" class="border px-3 py-2 text-center">
                                Total
                            </th>

                            <th rowspan="3" class="border px-3 py-2 text-center">
                                Budget Code
                            </th>

                            <th rowspan="3" class="border px-3 py-2 text-center">
                                Donor Code
                            </th>

                            <th rowspan="3" class="border px-3 py-2 text-center">
                                Donor
                            </th>

                            <th rowspan="3" class="border px-3 py-2 text-center">
                                Remarks
                            </th>

                        </tr>

                        <tr class="bg-lime-500 text-black">

                            <th class="border px-3 py-2 text-center">
                                Cost
                            </th>

                            <th class="border px-3 py-2 text-center">
                                Quantity
                            </th>

                            <th class="border px-3 py-2 text-center">
                                Time
                            </th>

                        </tr>

                        <tr class="bg-lime-500 text-black">

                            <th class="border px-3 py-2 text-center">
                                1
                            </th>

                            <th class="border px-3 py-2 text-center">
                                2
                            </th>

                            <th class="border px-3 py-2 text-center">
                                3
                            </th>

                            <th class="border px-3 py-2 text-center">
                                4 = 1 * 2 * 3
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($fundRequest->items as $item)
                            <tr>

                                <td class="border px-1 py-2 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $item->description }}
                                </td>

                                <td class="border px-3 py-2 text-center">
                                    {{ number_format($item->cost, 2) }} $
                                </td>

                                <td class="border px-3 py-2 text-center">
                                    {{ $item->quantity }}
                                </td>

                                <td class="border px-3 py-2 text-center">
                                    {{ $item->time }}
                                </td>

                                <td class="border px-3 py-2 text-right font-semibold">
                                    {{ number_format($item->budget, 2) }} $
                                </td>

                                <td class="border px-3 py-2 text-center">
                                    {{ $item->budget_code }}
                                </td>

                                <td class="border px-3 py-2 text-center">
                                    {{ $item->donor_code }}
                                </td>

                                <td class="border px-3 py-2 text-center">
                                    {{ $item->donor }}
                                </td>

                                <td class="border px-3 py-2 text-center">
                                    {{ $item->remarks }}
                                </td>

                            </tr>
                        @endforeach

                        <tr>

                            <td colspan="5" class="border px-3 py-2 text-center font-bold text-lg">

                                TOTAL

                            </td>

                            <td class="border px-3 py-2 text-right font-bold text-lg">

                                {{ number_format($fundRequest->total_budget, 2) }} $

                            </td>

                            <td colspan="3" class="border-0"></td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Activity Agenda --}}
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b bg-gray-50">

                <h3 class="text-lg font-semibold text-green-700">
                    Activity Agenda
                </h3>

            </div>

            <div class="overflow-x-auto">

                @if ($fundRequest->agendas->count())
                    <table class="min-w-full">

                        <thead class="bg-green-50">

                            <tr>

                                <th class="px-3 py-3 text-left text-sm font-semibold text-green-700">
                                    #
                                </th>

                                <th class="px-6 py-3 text-left text-sm font-semibold text-green-700">
                                    <i class="fas fa-clock text-xs"></i> Time
                                </th>

                                <th class="px-6 py-3 text-left text-sm font-semibold text-green-700">
                                    Activity
                                </th>

                                <th class="px-6 py-3 text-left text-sm font-semibold text-green-700">
                                    Responsible Person
                                </th>

                                <th class="px-6 py-3 text-left text-sm font-semibold text-green-700">
                                    Remarks
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach ($fundRequest->agendas as $agenda)
                                <tr class="hover:bg-green-100">

                                    <td class="px-3 py-2">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-2">

                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-50 text-green-700 text-sm font-medium">

                                            {{ \Carbon\Carbon::parse($agenda->start_time)->format('g:i A') }}
                                            -
                                            {{ \Carbon\Carbon::parse($agenda->end_time)->format('g:i A') }}

                                        </span>

                                    </td>

                                    <td class="px-6 py-2 w-[700px]">

                                        {!! nl2br(e($agenda->activity)) !!}

                                    </td>

                                    <td class="px-6 py-2">

                                        {{ $agenda->responsible_person ?: ' ' }}

                                    </td>

                                    <td class="px-6 py-2">

                                        {{ $agenda->remarks ?: ' ' }}

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <div class="text-center py-10">

                        <p class="text-gray-500">
                            No activity agenda available.
                        </p>

                    </div>
                @endif

            </div>

        </div>

        {{-- Signature Section --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 py-10 px-12 mt-8">

            <div class="w-full flex">

                {{-- Prepared By --}}
                <div class="w-[43%]">

                    <p class="text-lg font-semibold">
                        Prepared By
                    </p>

                    <p class="mt-2">
                        {{ $fundRequest->user?->name }}
                    </p>

                    <div class="h-20 flex items-center justify-start my-4">

                        @if ($fundRequest->requester_signature)
                            <img src="{{ asset('storage/' . $fundRequest->requester_signature) }}"
                                alt="Prepared Signature" class="max-h-16 object-contain">
                        @endif

                    </div>

                    <div class="space-y-2 text-sm">

                        <p>
                            <strong>Position:</strong>
                            {{ $fundRequest->user?->position }}
                        </p>

                        <p>
                            <strong>Date:</strong>
                            {{ optional($fundRequest->request_date)->format('d M Y') }}
                        </p>

                    </div>

                </div>

                {{-- Reviewed By --}}
                <div class="w-[43%]">

                    <p class="text-lg font-semibold">
                        Reviewed By
                    </p>

                    <p class="mt-2">
                        {{ $fundRequest->reviewer?->name ?? 'Pending Review' }}
                    </p>

                    <div class="h-20 flex items-center justify-start my-4">

                        @if ($fundRequest->reviewer_signature)
                            <img src="{{ asset('storage/' . $fundRequest->reviewer_signature) }}"
                                alt="Reviewer Signature" class="max-h-16 object-contain">
                        @endif

                    </div>

                    <div class="space-y-2 text-sm">

                        <p>
                            <strong>Position:</strong>
                            {{ $fundRequest->reviewer?->position ?? '-' }}
                        </p>

                        <p>
                            <strong>Date:</strong>
                            {{ optional($fundRequest->request_date)->format('d M Y') }}
                        </p>

                    </div>

                </div>

                {{-- Approved By --}}
                <div class="w-[15%]">

                    <p class="text-lg font-semibold">
                        Approved By
                    </p>

                    <p class="mt-2">
                        {{ $fundRequest->approver?->name ?? 'Pending Approval' }}
                    </p>

                    <div class="h-20 flex items-center justify-start my-4">

                        @if ($fundRequest->approved_signature)
                            <img src="{{ asset('storage/' . $fundRequest->approved_signature) }}"
                                alt="Approved Signature" class="max-h-16 object-contain">
                        @endif

                    </div>

                    <div class="space-y-2 text-sm">

                        <p>
                            <strong>Position:</strong>
                            {{ $fundRequest->approver?->position ?? '-' }}
                        </p>

                        <p>
                            <strong>Date:</strong>
                            {{ optional($fundRequest->request_date)->format('d M Y') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Manager Review --}}
        @if (auth()->user()->role?->name == 'Manager' &&
                auth()->user()->department_id == $fundRequest->department_id &&
                $fundRequest->status == 'Pending Manager Approval')
            <form method="POST" action="{{ route('fund-requests.approve-manager', $fundRequest) }}"
                enctype="multipart/form-data">

                @csrf

                {{-- Signature Section --}}
                <div class="bg-gray-50 border rounded-2xl p-5 mb-5">

                    <h4 class="font-semibold text-gray-800 mb-4">
                        Reviewer Signature
                    </h4>

                    <div class="flex gap-3 mb-4">

                        <button type="button" onclick="showReviewerCanvas()"
                            class="reviewer-tab px-4 py-2 bg-indigo-600 text-white rounded-lg">
                            Draw Signature
                        </button>

                        <button type="button" onclick="showReviewerUpload()"
                            class="reviewer-tab px-4 py-2 bg-green-600 text-white rounded-lg">
                            Upload Signature
                        </button>

                    </div>

                    <div id="reviewer-canvas-section">

                        <div class="border-2 border-dashed border-gray-300 rounded-xl overflow-hidden">

                            <canvas id="reviewer-signature-pad" class="w-full bg-white" height="200"></canvas>

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

                {{-- Actions --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

                    <h3 class="font-semibold text-lg mb-4">
                        Approval Actions
                    </h3>

                    <div class="flex gap-3">

                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                            Approve

                        </button>

                    </div>

                </div>

            </form>
        @endif

        {{-- Final Approver (Manager or ED) --}}
        @if (auth()->id() == $fundRequest->approved_by &&
                in_array($fundRequest->status, ['Pending Approval', 'Pending ED Approval']))
            <form method="POST" action="{{ route('fund-requests.approve-ed', $fundRequest) }}"
                enctype="multipart/form-data">

                @csrf

                <div class="bg-gray-50 border rounded-2xl p-5 mb-5">

                    <h4 class="font-semibold text-gray-800 mb-4">
                        Approver Signature
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

                    {{-- Canvas --}}
                    <div id="approver-canvas-section">

                        <div class="border-2 border-dashed border-gray-300 rounded-xl overflow-hidden">

                            <canvas id="approver-signature-pad" class="w-full bg-white" height="200"></canvas>

                        </div>

                        <input type="hidden" name="approved_signature" id="approved_signature">

                        <button type="button" id="clear-approver-signature"
                            class="mt-3 px-4 py-2 bg-red-500 text-white rounded-lg">

                            Clear

                        </button>

                    </div>

                    {{-- Upload --}}
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
