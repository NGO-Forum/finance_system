@extends('layout.app')

@section('content')
    <div class="space-y-5">

        <!-- Welcome -->
        <div class="rounded-3xl bg-gradient-to-r from-green-700 to-emerald-600 p-8 text-white shadow-lg">

            <div class="flex items-center justify-between">

                <div>

                    <h1 class="text-3xl font-bold">
                        Welcome, {{ auth()->user()->name }}
                    </h1>

                    <p class="mt-2 text-green-100">
                        Finance Management Dashboard
                    </p>

                </div>

                <div class="text-right">

                    <div class="text-lg">
                        {{ now()->format('d M Y') }}
                    </div>

                    <div class="text-sm text-green-100">
                        {{ now()->format('l') }}
                    </div>

                </div>

            </div>

        </div>

        <!-- Master Data -->

        <div>

            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-5">

                {{-- Users --}}
                <div
                    class="group rounded-3xl bg-white p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 font-medium">
                                Users
                            </p>

                            <h2 class="mt-3 text-4xl font-bold text-gray-800">
                                {{ number_format($users) }}
                            </h2>
                        </div>

                        <div
                            class="h-16 w-16 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center text-3xl">
                            👥
                        </div>

                    </div>

                </div>

                {{-- Departments --}}
                <div
                    class="group rounded-3xl bg-white p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 font-medium">
                                Departments
                            </p>

                            <h2 class="mt-3 text-4xl font-bold text-gray-800">
                                {{ number_format($departments) }}
                            </h2>
                        </div>

                        <div
                            class="h-16 w-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-3xl">
                            🏢
                        </div>

                    </div>

                </div>

                {{-- Roles --}}
                <div
                    class="group rounded-3xl bg-white p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 font-medium">
                                Roles
                            </p>

                            <h2 class="mt-3 text-4xl font-bold text-gray-800">
                                {{ number_format($roles) }}
                            </h2>
                        </div>

                        <div
                            class="h-16 w-16 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-3xl">
                            🔐
                        </div>

                    </div>

                </div>

                {{-- Donors --}}
                <div
                    class="group rounded-3xl bg-white p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 font-medium">
                                Donors
                            </p>

                            <h2 class="mt-3 text-4xl font-bold text-gray-800">
                                {{ number_format($donors) }}
                            </h2>
                        </div>

                        <div
                            class="h-16 w-16 rounded-2xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-3xl">
                            🤝
                        </div>

                    </div>

                </div>

                {{-- Fund Requests --}}
                <div
                    class="group rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-700 p-6 text-white shadow-lg hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-blue-100 font-medium">
                                Concept Note
                            </p>

                            <h2 class="mt-3 text-4xl font-bold">
                                {{ number_format($fundRequests) }}
                            </h2>
                        </div>

                        <div class="h-16 w-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                            📝
                        </div>

                    </div>

                </div>

                {{-- Expenditure --}}
                <div
                    class="group rounded-3xl bg-gradient-to-br from-red-600 to-orange-600 p-6 text-white shadow-lg hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-red-100 font-medium">
                                Expenditure
                            </p>

                            <h2 class="mt-3 text-4xl font-bold">
                                {{ number_format($expenditureSummaries) }}
                            </h2>
                        </div>

                        <div class="h-16 w-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                            💵
                        </div>

                    </div>

                </div>

                {{-- Finance Forms --}}
                {{-- <div
                    class="group rounded-3xl bg-gradient-to-br from-emerald-600 to-green-700 p-6 text-white shadow-lg hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-green-100 font-medium">
                                Finance Forms
                            </p>

                            <h2 class="mt-3 text-4xl font-bold">
                                {{ number_format($financeForms) }}
                            </h2>
                        </div>

                        <div class="h-16 w-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                            📄
                        </div>

                    </div>

                </div> --}}

                {{-- Attendant list Forms --}}
                <div
                    class="group rounded-3xl bg-gradient-to-br from-amber-500 to-amber-600 p-6 text-white shadow-lg hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-green-100 font-medium">
                                Attendant list Forms
                            </p>

                            <h2 class="mt-3 text-4xl font-bold">
                                {{ number_format($attendateList) }}
                            </h2>
                        </div>

                        <div class="h-16 w-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                            📄
                        </div>

                    </div>

                </div>

                {{-- Allowance Forms --}}
                <div
                    class="group rounded-3xl bg-gradient-to-br from-red-400 to-red-500 p-6 text-white shadow-lg hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-green-100 font-medium">
                                Allowance Forms
                            </p>

                            <h2 class="mt-3 text-4xl font-bold">
                                {{ number_format($allowance) }}
                            </h2>
                        </div>

                        <div class="h-16 w-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                            📄
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
