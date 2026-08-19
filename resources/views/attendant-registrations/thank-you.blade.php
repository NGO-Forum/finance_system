<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration Confirmation</title>

    <link rel="icon" href="{{ asset('logo.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-gradient-to-br from-emerald-700 via-green-600 to-lime-500">

    <div class="max-w-3xl mx-auto px-4 py-6">

        <div class="overflow-hidden rounded-3xl bg-white shadow-2xl">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-emerald-700 via-green-600 to-lime-600">

                <div class="p-2 md:p-6">

                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

                        {{-- Left --}}
                        <div class="flex items-center gap-5">

                            <div class="rounded-full bg-white p-3 shadow-xl">

                                <img src="{{ asset('/images/logo.png') }}" class="h-24 w-24 object-contain">

                            </div>

                            <div>

                                <span
                                    class="inline-flex items-center rounded-full bg-white/20 px-4 py-1 text-xs md:text-sm font-medium text-white">

                                    Registration Confirmed

                                </span>

                                <h1 class="mt-1 md:mt-3 text-lg md:text-3xl font-bold text-white">

                                    {{ $attendantList->title }}

                                </h1>

                                <div class="mt-3 flex flex-wrap items-center gap-5 text-green-100">

                                    <span>

                                        📅
                                        {{ \Carbon\Carbon::parse($attendantList->activity_date)->format('d F Y') }}

                                    </span>

                                    @if ($attendantList->venue)
                                        <span>

                                            📍 {{ $attendantList->venue }}

                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            {{-- Welcome --}}
            <div class="border-b bg-green-50 px-6 py-4">

                <h2 class="text-lg md:text-2xl font-bold text-gray-800">

                    Congratulations,
                    <span class="text-emerald-700">
                        {{ strtoupper($registration->full_name) }}
                    </span>

                </h2>

                <p class="mt-1 md:mt-2 text-xs md:text-base leading-8 text-gray-600">

                    Your registration has been submitted successfully.
                    Please review your information below and keep this page
                    as confirmation of your registration.

                </p>

            </div>

            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b bg-emerald-600 px-6 py-4">

                    <h2 class="text-xl font-bold text-white">
                        Participant Information
                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm md:text-base">

                        <tbody class="divide-y divide-gray-100">

                            <tr>
                                <td class="w-1/3 px-6 py-3 font-semibold text-gray-800">
                                    Full Name
                                </td>

                                <td class="w-8 text-center font-bold">
                                    :
                                </td>

                                <td class="px-6 py-3 text-gray-700">
                                    {{ $registration->full_name }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-semibold">
                                    Gender
                                </td>

                                <td class="text-center font-bold">
                                    :
                                </td>

                                <td class="px-6 py-3">
                                    {{ $registration->gender ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-semibold">
                                    Age Group
                                </td>

                                <td class="text-center font-bold">
                                    :
                                </td>

                                <td class="px-6 py-3">
                                    {{ $registration->age_group ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-semibold">
                                    Organization
                                </td>

                                <td class="text-center font-bold">
                                    :
                                </td>

                                <td class="px-6 py-3">
                                    {{ $registration->institution ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-semibold">
                                    Position
                                </td>

                                <td class="text-center font-bold">
                                    :
                                </td>

                                <td class="px-6 py-3">
                                    {{ $registration->position ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-semibold">
                                    Province
                                </td>

                                <td class="text-center font-bold">
                                    :
                                </td>

                                <td class="px-6 py-3">
                                    {{ $registration->province ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-semibold">
                                    Email
                                </td>

                                <td class="text-center font-bold">
                                    :
                                </td>

                                <td class="px-6 py-3 break-all">
                                    {{ $registration->email ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-semibold">
                                    Contact Number
                                </td>

                                <td class="text-center font-bold">
                                    :
                                </td>

                                <td class="px-6 py-3">
                                    {{ $registration->phone ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-semibold">
                                    Registration Date
                                </td>

                                <td class="text-center font-bold">
                                    :
                                </td>

                                <td class="px-6 py-3">
                                    {{ $registration->created_at->format('d M Y') }}
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Buttons --}}
            {{-- <div class="flex justify-end m-2">

                <button onclick="window.print()"
                    class="rounded-xl bg-slate-700 px-8 py-3 font-semibold text-white transition hover:bg-slate-800">

                    🖨 Print Confirmation

                </button>

            </div> --}}

            {{-- Footer --}}
            <div class="border-t bg-gray-50 px-8 py-6 text-center text-sm text-gray-500">

                © {{ date('Y') }}

                <span class="font-semibold text-emerald-700">

                    NGO Forum on Cambodia

                </span>

                <br>

                Registration Confirmation System

            </div>

        </div>

    </div>

</body>

</html>
