<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration Closed</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    {{-- =========================================================
        Background
    ========================================================== --}}
    <div class="relative min-h-screen overflow-hidden">

        {{-- Background decorations --}}
        <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-green-100/60 blur-3xl"></div>

        <div class="absolute -right-32 bottom-0 h-96 w-96 rounded-full bg-emerald-100/60 blur-3xl"></div>

        <div class="relative flex min-h-screen items-center justify-center px-4 py-4">

            <div class="w-full max-w-3xl">


                {{-- =================================================
                    Card
                ================================================== --}}
                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white
                           shadow-[0_30px_80px_-25px_rgba(15,23,42,0.20)]">

                    <div class="h-1.5 bg-gradient-to-t from-green-700 via-emerald-500 to-green-700"></div>

                    {{-- =================================================
                        Main Content
                    ================================================== --}}
                    <div class="px-6 py-6 sm:px-12 sm:py-8">


                        {{-- =============================================
                            Closed Icon
                        ============================================== --}}
                        <div class="flex justify-center">

                            <div
                                class="flex h-28 w-28 items-center justify-center rounded-full
                                       bg-red-50 ring-8 ring-red-50">

                                <div
                                    class="flex h-20 w-20 items-center justify-center rounded-full
                                           bg-red-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />

                                    </svg>

                                </div>

                            </div>

                        </div>


                        {{-- =============================================
                            Status
                        ============================================== --}}
                        <div class="mt-6 flex justify-center">

                            <span
                                class="inline-flex items-center gap-2 rounded-full
                                       border border-red-100 bg-red-50 px-4 py-2
                                       text-xs font-bold uppercase tracking-wider text-red-600">

                                <span class="relative flex h-2.5 w-2.5">

                                    <span
                                        class="absolute inline-flex h-full w-full animate-ping
                                               rounded-full bg-red-400 opacity-60">
                                    </span>

                                    <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-red-500">
                                    </span>

                                </span>

                                Registration Closed

                            </span>

                        </div>


                        {{-- =============================================
                            Title
                        ============================================== --}}
                        <div class="mt-5 text-center">

                            <h1
                                class="text-lg font-extrabold tracking-tight text-red-600 sm:text-2xl uppercase">

                                Registration is Closed

                            </h1>

                            <p class="mt-3 text-lg font-medium text-red-600">
                                ការចុះឈ្មោះបានបិទ
                            </p>

                        </div>


                        {{-- =============================================
                            Message
                        ============================================== --}}
                        <div class="mx-auto mt-6 max-w-2xl text-center">

                            <p class="text-sm leading-7 text-slate-600 sm:text-base">

                                Thank you for your interest in participating.
                                Registration for this activity is no longer available.

                            </p>

                            <p class="mt-2 text-sm leading-7 text-slate-600">

                                សូមអរគុណចំពោះការចាប់អារម្មណ៍របស់អ្នក។
                                ការចុះឈ្មោះសម្រាប់សកម្មភាពនេះត្រូវបានបិទហើយ។

                            </p>

                        </div>


                        {{-- =============================================
                            Status Information
                        ============================================== --}}
                        <div
                            class="mx-auto mt-8 max-w-xl overflow-hidden rounded-2xl
                                   border border-slate-200 bg-slate-50">

                            <div class="flex items-center gap-4 px-5 py-5">

                                {{-- Icon --}}
                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center
                                           rounded-xl bg-white shadow-sm ring-1 ring-slate-200">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />

                                    </svg>

                                </div>


                                {{-- Text --}}
                                <div class="min-w-0 text-left">

                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                        Registration Status
                                    </p>

                                    <p class="mt-1 text-sm font-bold text-slate-700">
                                        This registration form is no longer accepting responses.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- =============================================
                            Contact Information
                        ============================================== --}}
                        <div
                            class="mx-auto mt-5 max-w-xl rounded-2xl border border-green-100
                                   bg-green-50 px-3 md:px-5 py-3 md:py-5">

                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center
                                           rounded-xl bg-white shadow-sm">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m6-4a9 9 0 11-18 0 9 9 0 0118 0z" />

                                    </svg>

                                </div>


                                <div class="text-left">

                                    <h3 class="text-xs font-bold text-green-800">
                                        Need assistance?
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-green-700">
                                        Please contact the activity organizer
                                        if you need further information.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- =============================================
                            Footer Divider
                        ============================================== --}}
                        <div class="mt-10 flex items-center gap-4">

                            <div class="h-px flex-1 bg-slate-200"></div>

                            <div class="h-2 w-2 rounded-full bg-green-500"></div>

                            <div class="h-px flex-1 bg-slate-200"></div>

                        </div>


                        {{-- =============================================
                            Footer
                        ============================================== --}}
                        <div class="mt-6 text-center">

                            <p class="text-xs font-medium text-slate-600">
                                Thank you for your understanding.
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Attendance Registration System
                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                        Bottom Accent
                    ================================================== --}}
                    <div class="h-1.5 bg-gradient-to-r from-green-700 via-emerald-500 to-green-700"></div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
