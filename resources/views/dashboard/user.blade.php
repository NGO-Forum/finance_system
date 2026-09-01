@extends('layout.app')

@section('content')
    <div class="min-h-screen space-y-5 pb-10">

        <div
            class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-700 via-green-700 to-teal-800 p-6 text-white shadow-xl sm:p-8 lg:p-10">

            {{-- Decorative circles --}}
            <div class="absolute -right-16 -top-16 h-56 w-56 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-24 right-20 h-64 w-64 rounded-full bg-white/5"></div>
            <div class="absolute -left-20 bottom-0 h-40 w-40 rounded-full bg-emerald-300/10"></div>

            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                {{-- User information --}}
                <div>

                    <div
                        class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-medium backdrop-blur-sm">

                        <span class="h-2 w-2 rounded-full bg-emerald-300"></span>

                        {{ auth()->user()->role?->name ?? 'User' }} Dashboard

                    </div>


                    <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">

                        Welcome, {{ auth()->user()->name }}

                    </h1>


                    <p class="mt-3 max-w-3xl text-sm leading-6 text-emerald-100 sm:text-base">

                        Manage your finance forms, purchase requests,
                        expenditures and other financial activities from one place.

                    </p>

                </div>


                {{-- Date --}}
                <div
                    class="rounded-2xl border border-white/20 bg-white/10 px-6 py-5 text-left backdrop-blur-md lg:min-w-[190px] lg:text-right">

                    {{ now()->format('l') }},

                    {{ now()->format('d') }}

                    {{ now()->format('F Y') }}

                </div>

            </div>

        </div>


        <div>

            <div class="mb-5  bg-green-700 p-5 rounded-lg">

                <h2 class="text-xl font-bold text-white">
                    My Request Overview
                </h2>

                <p class="mt-1 text-sm text-gray-200">
                    Overview of your submitted Purchase Requests
                </p>

            </div>


            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                {{-- TOTAL --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total Requests
                            </p>

                            <h3 class="mt-3 text-4xl font-bold tracking-tight text-gray-800">

                                {{ number_format($purchaseRequests) }}

                            </h3>

                            <p class="mt-2 text-xs text-gray-400">
                                My Purchase Requests
                            </p>

                        </div>


                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-2xl transition group-hover:scale-110">

                            🛒

                        </div>

                    </div>

                    <div class="absolute bottom-0 left-0 h-1 w-full bg-blue-500"></div>

                </div>


                {{-- PENDING --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-yellow-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-yellow-600">
                                Pending
                            </p>

                            <h3 class="mt-3 text-4xl font-bold tracking-tight text-yellow-700">

                                {{ number_format($purchaseRequestsPending) }}

                            </h3>

                            <p class="mt-2 text-xs text-gray-400">
                                Waiting for approval
                            </p>

                        </div>


                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-yellow-50 text-2xl transition group-hover:scale-110">

                            ⏳

                        </div>

                    </div>

                    <div class="absolute bottom-0 left-0 h-1 w-full bg-yellow-500"></div>

                </div>


                {{-- APPROVED --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-green-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-green-600">
                                Approved
                            </p>

                            <h3 class="mt-3 text-4xl font-bold tracking-tight text-green-700">

                                {{ number_format($purchaseRequestsApproved) }}

                            </h3>

                            <p class="mt-2 text-xs text-gray-400">
                                Approved requests
                            </p>

                        </div>


                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-50 text-2xl transition group-hover:scale-110">

                            ✓

                        </div>

                    </div>

                    <div class="absolute bottom-0 left-0 h-1 w-full bg-green-500"></div>

                </div>


                {{-- REJECTED --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-red-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-red-600">
                                Rejected
                            </p>

                            <h3 class="mt-3 text-4xl font-bold tracking-tight text-red-700">

                                {{ number_format($purchaseRequestsRejected) }}

                            </h3>

                            <p class="mt-2 text-xs text-gray-400">
                                Rejected requests
                            </p>

                        </div>


                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-50 text-2xl transition group-hover:scale-110">

                            ✕

                        </div>

                    </div>

                    <div class="absolute bottom-0 left-0 h-1 w-full bg-red-500"></div>

                </div>

            </div>

        </div>


        <div>

            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between bg-green-700 p-5 rounded-lg">

                <div>

                    <h2 class="text-2xl font-bold text-white">
                        My Finance Forms
                    </h2>

                    <p class="mt-1 text-sm text-gray-200">
                        Access and manage your submitted forms
                    </p>

                </div>


                <div
                    class="inline-flex w-fit items-center gap-2 rounded-full bg-emerald-50 px-4 py-2 text-xs font-semibold text-emerald-700">

                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                    My Records

                </div>

            </div>


            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                {{-- ================================================= --}}
                {{-- FM02-02 --}}
                {{-- ================================================= --}}

                <a href="{{ Route::has('fund-requests.index') ? route('fund-requests.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold tracking-wider">
                            FM02-02
                        </span>

                        <div class="mt-5 flex items-start justify-between">

                            <div>

                                <h3 class="text-lg font-semibold">
                                    Concept Note
                                </h3>

                                <p class="mt-2 text-4xl font-bold">
                                    {{ number_format($fundRequests) }}
                                </p>

                                <p class="mt-2 text-xs text-blue-100">
                                    Concept notes
                                </p>

                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                📝
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-blue-100">
                            View Concept Notes →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ================================================= --}}
                {{-- FM02-03 --}}
                {{-- ================================================= --}}

                <a href="{{ Route::has('expenditure-summaries.index') ? route('expenditure-summaries.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-500 to-orange-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold tracking-wider">
                            FM02-03
                        </span>

                        <div class="mt-5 flex items-start justify-between">

                            <div>

                                <h3 class="text-lg font-semibold">
                                    Expenditure Summary
                                </h3>

                                <p class="mt-2 text-4xl font-bold">
                                    {{ number_format($expenditureSummaries) }}
                                </p>

                                <p class="mt-2 text-xs text-red-100">
                                    Expenditure records
                                </p>

                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                💵
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-red-100">
                            View Expenditure →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ================================================= --}}
                {{-- FM02-04 --}}
                {{-- ================================================= --}}

                <a href="{{ Route::has('purchase-requests.index') ? route('purchase-requests.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-cyan-600 to-blue-700 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold tracking-wider">
                            FM02-04
                        </span>

                        <div class="mt-5 flex items-start justify-between">

                            <div>

                                <h3 class="text-lg font-semibold">
                                    Purchase Request
                                </h3>

                                <p class="mt-2 text-4xl font-bold">
                                    {{ number_format($purchaseRequests) }}
                                </p>

                                <p class="mt-2 text-xs text-cyan-100">
                                    Purchase requests
                                </p>

                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                🛒
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-cyan-100">
                            View Purchase Requests →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ================================================= --}}
                {{-- FM02-05 --}}
                {{-- ================================================= --}}

                <a href="{{ Route::has('attendant-lists.index') ? route('attendant-lists.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 to-yellow-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold tracking-wider">
                            FM02-05
                        </span>

                        <div class="mt-5 flex items-start justify-between">

                            <div>

                                <h3 class="text-lg font-semibold">
                                    Attendant Lists
                                </h3>

                                <p class="mt-2 text-4xl font-bold">
                                    {{ number_format($attendateList) }}
                                </p>

                                <p class="mt-2 text-xs text-amber-100">
                                    Attendance records
                                </p>

                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                👥
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-amber-100">
                            View Attendant Lists →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ================================================= --}}
                {{-- FM02-06 --}}
                {{-- ================================================= --}}

                <a href="{{ Route::has('dsa-claims.index') ? route('dsa-claims.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold tracking-wider">
                            FM02-06
                        </span>

                        <div class="mt-5 flex items-start justify-between">

                            <div>

                                <h3 class="text-lg font-semibold">
                                    DSA Claim
                                </h3>

                                <p class="mt-2 text-4xl font-bold">
                                    {{ number_format($dsaClaims ?? 0) }}
                                </p>

                                <p class="mt-2 text-xs text-orange-100">
                                    DSA claims
                                </p>

                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                ✈️
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-orange-100">
                            View DSA Claims →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ================================================= --}}
                {{-- FM02-07 --}}
                {{-- ================================================= --}}

                <a href="{{ Route::has('allowance-forms.index') ? route('allowance-forms.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-rose-500 to-red-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold tracking-wider">
                            FM02-07
                        </span>

                        <div class="mt-5 flex items-start justify-between">

                            <div>

                                <h3 class="text-lg font-semibold">
                                    Allowance Forms
                                </h3>

                                <p class="mt-2 text-4xl font-bold">
                                    {{ number_format($allowance) }}
                                </p>

                                <p class="mt-2 text-xs text-rose-100">
                                    Allowance records
                                </p>

                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                💰
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-rose-100">
                            View Allowances →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ================================================= --}}
                {{-- FM02-09 --}}
                {{-- ================================================= --}}

                <a href="{{ Route::has('verbal-quotes.index') ? route('verbal-quotes.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-500 to-rose-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold tracking-wider">
                            FM02-09
                        </span>

                        <div class="mt-5 flex items-start justify-between">

                            <div>

                                <h3 class="text-lg font-semibold">
                                    Verbal Quote
                                </h3>

                                <p class="mt-2 text-4xl font-bold">
                                    {{ number_format($verbalQuotes) }}
                                </p>

                                <p class="mt-2 text-xs text-pink-100">
                                    Quotation records
                                </p>

                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                📝
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-pink-100">
                            View Verbal Quotes →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>


                {{-- ================================================= --}}
                {{-- FM02-10 --}}
                {{-- ================================================= --}}

                <a href="{{ Route::has('quotation-analyses.index') ? route('quotation-analyses.index') : '#' }}"
                    class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-violet-600 to-purple-700 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                    <div class="relative z-10">

                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold tracking-wider">
                            FM02-10
                        </span>

                        <div class="mt-5 flex items-start justify-between">

                            <div>

                                <h3 class="text-lg font-semibold">
                                    Quotation Analysis
                                </h3>

                                <p class="mt-2 text-4xl font-bold">
                                    {{ number_format($quotationAnalyses) }}
                                </p>

                                <p class="mt-2 text-xs text-violet-100">
                                    Evaluation records
                                </p>

                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl">
                                📊
                            </div>

                        </div>

                        <div class="mt-5 border-t border-white/20 pt-4 text-xs text-violet-100">
                            View Quotation Analysis →
                        </div>

                    </div>

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>

                </a>

            </div>

        </div>


    </div>
@endsection
