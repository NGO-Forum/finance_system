@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        <form id="fund-request-form" action="{{ route('fund-requests.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-6">
                <div class="px-6 py-5 border-b">
                    <h1 class="text-2xl font-bold text-green-600">
                        Concept Note Form
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
                            <input type="text" name="title" required
                                class="w-full rounded-xl border-gray-300 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Request Date *
                            </label>
                            <input type="date" name="request_date" required value="{{ date('Y-m-d') }}"
                                class="w-full rounded-xl border-gray-300 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Place
                            </label>

                            <input type="text" name="place" class="w-full rounded-xl border-gray-300">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-1 gap-6 mt-5">

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Rationale
                            </label>

                            <textarea name="rationale" rows="7" class="w-full rounded-xl border-gray-300"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Objectives
                            </label>

                            <textarea name="objectives" rows="7" class="w-full rounded-xl border-gray-300"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Expected Results
                            </label>

                            <textarea name="expectation" rows="7" class="w-full rounded-xl border-gray-300"></textarea>
                        </div>

                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium mb-2">
                            Participants
                        </label>

                        <textarea name="participant_list" rows="7" class="w-full rounded-xl border-gray-300"></textarea>
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium mb-2">
                            Collaboration with Partner
                        </label>

                        <textarea name="fund_by" rows="7" class="w-full rounded-xl border-gray-300"></textarea>
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

                    <div class="agenda-row flex gap-4 items-start border rounded-xl p-4 bg-slate-50">

                        <div>

                            <label class="text-xs font-medium text-slate-500">
                                Time
                            </label>

                            <div class="flex gap-4 mt-1">

                                <input type="time" name="agenda_start_time[]" class="w-full border rounded-lg px-2 py-5">

                                <input type="time" name="agenda_end_time[]" class="w-full border rounded-lg px-2 py-5">

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

                            <input type="text" name="agenda_remarks[]" class="w-full border rounded-lg px-3 py-5 mt-1">

                        </div>

                        <button type="button" onclick="removeAgendaRow(this)" class="text-red-600 mt-12">

                            <i class="fas fa-trash"></i>

                        </button>

                    </div>

                </div>

                <div class="flex justify-end px-6 py-5">
                    <button type="button" onclick="addAgendaRow()" class="px-4 py-2 bg-green-600 text-white rounded-xl">

                        <i class="fas fa-plus mr-2"></i>
                        Add Item

                    </button>
                </div>

            </div>


            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-6">

                <div class="px-6 py-5 border-b">
                    <h2 class="text-lg font-semibold text-green-700">
                        Choose Logo of Donors
                    </h2>

                    <p class="text-sm text-gray-500">
                        If you need logo can choose one or more donors.
                    </p>
                </div>

                <div class="p-6">

                    <div class="flex items-center gap-8 flex-wrap">

                        @foreach ($donors as $donor)
                            <label class="flex items-center gap-3 cursor-pointer">

                                <input type="checkbox" name="donor_logo_ids[]" value="{{ $donor->id }}"
                                    class="h-5 w-5 rounded border-gray-300 text-green-600 focus:ring-green-500">

                                <span class="text-gray-700 font-medium">
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

                        <div class="budget-row border rounded-xl p-5 mb-5">
                            <div class="flex justify-between items-center mb-5">

                                <h3 class="font-semibold text-green-700">
                                    Budget Item #1
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

                                <textarea name="description[]" required rows="1" class="w-full rounded-xl border-gray-300"></textarea>
                            </div>

                            <div class="grid md:grid-cols-7 gap-4">

                                <div>
                                    <label class="text-sm font-medium">
                                        Quantity
                                    </label>

                                    <input type="number" name="quantity[]"
                                        class="quantity w-full rounded-lg border-green-300 mt-1"
                                        oninput="calculateBudget(this)">
                                </div>

                                <div>
                                    <label class="text-sm font-medium">
                                        Unit Cost
                                    </label>

                                    <input type="number" name="cost[]"
                                        class="cost w-full rounded-lg border-green-300 mt-1"
                                        oninput="calculateBudget(this)">
                                </div>

                                <div>
                                    <label class="text-sm font-medium">
                                        Time
                                    </label>

                                    <input type="number" name="time[]"
                                        class="time w-full rounded-lg border-green-300 mt-1"
                                        oninput="calculateBudget(this)">
                                </div>

                                <div>
                                    <label class="text-sm font-medium">
                                        Total
                                    </label>

                                    <input type="text" readonly
                                        class="budget-total w-full rounded-lg bg-green-50 border-green-300 mt-1">
                                </div>

                                <div>
                                    <label class="text-sm font-medium">
                                        Budget Code
                                    </label>
                                    <input type="text" name="budget_code[]" placeholder="Budget Code"
                                        class="w-full rounded-lg border-green-300 mt-1">
                                </div>

                                <div>
                                    <label class="text-sm font-medium">
                                        Donor Code
                                    </label>
                                    <input type="text" name="donor_code[]" placeholder="Donor code"
                                        class="w-full rounded-lg border-green-300 mt-1">
                                </div>

                                <div>
                                    <label class="text-sm font-medium">
                                        Donor
                                    </label>
                                    <input type="text" name="donor[]" placeholder="Donor"
                                        class="w-full rounded-lg border-green-300 mt-1">
                                </div>

                            </div>

                            <div class="grid md:grid-cols-1 gap-4 mt-4">

                                <div>
                                    <input type="text" name="remarks[]" placeholder="Remarks"
                                        class="w-full rounded-lg border-gray-300">
                                </div>

                            </div>

                        </div>

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

            <!-- Signature -->
            {{-- <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-6">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Requester Signature
                    </h3>

                    <!-- Tabs -->
                    <div class="flex gap-3 mb-5">

                        <button type="button" onclick="showCanvas()"
                            class="signature-tab px-4 py-2 bg-indigo-600 text-white rounded-lg">
                            Draw Signature
                        </button>

                        <button type="button" onclick="showUpload()"
                            class="signature-tab px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">
                            Upload Signature
                        </button>

                    </div>

                    <!-- Canvas Signature -->
                    <div id="canvas-section">

                        <div class="border-2 border-dashed border-gray-300 rounded-xl overflow-hidden">
                            <canvas id="signature-pad" class="w-full bg-white" height="220"></canvas>
                        </div>

                        <input type="hidden" name="requester_signature" id="requester_signature">

                        <button type="button" id="clear-signature"
                            class="mt-3 px-4 py-2 bg-red-500 text-white rounded-lg">
                            Clear Signature
                        </button>

                    </div>

                    <!-- Upload Signature -->
                    <div id="upload-section" class="hidden">

                        <label
                            class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-10 cursor-pointer hover:bg-gray-50">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />

                            </svg>

                            <span class="mt-3 text-sm text-gray-600">
                                Click to upload signature image
                            </span>

                            <span class="text-xs text-gray-400">
                                PNG, JPG, JPEG
                            </span>

                            <input type="file" name="requester_signature_upload"
                                accept="image/png,image/jpeg,image/jpg" class="hidden">
                        </label>

                    </div>

                </div>

            </div> --}}

            <!-- Approval Workflow -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-6">

                <div class="px-6 py-5 border-b">
                    <h2 class="text-lg font-semibold text-green-700">
                        Approval Workflow
                    </h2>

                    <p class="text-sm text-gray-500">
                        Select the reviewer and final approver for this Fund Request.
                    </p>
                </div>

                <div class="p-6">

                    <div
                        class="grid {{ auth()->user()->role->name == 'Manager' ? 'md:grid-cols-1' : 'md:grid-cols-2' }} gap-6">

                        {{-- Review By (Hide for Manager) --}}
                        @if (auth()->user()->role->name != 'Manager')
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Review By <span class="text-red-500">*</span>
                                </label>

                                <select name="reviewed_by" required
                                    class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                                    <option value=""> Select Manager </option>

                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}"
                                            {{ old('reviewed_by') == $manager->id ? 'selected' : '' }}>

                                            {{ $manager->name }}

                                            @if ($manager->department)
                                                ({{ $manager->department->name }} Manager)
                                            @endif

                                        </option>
                                    @endforeach

                                </select>

                            </div>
                        @endif

                        {{-- Approve By --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Approve By
                                <span class="text-red-500">*</span>
                            </label>

                            @if (auth()->user()->role->name == 'Manager')
                                <input type="hidden" name="approved_by" value="{{ $eds->first()->id }}">

                                <input type="text" class="w-full rounded-xl border-gray-300 bg-gray-100"
                                    value="Executive Director ({{ $eds->first()->name }})" readonly>
                            @else
                                <select name="approved_by" required
                                    class="w-full rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                                    <option value="">Select Final Approver</option>

                                    @foreach ($approvers as $approver)
                                        <option value="{{ $approver->id }}"
                                            {{ old('approved_by') == $approver->id ? 'selected' : '' }}>

                                            {{ $approver->name }}
                                            - {{ $approver->role->name }}

                                        </option>
                                    @endforeach

                                </select>
                            @endif

                        </div>

                    </div>

                    <div class="mt-6 rounded-xl bg-blue-50 border border-blue-200 p-4">

                        <h4 class="font-semibold text-blue-700 mb-2">
                            Approval Process
                        </h4>

                        <ul class="list-disc ml-5 text-sm text-gray-700 space-y-2">

                            <li>
                                <strong>Staff / Finance</strong> selects a Manager for review.
                            </li>

                            <li>
                                The <strong>Manager</strong> reviews the request and forwards it
                                to the selected final approver.
                            </li>

                            <li>
                                The selected <strong>Manager</strong> or
                                <strong>Executive Director (ED)</strong> performs the final approval.
                            </li>

                            <li>
                                Once approved, the system automatically sends email notifications
                                to the <strong>Finance Department</strong> and the
                                <strong>Requester</strong>.
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            <!-- Sticky Footer -->
            <div class="sticky bottom-0 bg-white border rounded-2xl shadow-lg p-4">

                <div class="flex justify-end gap-3">

                    <a href="{{ route('fund-requests.index') }}"
                        class="px-5 py-2 rounded-lg border bg-orange-200 text-white hover:bg-orange-400">
                        Cancel
                    </a>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                        Submit
                    </button>

                </div>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ==========================
            // Signature Pad
            // ==========================
            const canvas = document.getElementById('signature-pad');

            let signaturePad = null;

            if (canvas) {

                signaturePad = new SignaturePad(canvas, {
                    penColor: '#1d4ed8',
                    minWidth: 1,
                    maxWidth: 2.5
                });

                function resizeCanvas() {

                    const ratio = Math.max(
                        window.devicePixelRatio || 1,
                        1
                    );

                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = 220 * ratio;

                    const ctx = canvas.getContext("2d");

                    ctx.scale(ratio, ratio);

                    signaturePad.clear();
                }

                window.addEventListener(
                    'resize',
                    resizeCanvas
                );

                resizeCanvas();
            }

            // ==========================
            // Signature Sections
            // ==========================
            const canvasSection =
                document.getElementById('canvas-section');

            const uploadSection =
                document.getElementById('upload-section');

            const tabs =
                document.querySelectorAll('.signature-tab');

            function resetTabs() {

                tabs.forEach(tab => {

                    tab.classList.remove(
                        'bg-indigo-600',
                        'text-white'
                    );

                    tab.classList.add(
                        'bg-gray-200',
                        'text-gray-700'
                    );
                });
            }

            window.showCanvas = function() {

                if (!canvasSection || !uploadSection) return;

                canvasSection.classList.remove('hidden');
                uploadSection.classList.add('hidden');

                resetTabs();

                if (tabs[0]) {

                    tabs[0].classList.remove(
                        'bg-gray-200',
                        'text-gray-700'
                    );

                    tabs[0].classList.add(
                        'bg-indigo-600',
                        'text-white'
                    );
                }
            }

            window.showUpload = function() {

                if (!canvasSection || !uploadSection) return;

                uploadSection.classList.remove('hidden');
                canvasSection.classList.add('hidden');

                resetTabs();

                if (tabs[1]) {

                    tabs[1].classList.remove(
                        'bg-gray-200',
                        'text-gray-700'
                    );

                    tabs[1].classList.add(
                        'bg-indigo-600',
                        'text-white'
                    );
                }
            }

            // ==========================
            // Clear Signature
            // ==========================
            const clearBtn =
                document.getElementById('clear-signature');

            if (clearBtn && signaturePad) {

                clearBtn.addEventListener(
                    'click',
                    function() {
                        signaturePad.clear();
                    }
                );
            }

            const fileInput = document.querySelector(
                'input[name="requester_signature_upload"]'
            );

            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    console.log(this.files);
                });
            }

            // ==========================
            // Trim Signature Canvas
            // ==========================
            function trimCanvas(canvas) {

                const ctx = canvas.getContext('2d');
                const pixels = ctx.getImageData(
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

                            if (left === null || x < left) {
                                left = x;
                            }

                            if (right === null || x > right) {
                                right = x;
                            }

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

                const trimmedCtx =
                    trimmedCanvas.getContext('2d');

                trimmedCtx.drawImage(
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

                resizedCanvas.width = maxWidth;
                resizedCanvas.height =
                    canvas.height * scale;

                const ctx =
                    resizedCanvas.getContext('2d');

                ctx.drawImage(
                    canvas,
                    0,
                    0,
                    resizedCanvas.width,
                    resizedCanvas.height
                );

                return resizedCanvas;
            }

            // ==========================
            // Form Submit
            // ==========================
            const form =
                document.getElementById(
                    'fund-request-form'
                );

            if (form) {

                form.addEventListener(
                    'submit',
                    function() {

                        const hiddenInput =
                            document.getElementById(
                                'requester_signature'
                            );

                        if (
                            signaturePad &&
                            !signaturePad.isEmpty()
                        ) {

                            let canvas =
                                trimCanvas(
                                    signaturePad.canvas
                                );

                            canvas =
                                resizeSignature(
                                    canvas
                                );

                            hiddenInput.value =
                                canvas.toDataURL(
                                    'image/png'
                                );
                        }
                    }
                );
            }

            // ==========================
            // Budget Functions
            // ==========================
            window.addBudget = function() {

                let count =
                    document.querySelectorAll(
                        '.budget-row'
                    ).length + 1;

                const html = `
                    <div class="budget-row bg-slate-50 border border-slate-200 rounded-2xl p-6 mb-5">

                        <div class="flex justify-between items-center mb-5">

                            <h3 class="font-semibold text-green-700">
                                Budget Item #${count}
                            </h3>

                            <button type="button"
                                onclick="removeBudget(this)"
                                class="text-red-500 hover:text-red-700">
                                ✕
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

                                <input type="number"
                                    name="quantity[]"
                                    min="1"
                                    value="1"
                                    class="quantity w-full rounded-xl border-green-300 mt-1"
                                    oninput="calculateBudget(this)">
                            </div>

                            <div>
                                <label class="text-sm font-medium">
                                    Cost
                                </label>

                                <input type="number"
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

                                <input type="number"
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

                                <input type="text"
                                    readonly
                                    value="0.00"
                                    class="budget-total w-full rounded-xl bg-green-50 border-green-300 mt-1">
                            </div>

                            <div>
                                <label class="text-sm font-medium">
                                    Budget Code
                                </label>

                                <input type="text"
                                    name="budget_code[]"
                                    class="w-full rounded-xl border-green-300 mt-1">
                            </div>

                            <div>
                                <label class="text-sm font-medium">
                                    Donor Code
                                </label>

                                <input type="text"
                                    name="donor_code[]"
                                    class="w-full rounded-xl border-green-300 mt-1">
                            </div>

                            <div>
                                <label class="text-sm font-medium">
                                    Donor
                                </label>

                                <input type="text"
                                    name="donor[]"
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
                    .insertAdjacentHTML(
                        'beforeend',
                        html
                    );
            };

            window.removeBudget = function(button) {

                const rows =
                    document.querySelectorAll('.budget-row');

                if (rows.length > 1) {

                    button.closest('.budget-row')
                        .remove();

                    updateGrandTotal();
                }
            };

            window.calculateBudget = function(element) {

                const row =
                    element.closest('.budget-row');

                if (!row) return;

                const quantity =
                    parseFloat(
                        row.querySelector('.quantity')?.value
                    ) || 0;

                const cost =
                    parseFloat(
                        row.querySelector('.cost')?.value
                    ) || 0;

                const time =
                    parseFloat(
                        row.querySelector('.time')?.value
                    ) || 0;

                const total =
                    quantity * cost * time;

                const totalField =
                    row.querySelector('.budget-total');

                if (totalField) {
                    totalField.value =
                        total.toFixed(2);
                }

                updateGrandTotal();
            };

            function updateGrandTotal() {

                let grandTotal = 0;

                document
                    .querySelectorAll('.budget-total')
                    .forEach(item => {

                        grandTotal +=
                            parseFloat(item.value) || 0;
                    });

                const grand =
                    document.getElementById(
                        'grand-total'
                    );

                if (grand) {

                    grand.innerText =
                        '$' +
                        grandTotal.toLocaleString(
                            undefined, {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }
                        );
                }
            }

            window.addAgendaRow = function() {
                const html = `
                        <div class="agenda-row flex gap-4 items-start border rounded-xl p-4 bg-slate-50">

                            <div>
                                <label class="text-xs font-medium text-slate-500">
                                    Time
                                </label>

                                <div class="flex gap-4 mt-1">
                                    <input
                                        type="time"
                                        name="agenda_start_time[]"
                                        class="w-full border rounded-lg px-2 py-5">

                                    <input
                                        type="time"
                                        name="agenda_end_time[]"
                                        class="w-full border rounded-lg px-2 py-5">
                                </div>
                            </div>

                            <div class="flex-1">
                                <label class="text-xs font-medium text-slate-500">
                                    Activity
                                </label>

                                <textarea
                                    name="agenda_activity[]"
                                    rows="2"
                                    class="w-full border rounded-lg px-3 py-2 mt-1"
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
                                class="text-red-600 mt-12 hover:text-red-800">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>
                    `;

                const agendaTable = document.getElementById('agendaTable');

                if (agendaTable) {
                    agendaTable.insertAdjacentHTML(
                        'beforeend',
                        html
                    );
                }
            };


            window.removeAgendaRow = function(button) {

                const rows = document.querySelectorAll(
                    '#agendaTable .agenda-row'
                );

                if (rows.length <= 1) {
                    return;
                }

                button.closest('.agenda-row')?.remove();
            };

        });

        // Donor
        document.querySelectorAll('.donor-card').forEach(card => {

            card.addEventListener('click', function() {

                document.querySelectorAll('.donor-card').forEach(c => {
                    c.classList.remove(
                        'border-green-600',
                        'bg-green-50',
                        'ring-2',
                        'ring-green-500'
                    );
                });

                this.classList.add(
                    'border-green-600',
                    'bg-green-50',
                    'ring-2',
                    'ring-green-500'
                );

                this.querySelector('input').checked = true;

            });

        });

        window.addEventListener('load', () => {

            const checked = document.querySelector('.donor-radio:checked');

            if (checked) {
                checked.closest('.donor-card').click();
            }

        });
    </script>
@endsection
