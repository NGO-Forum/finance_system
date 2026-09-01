@extends('layout.app')

@section('content')
    <div class="min-h-screen space-y-5 pb-10">

        <div
            class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-700 via-green-700 to-teal-800 p-6 sm:p-8 lg:p-10 text-white shadow-xl">

            {{-- Decorative circles --}}
            <div class="absolute -right-16 -top-16 h-56 w-56 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-24 right-24 h-64 w-64 rounded-full bg-white/5"></div>
            <div class="absolute -left-20 bottom-0 h-40 w-40 rounded-full bg-emerald-400/10"></div>

            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                {{-- Welcome --}}
                <div>

                    <div
                        class="mb-3 inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-medium backdrop-blur-sm">
                        <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                        Finance Management System
                    </div>

                    <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">
                        Welcome, {{ auth()->user()->name }}
                    </h1>

                    <p class="mt-3 max-w-3xl text-sm leading-6 text-emerald-100 sm:text-base">
                        Manage requests, expenditures, finance forms, staff,
                        departments and financial activities from one place.
                    </p>

                </div>


                {{-- Date --}}
                <div class="rounded-2xl border border-white/20 bg-white/10 px-6 py-4 text-left backdrop-blur-md lg:min-w-[180px] lg:text-right">

                        {{ now()->format('l') }}

                        {{ now()->format('d') }}

                        {{ now()->format('F Y') }}

                </div>

            </div>

        </div>


        <div>

            <div class="mb-5 flex items-center justify-between bg-green-700 p-5 rounded-lg">

                <div>
                    <h2 class="text-xl font-bold text-white">
                        Overview
                    </h2>

                    <p class="mt-1 text-sm text-gray-200">
                        Summary of your finance management system
                    </p>
                </div>

                <div
                    class="hidden sm:flex items-center gap-2 rounded-full bg-green-50 px-4 py-2 text-xs font-semibold text-green-700">
                    <span class="h-2 w-2 rounded-full bg-green-500"></span>
                    System Active
                </div>

            </div>


            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                {{-- USERS --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total Users
                            </p>

                            <h3 class="mt-3 text-4xl font-bold tracking-tight text-gray-800">
                                {{ number_format($users) }}
                            </h3>

                            <p class="mt-2 text-xs text-gray-400">
                                Registered system users
                            </p>

                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-50 text-2xl text-green-600 transition group-hover:scale-110">
                            👥
                        </div>

                    </div>

                    <div class="absolute bottom-0 left-0 h-1 w-full bg-green-500"></div>

                </div>


                {{-- DEPARTMENTS --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Departments
                            </p>

                            <h3 class="mt-3 text-4xl font-bold tracking-tight text-gray-800">
                                {{ number_format($departments) }}
                            </h3>

                            <p class="mt-2 text-xs text-gray-400">
                                Active departments
                            </p>

                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-2xl text-blue-600 transition group-hover:scale-110">
                            🏢
                        </div>

                    </div>

                    <div class="absolute bottom-0 left-0 h-1 w-full bg-blue-500"></div>

                </div>


                {{-- ROLES --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Roles
                            </p>

                            <h3 class="mt-3 text-4xl font-bold tracking-tight text-gray-800">
                                {{ number_format($roles) }}
                            </h3>

                            <p class="mt-2 text-xs text-gray-400">
                                System permissions
                            </p>

                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-50 text-2xl text-purple-600 transition group-hover:scale-110">
                            🔐
                        </div>

                    </div>

                    <div class="absolute bottom-0 left-0 h-1 w-full bg-purple-500"></div>

                </div>


                {{-- DONORS --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Donors
                            </p>

                            <h3 class="mt-3 text-4xl font-bold tracking-tight text-gray-800">
                                {{ number_format($donors) }}
                            </h3>

                            <p class="mt-2 text-xs text-gray-400">
                                Registered donors
                            </p>

                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50 text-2xl text-amber-600 transition group-hover:scale-110">
                            🤝
                        </div>

                    </div>

                    <div class="absolute bottom-0 left-0 h-1 w-full bg-amber-500"></div>

                </div>

            </div>

        </div>
        

        <div>

            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between bg-green-700 p-5 rounded-lg">

                <div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                            <i class="fas fa-file-invoice"></i>
                        </div>

                        <div>
                            <h2 class="text-xl font-bold text-white">
                                Finance Forms
                            </h2>

                            <p class="mt-1 text-sm text-gray-200">
                                All FM02 finance and procurement forms
                            </p>
                        </div>
                    </div>
                </div>

                @php
                    $totalFormRecords =
                        $financeForms +
                        $fundRequests +
                        $expenditureSummaries +
                        $purchaseRequests +
                        $attendateList +
                        $dsaClaims +
                        $allowance +
                        $verbalQuotes +
                        $quotationAnalyses +
                        $purchaseOrders +
                        $serviceReceivedNotes +
                        $invoices;
                @endphp

                <div
                    class="inline-flex w-fit items-center gap-2 rounded-full border border-emerald-100 bg-emerald-50 px-4 py-2 text-xs font-semibold text-emerald-700">

                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                    {{ number_format($totalFormRecords) }} Total Records

                </div>

            </div>


            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">


                {{-- ===================================================== --}}
                {{-- FM02-01 FINANCE FORM --}}
                {{-- ===================================================== --}}
                <a href="{{ Route::has('finance-forms.index') ? route('finance-forms.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-600 to-green-700 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-01
                                </span>

                                <p class="mt-3 text-sm font-semibold text-emerald-100">
                                    Finance Form
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($financeForms) }}
                                </h3>

                                <p class="mt-2 text-xs text-emerald-100">
                                    Financial transactions
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl backdrop-blur-sm">
                                💳
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-emerald-100">
                            View Finance Forms →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-02 CONCEPT NOTE --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('fund-requests.index') ? route('fund-requests.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-02
                                </span>

                                <p class="mt-3 text-sm font-semibold text-blue-100">
                                    Concept Note
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($fundRequests) }}
                                </h3>

                                <p class="mt-2 text-xs text-blue-100">
                                    Concept note records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                📝
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-blue-100">
                            View Concept Notes →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-03 EXPENDITURE SUMMARY --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('expenditure-summaries.index') ? route('expenditure-summaries.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-500 to-orange-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-03
                                </span>

                                <p class="mt-3 text-sm font-semibold text-red-100">
                                    Expenditure Summary
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($expenditureSummaries) }}
                                </h3>

                                <p class="mt-2 text-xs text-red-100">
                                    Expenditure records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                💵
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-red-100">
                            View Expenditure →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-04 PURCHASE REQUEST --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('purchase-requests.index') ? route('purchase-requests.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-cyan-600 to-blue-700 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-04
                                </span>

                                <p class="mt-3 text-sm font-semibold text-cyan-100">
                                    Purchase Request
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($purchaseRequests) }}
                                </h3>

                                <p class="mt-2 text-xs text-cyan-100">
                                    Procurement requests
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                🛒
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-cyan-100">
                            View Purchase Requests →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-05 ATTENDANT LIST --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('attendant-lists.index') ? route('attendant-lists.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 to-yellow-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-05
                                </span>

                                <p class="mt-3 text-sm font-semibold text-amber-100">
                                    Attendant Lists
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($attendateList) }}
                                </h3>

                                <p class="mt-2 text-xs text-amber-100">
                                    Attendance records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                👥
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-amber-100">
                            View Attendant Lists →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-06 DSA CLAIM --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('dsa-claims.index') ? route('dsa-claims.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-06
                                </span>

                                <p class="mt-3 text-sm font-semibold text-orange-100">
                                    DSA Claim
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($dsaClaims) }}
                                </h3>

                                <p class="mt-2 text-xs text-orange-100">
                                    DSA claim records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                ✈️
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-orange-100">
                            View DSA Claims →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-07 ALLOWANCE --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('allowance-forms.index') ? route('allowance-forms.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-rose-500 to-red-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-07
                                </span>

                                <p class="mt-3 text-sm font-semibold text-rose-100">
                                    Allowance Forms
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($allowance) }}
                                </h3>

                                <p class="mt-2 text-xs text-rose-100">
                                    Allowance records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                💰
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-rose-100">
                            View Allowances →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-09 VERBAL QUOTE --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('verbal-quotes.index') ? route('verbal-quotes.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-500 to-rose-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-09
                                </span>

                                <p class="mt-3 text-sm font-semibold text-pink-100">
                                    Verbal Quote
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($verbalQuotes) }}
                                </h3>

                                <p class="mt-2 text-xs text-pink-100">
                                    Quotation records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                📝
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-pink-100">
                            View Verbal Quotes →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-10 QUOTATION ANALYSIS --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('quotation-analyses.index') ? route('quotation-analyses.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-violet-600 to-purple-700 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-10
                                </span>

                                <p class="mt-3 text-sm font-semibold text-violet-100">
                                    Quotation Analysis
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($quotationAnalyses) }}
                                </h3>

                                <p class="mt-2 text-xs text-violet-100">
                                    Evaluation records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                📊
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-violet-100">
                            View Quotation Analysis →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-11 PURCHASE ORDER --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('purchase-orders.index') ? route('purchase-orders.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-600 to-gray-800 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-11
                                </span>

                                <p class="mt-3 text-sm font-semibold text-slate-100">
                                    Purchase Order
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($purchaseOrders) }}
                                </h3>

                                <p class="mt-2 text-xs text-slate-200">
                                    Purchase order records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                📦
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-slate-200">
                            View Purchase Orders →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-12 SERVICE RECEIVED NOTE --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('service-received-notes.index') ? route('service-received-notes.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-lime-600 to-green-700 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-12
                                </span>

                                <p class="mt-3 text-sm font-semibold text-lime-100">
                                    Service Received Note
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($serviceReceivedNotes) }}
                                </h3>

                                <p class="mt-2 text-xs text-lime-100">
                                    Service records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                📋
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-lime-100">
                            View Service Notes →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ===================================================== --}}
                {{-- FM02-14 INVOICE --}}
                {{-- ===================================================== --}}

                <a href="{{ Route::has('invoices.index') ? route('invoices.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-fuchsia-600 to-purple-700 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <div class="flex items-start justify-between">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold tracking-wider">
                                    FM02-14
                                </span>

                                <p class="mt-3 text-sm font-semibold text-fuchsia-100">
                                    Invoice
                                </p>

                                <h3 class="mt-2 text-4xl font-bold">
                                    {{ number_format($invoices) }}
                                </h3>

                                <p class="mt-2 text-xs text-fuchsia-100">
                                    Invoice records
                                </p>
                            </div>

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                🧾
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-fuchsia-100">
                            View Invoices →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


            </div>

        </div>

    </div>
@endsection
