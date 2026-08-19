@extends('layout.app')

@section('content')
    <form id="expenditure-form" action="{{ route('expenditure-summaries.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="space-y-4">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-3xl p-8 shadow-xl">

                <h1 class="text-4xl font-bold text-white">
                    Create Expenditure Summary
                </h1>

                <p class="text-green-100 mt-2">
                    Record expenditure settlement details
                </p>

            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Fund Request --}}
            <div class="bg-white rounded-3xl shadow-lg border border-green-200">

                <div class="px-6 py-4 border-b bg-green-50">

                    <h2 class="font-semibold text-lg text-green-700">
                        Fund Request Information
                    </h2>

                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    @if ($fundRequests->count())
                        {{-- Fund Request --}}
                        <div>

                            <label class="block mb-2 font-medium">
                                Fund Request
                            </label>

                            <select id="fund_request_id" name="fund_request_id"
                                class="w-full border border-green-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">

                                <option value="">
                                    Select Fund Request
                                </option>

                                @foreach ($fundRequests as $fundRequest)
                                    <option value="{{ $fundRequest->id }}" data-title="{{ $fundRequest->title }}">

                                        {{ $fundRequest->title }}

                                    </option>
                                @endforeach

                            </select>

                        </div>
                    @endif

                    {{-- Activity --}}
                    <div>

                        <label class="block mb-2 font-medium">
                            Activity
                        </label>

                        <input type="text" id="activity" name="activity"
                            class="w-full border border-green-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="Enter activity ">

                    </div>

                </div>

            </div>


            {{-- Transaction Information --}}
            <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">

                <div class="px-6 py-5 border-b bg-green-50">

                    <h2 class="font-semibold text-xl text-green-700">
                        Transaction Information
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Enter transaction and settlement details
                    </p>

                </div>

                <div class="p-6 space-y-6">

                    {{-- Basic Information --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                        <div>

                            <label class="block mb-2 text-sm font-semibold text-gray-700">
                                Transaction Date
                            </label>

                            <input type="date" name="date" value="{{ old('date') }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">

                        </div>

                        <div>

                            <label class="block mb-2 text-sm font-semibold text-gray-700">
                                Place
                            </label>

                            <input type="text" name="place" value="{{ old('place') }}" placeholder="Enter place"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">

                        </div>

                        <div>

                            <label class="block mb-2 text-sm font-semibold text-gray-700">
                                Advance Voucher No.
                            </label>

                            <input type="text" name="advance_voucher_no" value="{{ old('advance_voucher_no') }}"
                                placeholder="AV-2025-001"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">

                        </div>

                    </div>

                    {{-- Transaction Type --}}
                    <div>

                        <label class="block mb-4 text-sm font-semibold text-gray-700">
                            Transaction Type
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            {{-- Advance Settlement --}}
                            <label>

                                <input type="radio" name="transaction_type" value="Advance Settlement"
                                    class="peer hidden">

                                <div
                                    class="border rounded-2xl p-5 cursor-pointer
                                    hover:border-green-500 hover:bg-green-50
                                    peer-checked:border-green-600
                                    peer-checked:bg-green-50
                                    peer-checked:ring-2
                                    peer-checked:ring-green-500
                                    transition">

                                    <div class="flex items-center gap-3">

                                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">

                                            💵

                                        </div>

                                        <div>

                                            <h4 class="font-semibold text-gray-800">
                                                Advance Settlement
                                            </h4>

                                            <p class="text-xs text-gray-500 mt-1">
                                                Settlement against advance voucher
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>

                            {{-- Reimbursement --}}
                            <label>

                                <input type="radio" name="transaction_type" value="Reimbursement" class="peer hidden">

                                <div
                                    class="border rounded-2xl p-5 cursor-pointer
                                    hover:border-blue-500 hover:bg-blue-50
                                    peer-checked:border-blue-600
                                    peer-checked:bg-blue-50
                                    peer-checked:ring-2
                                    peer-checked:ring-blue-500
                                    transition">

                                    <div class="flex items-center gap-3">

                                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">

                                            💳

                                        </div>

                                        <div>

                                            <h4 class="font-semibold text-gray-800">
                                                Reimbursement
                                            </h4>

                                            <p class="text-xs text-gray-500 mt-1">
                                                Reimburse expenses already paid
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>

                            {{-- Direct Pay --}}
                            <label>

                                <input type="radio" name="transaction_type" value="Direct Pay" class="peer hidden">

                                <div
                                    class="border rounded-2xl p-5 cursor-pointer
                                    hover:border-purple-500 hover:bg-purple-50
                                    peer-checked:border-purple-600
                                    peer-checked:bg-purple-50
                                    peer-checked:ring-2
                                    peer-checked:ring-purple-500
                                    transition">

                                    <div class="flex items-center gap-3">

                                        <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">

                                            🏦

                                        </div>

                                        <div>

                                            <h4 class="font-semibold text-gray-800">
                                                Direct Pay
                                            </h4>

                                            <p class="text-xs text-gray-500 mt-1">
                                                Direct payment to supplier/vendor
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Expense Details --}}
            <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">

                <div class="px-6 py-5 border-b bg-green-50 flex justify-between items-center">

                    <div>

                        <h2 class="font-semibold text-xl text-green-700">
                            Expense Details
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Add all expenses related to this activity
                        </p>

                    </div>

                    <button type="button" onclick="addExpenseCard()"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl font-medium">

                        + Add Expense

                    </button>

                </div>

                <div id="expense-container" class="p-6 space-y-5">

                    <div class="expense-card bg-gray-50 border rounded-2xl p-5">

                        <div class="flex justify-between items-center mb-5">

                            <h3 class="expense-title font-semibold text-green-700">
                                Expense #1
                            </h3>

                            <button type="button" onclick="removeExpenseCard(this)"
                                class="text-red-600 hover:text-red-700">

                                Remove

                            </button>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                            <div class="col-span-5">

                                <label class="block text-sm font-medium mb-2">
                                    Description
                                </label>

                                <input type="text" name="description[]" class="w-full border rounded-xl px-4 py-3">

                            </div>

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    AV Amount
                                </label>

                                <input type="number" step="0.01" name="av_amount[]"
                                    class="av-amount w-full border rounded-xl px-4 py-3" oninput="calculateTotals()">

                            </div>

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Actual Expense
                                </label>

                                <input type="number" step="0.01" name="actual_expense[]"
                                    class="actual-expense w-full border rounded-xl px-4 py-3" oninput="calculateTotals()">

                            </div>

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Budget Code
                                </label>

                                <input type="text" name="budget_code[]" class="w-full border rounded-xl px-4 py-3"
                                    required>

                            </div>

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Donor
                                </label>

                                <input type="text" name="donor[]" class="w-full border rounded-xl px-4 py-3" required>

                            </div>

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Donor Code
                                </label>

                                <input type="text" name="donor_code[]" class="w-full border rounded-xl px-4 py-3"
                                    required>

                            </div>

                            <div class="col-span-5">

                                <label class="block text-sm font-medium mb-2">
                                    Reference Supporting Documents
                                </label>

                                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-gray-50">

                                    <input type="file" name="attachments[0][]" multiple accept=".pdf,.jpg,.jpeg,.png"
                                        class="attachment-input hidden">

                                    <button type="button"
                                        onclick="this.parentElement.querySelector('.attachment-input').click()"
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">

                                        + Add Files

                                    </button>

                                    <div class="file-preview mt-4 space-y-2"></div>

                                    <p class="mt-3 text-xs text-gray-500">
                                        Accepted formats: PDF, JPG, JPEG, PNG
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Summary --}}
                <div class="border-t bg-gradient-to-r from-gray-50 to-green-50 p-6">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        {{-- AV Amount --}}
                        <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm text-gray-500">
                                        Total AV Amount
                                    </p>

                                    <h3 id="total-av" class="text-2xl font-bold text-blue-600 mt-1">

                                        $0.00

                                    </h3>

                                </div>

                                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">

                                    <i class="fas fa-wallet text-blue-600"></i>

                                </div>

                            </div>

                        </div>

                        {{-- Actual Expense --}}
                        <div class="bg-white rounded-2xl border border-green-100 p-5 shadow-sm">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm text-gray-500">
                                        Actual Expense
                                    </p>

                                    <h3 id="total-actual" class="text-2xl font-bold text-green-600 mt-1">

                                        $0.00

                                    </h3>

                                </div>

                                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">

                                    <i class="fas fa-money-bill-wave text-green-600"></i>

                                </div>

                            </div>

                        </div>

                        {{-- Variance --}}
                        <div class="bg-white rounded-2xl border border-red-100 p-5 shadow-sm">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm text-gray-500">
                                        Variance
                                    </p>

                                    <h3 id="variance-total" class="text-2xl font-bold text-red-600 mt-1">

                                        $0.00

                                    </h3>

                                </div>

                                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">

                                    <i class="fas fa-chart-line text-red-600"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Explanation --}}
            <div class="bg-white rounded-3xl shadow-lg border border-gray-200">

                <div class="px-6 py-4 border-b">

                    <h2 class="font-semibold text-lg text-green-700">
                        Variance Information
                    </h2>

                </div>

                <div class="p-6">

                    <label class="block font-medium mb-4">
                        There are the variance require to explain
                    </label>

                    <div class="flex gap-4">

                        <label
                            class="flex items-center gap-2 px-5 py-3 border rounded-xl cursor-pointer hover:bg-green-50">

                            <input type="radio" name="variance_required" value="1"
                                onchange="toggleVariance(true)">

                            <span>Yes</span>

                        </label>

                        <label class="flex items-center gap-2 px-5 py-3 border rounded-xl cursor-pointer hover:bg-red-50">

                            <input type="radio" name="variance_required" value="0" checked
                                onchange="toggleVariance(false)">

                            <span>No</span>

                        </label>

                    </div>

                    <div id="variance-section" class="hidden mt-5">

                        <label class="block mb-2 font-medium">
                            Variance Explanation
                        </label>

                        <textarea name="variance_explanation" id="variance_explanation" rows="4" class="w-full border rounded-xl p-3"
                            placeholder="Explain the variance..."></textarea>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-lg border border-gray-200">

                <div class="px-6 py-4 border-b">

                    <h2 class="font-semibold text-lg text-green-700">
                        Late Liquidation
                    </h2>

                </div>

                <div class="p-6">

                    <label class="block font-medium mb-4">
                        There is late advance liquidation require to explain
                    </label>

                    <div class="flex gap-4">

                        <label
                            class="flex items-center gap-2 px-5 py-3 border rounded-xl cursor-pointer hover:bg-green-50">

                            <input type="radio" name="late_liquidation" value="1"
                                onchange="toggleLateLiquidation(true)">

                            <span>Yes</span>

                        </label>

                        <label class="flex items-center gap-2 px-5 py-3 border rounded-xl cursor-pointer hover:bg-red-50">

                            <input type="radio" name="late_liquidation" value="0" checked
                                onchange="toggleLateLiquidation(false)">

                            <span>No</span>

                        </label>

                    </div>

                    <div id="late-liquidation-section" class="hidden mt-5">

                        <label class="block mb-2 font-medium">
                            Late Liquidation Explanation
                        </label>

                        <textarea name="late_liquidation_explanation" id="late_liquidation_explanation" rows="4"
                            class="w-full border rounded-xl p-3" placeholder="Explain why liquidation was late..."></textarea>

                    </div>

                </div>

            </div>

            {{-- Prepared Signature --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Prepared Signature
                    </h3>

                    <div class="flex gap-3 mb-5">

                        <button type="button" onclick="showPreparedCanvas()"
                            class="prepared-tab px-4 py-2 bg-indigo-600 text-white rounded-lg">

                            Draw Signature

                        </button>

                        <button type="button" onclick="showPreparedUpload()"
                            class="prepared-tab px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">

                            Upload Signature

                        </button>

                    </div>

                    {{-- Draw --}}
                    <div id="prepared-canvas-section">

                        <div class="border-2 border-dashed border-gray-300 rounded-xl overflow-hidden">

                            <canvas id="prepared-signature-pad" class="w-full bg-white" height="220">
                            </canvas>

                        </div>

                        <input type="hidden" name="prepared_signature" id="prepared_signature">

                        <button type="button" id="clear-prepared-signature"
                            class="mt-3 px-4 py-2 bg-red-500 text-white rounded-lg">

                            Clear Signature

                        </button>

                    </div>

                    {{-- Upload --}}
                    <div id="prepared-upload-section" class="hidden">

                        <label
                            class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-10 cursor-pointer hover:bg-gray-50">

                            <input type="file" name="prepared_signature_upload" accept="image/*" class="hidden">

                            <span class="text-gray-600">
                                Click to upload signature
                            </span>

                        </label>

                    </div>

                </div>

            </div>

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

            {{-- Actions --}}
            <div class="bg-white rounded-3xl shadow-lg border border-gray-200 p-6">

                <div class="flex flex-col sm:flex-row items-center justify-end gap-4">

                    {{-- Left --}}
                    <a href="{{ route('expenditure-summaries.index') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 border bg-orange-300 rounded-xl text-white hover:bg-orange-500 transition">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>

                    {{-- Right --}}
                    <div class="flex gap-3 w-full sm:w-auto">

                        <button type="submit"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg shadow-green-200 transition">

                            <i class="fas fa-save"></i>

                            Save

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

    <script>
        // Budget 
        function addExpenseCard() {
            const container =
                document.getElementById(
                    'expense-container'
                );

            const count =
                container.querySelectorAll(
                    '.expense-card'
                ).length + 1;

            const html = `

                <div class="expense-card bg-gray-50 border rounded-2xl p-5">

                    <div class="flex justify-between items-center mb-5">

                        <h3 class="expense-title font-semibold text-green-700">
                            Expense #${count}
                        </h3>

                        <button
                            type="button"
                            onclick="removeExpenseCard(this)"
                            class="text-red-600">

                            Remove

                        </button>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                        <div class="col-span-5">
                            <label class="block text-sm font-medium mb-2">
                                Description
                            </label>
                            <input type="text"
                                name="description[]"
                                class="w-full border rounded-xl px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                AV Amount
                            </label>
                            <input type="number"
                                step="0.01"
                                name="av_amount[]"
                                class="av-amount w-full border rounded-xl px-4 py-3"
                                oninput="calculateTotals()">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Actual Expense
                            </label>
                            <input type="number"
                                step="0.01"
                                name="actual_expense[]"
                                class="actual-expense w-full border rounded-xl px-4 py-3"
                                oninput="calculateTotals()">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Budget Code
                            </label>
                            <input type="text"
                                name="budget_code[]"
                                placeholder="Budget Code"
                                class="w-full border rounded-xl px-4 py-3" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                            Donor
                            </label>
                            <input type="text"
                                name="donor[]"
                                placeholder="Donor"
                                class="w-full border rounded-xl px-4 py-3" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Donor Code
                            </label>
                            <input type="text"
                                name="donor_code[]"
                                placeholder="Donor Code"
                                class="w-full border rounded-xl px-4 py-3" required>
                        </div>

                    </div>

                </div>
            `;

            container.insertAdjacentHTML(
                'beforeend',
                html
            );
        }

        function removeExpenseCard(button) {
            button
                .closest('.expense-card')
                .remove();

            updateTitles();

            calculateTotals();
        }

        function updateTitles() {
            document
                .querySelectorAll('.expense-title')
                .forEach((item, index) => {

                    item.innerText =
                        'Expense #' + (index + 1);

                });
        }

        function calculateTotals() {
            let av = 0;
            let actual = 0;

            document.querySelectorAll('.av-amount')
                .forEach(input => {
                    av += parseFloat(input.value) || 0;
                });

            document.querySelectorAll('.actual-expense')
                .forEach(input => {
                    actual += parseFloat(input.value) || 0;
                });

            const variance = av - actual;

            document.getElementById('total-av').innerText =
                '$' + av.toFixed(2);

            document.getElementById('total-actual').innerText =
                '$' + actual.toFixed(2);

            const varianceElement =
                document.getElementById('variance-total');

            varianceElement.innerText =
                '$' + variance.toFixed(2);

            varianceElement.classList.remove(
                'text-red-600',
                'text-green-600'
            );

            varianceElement.classList.add(
                variance >= 0 ?
                'text-green-600' :
                'text-red-600'
            );
        }

        // variance-section
        document
            .getElementById('fund_request_id')
            ?.addEventListener('change', function() {

                const selected =
                    this.options[this.selectedIndex];

                document.getElementById('activity').value =
                    selected.dataset.title || '';
            });

        function toggleVariance(show) {
            const section =
                document.getElementById(
                    'variance-section'
                );

            const textarea =
                document.getElementById(
                    'variance_explanation'
                );

            if (show) {
                section.classList.remove('hidden');
                textarea.required = true;
            } else {
                section.classList.add('hidden');
                textarea.required = false;
                textarea.value = '';
            }
        }

        function toggleLateLiquidation(show) {
            const section =
                document.getElementById(
                    'late-liquidation-section'
                );

            const textarea =
                document.getElementById(
                    'late_liquidation_explanation'
                );

            if (show) {
                section.classList.remove('hidden');
                textarea.required = true;
            } else {
                section.classList.add('hidden');
                textarea.required = false;
                textarea.value = '';
            }
        }


        // ==========================
        // Add Expense Card
        // ==========================
        function addExpenseCard() {

            const container =
                document.getElementById(
                    'expense-container'
                );

            const count =
                document.querySelectorAll(
                    '.expense-card'
                ).length + 1;

            const index = count - 1;

            const html = `

                <div class="expense-card bg-gray-50 border rounded-2xl p-5">

                    <div class="flex justify-between items-center mb-5">

                        <h3 class="expense-title font-semibold text-green-700">
                            Expense #${count}
                        </h3>

                        <button
                            type="button"
                            onclick="removeExpenseCard(this)"
                            class="text-red-600 hover:text-red-700">

                            Remove

                        </button>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                        <div class="col-span-5">

                            <label class="block text-sm font-medium mb-2">
                                Description
                            </label>

                            <input
                                type="text"
                                name="description[]"
                                class="w-full border rounded-xl px-4 py-3">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                AV Amount
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="av_amount[]"
                                class="av-amount w-full border rounded-xl px-4 py-3"
                                oninput="calculateTotals()">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Actual Expense
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="actual_expense[]"
                                class="actual-expense w-full border rounded-xl px-4 py-3"
                                oninput="calculateTotals()">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Budget Code
                            </label>

                            <input
                                type="text"
                                name="budget_code[]"
                                class="w-full border rounded-xl px-4 py-3">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Donor
                            </label>

                            <input
                                type="text"
                                name="donor[]"
                                class="w-full border rounded-xl px-4 py-3">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Donor Code
                            </label>

                            <input
                                type="text"
                                name="donor_code[]"
                                class="w-full border rounded-xl px-4 py-3">

                        </div>

                        <div class="col-span-5">

                            <label class="block text-sm font-medium mb-2">
                                Reference Supporting Documents
                            </label>

                            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-white">

                                <input
                                    type="file"
                                    name="attachments[${index}][]"
                                    multiple
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    class="attachment-input hidden">

                                <button
                                    type="button"
                                    onclick="this.parentElement.querySelector('.attachment-input').click()"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">

                                    + Add Files

                                </button>

                                <div class="file-preview mt-4 space-y-2"></div>

                                <p class="mt-3 text-xs text-gray-500">
                                    Accepted formats: PDF, JPG, JPEG, PNG
                                </p>

                            </div>

                        </div>

                    </div>

                </div>
                 `;

            container.insertAdjacentHTML(
                'beforeend',
                html
            );
        }

        // ==========================
        // Remove Expense Card
        // ==========================
        function removeExpenseCard(button) {

            const cards =
                document.querySelectorAll(
                    '.expense-card'
                );

            if (cards.length <= 1) {

                alert(
                    'At least one expense item is required.'
                );

                return;
            }

            button
                .closest('.expense-card')
                .remove();

            updateTitles();

            calculateTotals();
        }

        // ==========================
        // Update Titles
        // ==========================
        function updateTitles() {

            document
                .querySelectorAll(
                    '.expense-title'
                )
                .forEach((item, index) => {

                    item.innerText =
                        'Expense #' + (index + 1);

                });
        }

        // ==========================
        // File Preview
        // ==========================
        document.addEventListener(
            'change',
            function(e) {

                if (
                    !e.target.classList.contains(
                        'attachment-input'
                    )
                ) {
                    return;
                }

                const preview =
                    e.target
                    .closest('.border-2')
                    .querySelector(
                        '.file-preview'
                    );

                preview.innerHTML = '';

                Array.from(
                    e.target.files
                ).forEach(file => {

                    preview.innerHTML += `
                    <div class="flex items-center justify-between bg-gray-50 border rounded-xl px-4 py-2">

                        <div>

                            📎 ${file.name}

                            <span class="text-xs text-gray-500 ml-2">

                                (${(file.size / 1024 / 1024).toFixed(2)} MB)

                            </span>

                        </div>

                    </div>
                `;
                });
            }
        );

        // ==========================
        // Calculate Totals
        // ==========================
        function calculateTotals() {

            let av = 0;
            let actual = 0;

            document
                .querySelectorAll(
                    '.av-amount'
                )
                .forEach(input => {

                    av +=
                        parseFloat(
                            input.value
                        ) || 0;
                });

            document
                .querySelectorAll(
                    '.actual-expense'
                )
                .forEach(input => {

                    actual +=
                        parseFloat(
                            input.value
                        ) || 0;
                });

            const variance =
                av - actual;

            document.getElementById(
                    'total-av'
                ).innerText =
                '$' + av.toFixed(2);

            document.getElementById(
                    'total-actual'
                ).innerText =
                '$' + actual.toFixed(2);

            const varianceElement =
                document.getElementById(
                    'variance-total'
                );

            varianceElement.innerText =
                '$' +
                variance.toFixed(2);

            varianceElement.classList.remove(
                'text-green-600',
                'text-red-600'
            );

            varianceElement.classList.add(
                variance >= 0 ?
                'text-green-600' :
                'text-red-600'
            );
        }


        // ==========================
        // Prepared Signature Pad
        // ==========================
        document.addEventListener('DOMContentLoaded', function() {

            const canvas =
                document.getElementById('prepared-signature-pad');

            const hiddenInput =
                document.getElementById('prepared_signature');

            let preparedPad;

            if (canvas) {

                preparedPad = new SignaturePad(canvas, {
                    penColor: '#1d4ed8',
                    minWidth: 1,
                    maxWidth: 2.5
                });

                function resizeCanvas() {

                    const ratio =
                        Math.max(window.devicePixelRatio || 1, 1);

                    canvas.width =
                        canvas.offsetWidth * ratio;

                    canvas.height =
                        200 * ratio;

                    canvas.getContext('2d')
                        .scale(ratio, ratio);

                    preparedPad.clear();
                }

                resizeCanvas();

                window.addEventListener(
                    'resize',
                    resizeCanvas
                );
            }

            function trimCanvas(canvas) {

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

            function resizeSignature(canvas) {

                const targetWidth = 300;

                const scale =
                    targetWidth / canvas.width;

                const resizedCanvas =
                    document.createElement('canvas');

                resizedCanvas.width =
                    targetWidth;

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

            window.showPreparedCanvas = function() {

                document
                    .getElementById('prepared-canvas-section')
                    .classList.remove('hidden');

                document
                    .getElementById('prepared-upload-section')
                    .classList.add('hidden');
            };

            window.showPreparedUpload = function() {

                document
                    .getElementById('prepared-upload-section')
                    .classList.remove('hidden');

                document
                    .getElementById('prepared-canvas-section')
                    .classList.add('hidden');
            };

            document
                .getElementById('clear-prepared-signature')
                ?.addEventListener('click', function() {

                    if (preparedPad) {
                        preparedPad.clear();
                    }
                });

            document
                .getElementById('expenditure-form')
                ?.addEventListener('submit', function() {

                    if (
                        preparedPad &&
                        !preparedPad.isEmpty()
                    ) {

                        let canvas =
                            trimCanvas(
                                preparedPad.canvas
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
                });
        });
    </script>
@endsection
