@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        <form action="{{ route('fund-requests.update', $fundRequest) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-6">
                <div class="px-6 py-5 border-b">
                    <h1 class="text-2xl font-bold text-green-600">
                        Fund Request Form
                    </h1>
                    <p class="text-sm text-gray-500">
                        Complete the information below and submit for approval.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                <div class="p-6">

                    <div class="grid md:grid-cols-5 gap-6">

                        <div class="col-span-3">
                            <label class="block text-sm font-medium mb-2">
                                Request Title *
                            </label>
                            <input type="text" name="title" required value="{{ old('title', $fundRequest->title) }}"
                                class="w-full rounded-xl border-gray-300 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Request Date *
                            </label>
                            <input type="date" name="request_date" required
                                value="{{ old('request_date', \Carbon\Carbon::parse($fundRequest->request_date)->format('Y-m-d')) }}"
                                class="w-full rounded-xl border-gray-300 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Place
                            </label>

                            <input type="text" name="place" value="{{ old('place', $fundRequest->place) }}"
                                class="w-full rounded-xl border-gray-300">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-1 gap-6 mt-5">

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Rationale
                            </label>

                            <textarea name="rationale" rows="5" class="w-full rounded-xl border-gray-300">{{ old('rationale', $fundRequest->rationale) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Objectives
                            </label>

                            <textarea name="objectives" rows="5" class="w-full rounded-xl border-gray-300">{{ old('objectives', $fundRequest->objectives) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Expected Results
                            </label>

                            <textarea name="expectation" rows="5" class="w-full rounded-xl border-gray-300">{{ old('expectation', $fundRequest->expectation) }}</textarea>
                        </div>

                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium mb-2">
                            Participants
                        </label>

                        <textarea name="participant_list" rows="4" class="w-full rounded-xl border-gray-300">{{ old('participant_list', $fundRequest->participant_list) }}</textarea>
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium mb-2">
                            Collaboration with Partner
                        </label>

                        <textarea name="fund_by" rows="4" class="w-full rounded-xl border-gray-300">{{ old('fund_by', $fundRequest->fund_by) }}</textarea>
                    </div>

                </div>
            </div>

            <!-- Activity Agenda -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6">

                <div class="flex items-center justify-between px-6 py-5 border-b">

                    <div>
                        <h2 class="text-lg font-semibold text-green-700">
                            Activity Agenda
                        </h2>

                        <p class="text-sm text-slate-500">
                            Planned schedule and responsible person.
                        </p>
                    </div>

                </div>

                <div id="agendaTable" class="p-6 space-y-4">

                    @forelse($fundRequest->agendas as $agenda)
                        <div class="agenda-row flex gap-4 items-start border rounded-xl p-4 bg-slate-50">

                            <div>

                                <label class="text-xs font-medium text-slate-500">
                                    Time
                                </label>

                                <div class="flex gap-4 mt-1">

                                    <input type="time" name="agenda_start_time[]"
                                        value="{{ \Carbon\Carbon::parse($agenda->start_time)->format('H:i') }}"
                                        class="w-full border rounded-lg px-2 py-5">

                                    <input type="time" name="agenda_end_time[]"
                                        value="{{ \Carbon\Carbon::parse($agenda->end_time)->format('H:i') }}"
                                        class="w-full border rounded-lg px-2 py-5">

                                </div>

                            </div>

                            <div class="flex-1">

                                <label class="text-xs font-medium text-slate-500">
                                    Activity
                                </label>

                                <textarea name="agenda_activity[]" rows="2"
                                    class="w-full border rounded-lg px-3 py-2 mt-1 resize-y focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('agenda_activity.' . $loop->index, $agenda->activity) }}</textarea>


                            </div>

                            <div class="w-64">

                                <label class="text-xs font-medium text-slate-500">
                                    Responsible Person
                                </label>

                                <input type="text" name="agenda_responsible_person[]"
                                    value="{{ $agenda->responsible_person }}"
                                    class="w-full border rounded-lg px-3 py-5 mt-1">

                            </div>

                            <div class="w-56">

                                <label class="text-xs font-medium text-slate-500">
                                    Remarks
                                </label>

                                <input type="text" name="agenda_remarks[]" value="{{ $agenda->remarks }}"
                                    class="w-full border rounded-lg px-3 py-5 mt-1">

                            </div>

                            <button type="button" onclick="removeAgendaRow(this)" class="text-red-600 mt-12">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    @empty

                        <div class="agenda-row flex gap-4 items-start border rounded-xl p-4 bg-slate-50">

                            <div>

                                <label class="text-xs font-medium text-slate-500">
                                    Time
                                </label>

                                <div class="flex gap-4 mt-1">

                                    <input type="time" name="agenda_start_time[]"
                                        class="w-full border rounded-lg px-2 py-5">

                                    <input type="time" name="agenda_end_time[]"
                                        class="w-full border rounded-lg px-2 py-5">

                                </div>

                            </div>

                            <div class="flex-1">

                                <label class="text-xs font-medium text-slate-500">
                                    Activity
                                </label>

                                <textarea name="agenda_activity[]" rows="2"
                                    class="w-full border rounded-lg px-3 py-2 mt-1 resize-y focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                    placeholder="Activity description"></textarea>

                            </div>

                            <div class="w-64">

                                <label class="text-xs font-medium text-slate-500">
                                    Responsible Person
                                </label>

                                <input type="text" name="agenda_responsible_person[]"
                                    class="w-full border rounded-lg px-3 py-5 mt-1">

                            </div>

                            <div class="w-56">

                                <label class="text-xs font-medium text-slate-500">
                                    Remarks
                                </label>

                                <input type="text" name="agenda_remarks[]"
                                    class="w-full border rounded-lg px-3 py-5 mt-1">

                            </div>

                            <button type="button" onclick="removeAgendaRow(this)" class="text-red-600 mt-12">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>
                    @endforelse

                </div>

                <div class="flex justify-end px-6 py-5">
                    <button type="button" onclick="addAgendaRow()" class="px-4 py-2 bg-green-600 text-white rounded-xl">

                        <i class="fas fa-plus mr-2"></i>
                        Add Item

                    </button>
                </div>

            </div>

            {{-- Donor --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-6">

                <div class="px-6 py-5 border-b">
                    <h2 class="text-lg font-semibold text-green-700">
                        Choose Logo of Donors
                    </h2>

                    <p class="text-sm text-gray-500">
                        You can choose one or more donors.
                    </p>
                </div>

                <div class="p-6">

                    <div class="flex flex-wrap gap-10">

                        @foreach ($donors as $donor)
                            <label class="flex items-center gap-3 cursor-pointer">

                                <input type="checkbox" name="donor_logo_ids[]" value="{{ $donor->id }}"
                                    class="h-5 w-5 rounded border-gray-300 text-green-600 focus:ring-green-500"
                                    {{ in_array($donor->id, old('donor_logo', $fundRequest->donorLogos->pluck('id')->toArray())) ? 'checked' : '' }}>

                                <span class="font-medium text-gray-700">
                                    {{ $donor->name }}
                                </span>

                            </label>
                        @endforeach

                    </div>

                </div>

            </div>


            <!-- Budget -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-6">

                <div class="flex justify-between items-center px-6 py-4 border-b">

                    <h2 class="font-semibold text-lg text-green-600">
                        Budget Details
                    </h2>

                </div>

                <div class="p-6">

                    <div id="budget-container">

                        @foreach ($fundRequest->items as $index => $item)
                            <div class="budget-row border rounded-xl p-5 mb-5">

                                <div class="flex justify-between items-center mb-5">

                                    <h3 class="font-semibold text-green-700">
                                        Budget Item #{{ $index + 1 }}
                                    </h3>

                                    <button type="button" onclick="removeBudget(this)"
                                        class="text-red-500 hover:text-red-700">

                                        ✕

                                    </button>

                                </div>

                                <div class="mb-4">
                                    <label class="text-sm font-medium">
                                        Description
                                    </label>

                                    <textarea name="description[]" required rows="1" class="w-full rounded-xl border-gray-300 mt-1">{{ $item->description }}</textarea>
                                </div>

                                <div class="grid md:grid-cols-7 gap-4">

                                    <div>
                                        <label class="text-sm font-medium">
                                            Quantity
                                        </label>
                                        <input type="number" name="quantity[]" value="{{ $item->quantity }}"
                                            class="quantity w-full rounded-lg border-green-300 mt-1"
                                            oninput="calculateBudget(this)">
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium">
                                            Unit Cost
                                        </label>
                                        <input type="number" name="cost[]" value="{{ $item->cost }}"
                                            class="cost w-full rounded-lg border-green-300 mt-1"
                                            oninput="calculateBudget(this)">
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium">
                                            Time
                                        </label>
                                        <input type="number" name="time[]" value="{{ $item->time }}"
                                            class="time w-full rounded-lg border-green-300 mt-1"
                                            oninput="calculateBudget(this)">
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium">
                                            Total
                                        </label>
                                        <input type="text" readonly value="{{ number_format($item->budget, 2) }}"
                                            class="budget-total w-full rounded-lg bg-green-50 border-green-300 mt-1">
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium">
                                            Budget Code
                                        </label>
                                        <input type="text" name="budget_code[]" value="{{ $item->budget_code }}"
                                            class="w-full rounded-lg border-green-300 mt-1">
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium">
                                            Donor Code
                                        </label>
                                        <input type="text" name="donor_code[]" placeholder="Donor code"
                                            value="{{ $item->donor_code }}"
                                            class="w-full rounded-lg border-green-300 mt-1">
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium">
                                            Donor
                                        </label>
                                        <input type="text" name="donor[]" placeholder="Donor"
                                            value="{{ $item->donor }}" class="w-full rounded-lg border-green-300 mt-1">
                                    </div>

                                </div>

                                <div class="mt-4">

                                    <input type="text" name="remarks[]" value="{{ $item->remarks }}"
                                        class="w-full rounded-lg border-gray-300">

                                </div>

                            </div>
                        @endforeach

                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-xl p-5 mt-4">

                        <div class="flex justify-between items-center">

                            <span class="font-semibold text-gray-700">
                                Total Budget
                            </span>

                            <span id="grand-total" class="text-2xl font-bold text-green-600">
                                $0.00
                            </span>

                        </div>

                    </div>

                </div>

                <div class="flex justify-end px-6 py-5">
                    <button type="button" onclick="addBudget()"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        + Add Budget
                    </button>
                </div>

            </div>

            {{-- ===================================== --}}
            {{-- Manager Approval --}}
            {{-- ===================================== --}}

            @if (auth()->user()->role?->name == 'Manager' && $fundRequest->status == 'Pending Manager Approval')
                <div class="bg-white rounded-2xl shadow border mb-6">

                    <div class="px-6 py-5 border-b">

                        <h2 class="text-xl font-semibold text-green-700">
                            Manager Review
                        </h2>

                        <p class="text-gray-500 text-sm">
                            Review, edit, sign and forward to final approver.
                        </p>

                    </div>

                    <div class="p-6">

                        <div class="mb-4">

                            <button type="button" onclick="showReviewerCanvas()"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg">

                                Draw Signature

                            </button>

                            <button type="button" onclick="showReviewerUpload()"
                                class="px-4 py-2 bg-gray-600 text-white rounded-lg">

                                Upload Signature

                            </button>

                        </div>

                        {{-- Canvas --}}

                        <div id="reviewer-canvas-section">

                            <div class="border rounded-xl p-2">

                                <canvas id="reviewer-signature-pad" class="w-full" style="height:200px;">
                                </canvas>

                            </div>

                            <input type="hidden" id="reviewer_signature" name="reviewer_signature">

                            <button type="button" id="clear-reviewer-signature"
                                class="mt-3 px-4 py-2 bg-red-600 text-white rounded">

                                Clear

                            </button>

                        </div>

                        {{-- Upload --}}

                        <div id="reviewer-upload-section" class="hidden mt-4">

                            <input type="file" name="reviewer_signature_upload" class="block w-full">

                        </div>

                    </div>

                </div>
            @endif


            {{-- ===================================== --}}
            {{-- Final Approval --}}
            {{-- ===================================== --}}

            @if (auth()->id() == $fundRequest->approved_by && $fundRequest->status == 'Pending ED Approval')
                <div class="bg-white rounded-2xl shadow border mb-6">

                    <div class="px-6 py-5 border-b">

                        <h2 class="text-xl font-semibold text-green-700">

                            Final Approval

                        </h2>

                        <p class="text-gray-500 text-sm">

                            Review and approve this request.

                        </p>

                    </div>

                    <div class="p-6">

                        <div class="mb-4">

                            <button type="button" onclick="showApproverCanvas()"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg">

                                Draw Signature

                            </button>

                            <button type="button" onclick="showApproverUpload()"
                                class="px-4 py-2 bg-gray-600 text-white rounded-lg">

                                Upload Signature

                            </button>

                        </div>

                        {{-- Canvas --}}

                        <div id="approver-canvas-section">

                            <div class="border rounded-xl p-2">

                                <canvas id="approver-signature-pad" class="w-full" style="height:200px;">
                                </canvas>

                            </div>

                            <input type="hidden" id="approved_signature" name="approved_signature">

                            <button type="button" id="clear-approver-signature"
                                class="mt-3 px-4 py-2 bg-red-600 text-white rounded">

                                Clear

                            </button>

                        </div>

                        {{-- Upload --}}

                        <div id="approver-upload-section" class="hidden mt-4">

                            <input type="file" name="approved_signature_upload" class="block w-full">

                        </div>

                    </div>

                </div>
            @endif


            {{-- ===================================== --}}
            {{-- Footer --}}
            {{-- ===================================== --}}

            <div class="sticky bottom-0 bg-white rounded-2xl shadow-xl border p-5">

                <div class="flex justify-end gap-3">

                    <a href="{{ route('fund-requests.index') }}" class="px-6 py-2 rounded-lg border">

                        Cancel

                    </a>

                    <button type="submit" name="action" value="save"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                        Save Changes

                    </button>

                    @if (
                        (auth()->user()->role?->name == 'Manager' && $fundRequest->status == 'Pending Manager Approval') ||
                            (auth()->id() == $fundRequest->approved_by && $fundRequest->status == 'Pending ED Approval'))
                        <button type="submit" name="action" value="approve"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">

                            Save & Approve

                        </button>
                    @endif

                </div>

            </div>

        </form>

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

        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.budget-row').forEach(row => {
                calculateBudgetRow(row);
            });

            updateGrandTotal();
        });

        // ==========================
        // Budget
        // ==========================

        window.addBudget = function() {

            const count = document.querySelectorAll('.budget-row').length + 1;

            const html = `
                <div class="budget-row bg-slate-50 border border-slate-200 rounded-2xl p-6 mb-5">

                    <div class="flex justify-between items-center mb-5">

                        <h3 class="font-semibold text-green-700">
                            Budget Item #${count}
                        </h3>

                        <button
                            type="button"
                            onclick="removeBudget(this)"
                            class="text-red-500 hover:text-red-700">

                            <i class="fas fa-times"></i>

                        </button>

                    </div>

                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Description
                        </label>

                        <textarea
                            name="description[]"
                            rows="1"
                            required
                            class="w-full rounded-xl border-gray-300"></textarea>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-7 gap-4">

                        <div>

                            <label class="text-sm font-medium">
                                Quantity
                            </label>

                            <input
                                type="number"
                                name="quantity[]"
                                min="1"
                                value="1"
                                class="quantity w-full rounded-xl border-green-300 mt-1"
                                oninput="calculateBudget(this)">

                        </div>

                        <div>

                            <label class="text-sm font-medium">
                                Unit Cost
                            </label>

                            <input
                                type="number"
                                name="cost[]"
                                min="0"
                                value="0"
                                class="cost w-full rounded-xl border-green-300 mt-1"
                                oninput="calculateBudget(this)">

                        </div>

                        <div>

                            <label class="text-sm font-medium">
                                Time
                            </label>

                            <input
                                type="number"
                                name="time[]"
                                min="1"
                                value="1"
                                class="time w-full rounded-xl border-green-300 mt-1"
                                oninput="calculateBudget(this)">

                        </div>

                        <div>

                            <label class="text-sm font-medium">
                                Total
                            </label>

                            <input
                                type="text"
                                readonly
                                value="0.00"
                                class="budget-total w-full rounded-xl bg-green-50 border-green-300 mt-1">

                        </div>

                        <div>

                            <label class="text-sm font-medium">
                                Budget Code
                            </label>

                            <input
                                type="text"
                                name="budget_code[]"
                                class="w-full rounded-xl border-green-300 mt-1">

                        </div>

                        <div>

                            <label class="text-sm font-medium">
                                Donor Code
                            </label>

                            <input
                                type="text"
                                name="donor_code[]"
                                placeholder="Select or type donor"
                                class="w-full rounded-xl border-green-300 mt-1">

                        </div>

                        <div>

                            <label class="text-sm font-medium">
                                Donor
                            </label>

                            <input
                                type="text"
                                name="donor[]"
                                placeholder="Select or type donor"
                                class="w-full rounded-xl border-green-300 mt-1">

                        </div>

                    </div>

                    <div class="mt-4">

                        <textarea
                            name="remarks[]"
                            rows="1"
                            class="w-full rounded-xl border-gray-300"
                            placeholder="Remarks"></textarea>

                    </div>

                </div>
                `;

            document
                .getElementById('budget-container')
                .insertAdjacentHTML('beforeend', html);

            updateGrandTotal();
        };

        window.removeBudget = function(button) {

            const rows = document.querySelectorAll('.budget-row');

            if (rows.length <= 1) {
                return;
            }

            button.closest('.budget-row').remove();

            document.querySelectorAll('.budget-row').forEach((row, index) => {
                row.querySelector('h3').innerText = `Budget Item #${index + 1}`;
            });

            updateGrandTotal();
        };

        window.calculateBudget = function(element) {

            const row = element.closest('.budget-row');

            calculateBudgetRow(row);
        };

        function calculateBudgetRow(row) {

            const quantity =
                parseFloat(row.querySelector('.quantity').value) || 0;

            const cost =
                parseFloat(row.querySelector('.cost').value) || 0;

            const time =
                parseFloat(row.querySelector('.time').value) || 0;

            const total = quantity * cost * time;

            row.querySelector('.budget-total').value =
                total.toFixed(2);

            updateGrandTotal();
        }

        function updateGrandTotal() {

            let grandTotal = 0;

            document.querySelectorAll('.budget-total').forEach(item => {

                grandTotal += parseFloat(item.value) || 0;

            });

            document.getElementById('grand-total').innerText =
                '$' + grandTotal.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
        }

        // ==========================
        // Agenda
        // ==========================

        window.addAgendaRow = function() {

            const html = `
                <div class="agenda-row flex gap-4 items-start border rounded-xl p-4 bg-slate-50">

                    <div>

                        <label class="text-xs font-medium text-slate-500">
                            Time
                        </label>

                        <div class="flex gap-3 mt-1">

                            <input
                                type="time"
                                name="agenda_start_time[]"
                                class="border rounded-lg px-2 py-5">

                            <input
                                type="time"
                                name="agenda_end_time[]"
                                class="border rounded-lg px-2 py-5">

                        </div>

                    </div>

                    <div class="flex-1">

                        <label class="text-xs font-medium text-slate-500">
                            Activity
                        </label>

                        <textarea
                            name="agenda_activity[]"
                            rows="2"
                            class="w-full border rounded-lg px-3 py-2 mt-1 resize-y focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="Activity description"></textarea>

                    </div>

                    <div class="w-64">

                        <label class="text-xs font-medium text-slate-500">
                            Responsible Person
                        </label>

                        <input
                            type="text"
                            name="agenda_responsible_person[]"
                            class="w-full border rounded-lg px-3 py-5 mt-1">

                    </div>

                    <div class="w-56">

                        <label class="text-xs font-medium text-slate-500">
                            Remarks
                        </label>

                        <input
                            type="text"
                            name="agenda_remarks[]"
                            class="w-full border rounded-lg px-3 py-5 mt-1">

                    </div>

                    <button
                        type="button"
                        onclick="removeAgendaRow(this)"
                        class="text-red-600 mt-12 hover:text-red-700">

                        <i class="fas fa-trash"></i>

                    </button>

                </div>
                `;

            document
                .getElementById('agendaTable')
                .insertAdjacentHTML('beforeend', html);
        };

        window.removeAgendaRow = function(button) {
            const rows = document.querySelectorAll('#agendaTable .agenda-row');

            if (rows.length <= 1) {
                return;
            }

            button.closest('.agenda-row').remove();
        };
    </script>
@endsection
