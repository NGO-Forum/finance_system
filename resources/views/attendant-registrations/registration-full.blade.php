<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration Closed</title>

    <link rel="icon" href="{{ asset('logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen">

    <div class="flex min-h-screen items-center justify-center p-6">

        <div class="w-full max-w-xl overflow-hidden rounded-3xl bg-white shadow-2xl">

            <div class="bg-gradient-to-r from-red-700 to-rose-600 px-10 py-8 text-center">

                <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-white shadow-lg">

                    <svg class="h-14 w-14 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </div>

                <h1 class="mt-6 text-4xl font-bold text-white">
                    Registration Closed
                </h1>

            </div>

            <div class="px-10 py-10 text-center">

                <p class="text-xl font-semibold text-gray-800">
                    Maximum Participants Reached
                </p>

                <p class="mt-4 text-gray-600 leading-7">
                    We appreciate your interest.
                    Unfortunately, this activity has reached its maximum number of participants,
                    so registration is now closed.
                </p>

                <div class="mt-8 rounded-xl border border-red-200 bg-red-50 p-5">

                    <p class="text-sm text-red-700">
                        Registration is no longer available because all available participant
                        slots have been filled.
                    </p>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
