<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>{{ $attendantList->title }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <style>
        body {
            font-family: Inter, Arial, sans-serif;
        }
    </style>

</head>

<body class="bg-slate-100">

    <div class="flex justify-center py-6">

        <div id="card-{{ $attendantList->id }}" type="button"
            onclick="downloadCard({{ $attendantList->id }}, '{{ addslashes($attendantList->title) }}')"
            class="w-[400px] cursor-pointer overflow-hidden rounded-2xl bg-white shadow-2xl">

            {{-- Top Border --}}
            <div class="h-5 rounded-b-[0px] bg-green-600"></div>

            <div class="px-6 py-6">


                {{-- Title --}}
                <h1 class="mt-6 text-center text-xl font-extrabold leading-snug text-slate-800">

                    {{ $attendantList->title }}

                </h1>

                {{-- QR --}}
                <div class="mt-6 flex justify-center">

                    <div class="rounded-[28px] border border-gray-200 bg-white p-5 shadow-lg">

                        <img src="{{ asset('storage/' . $attendantList->qr_code_path) }}" class="w-48 h-48">

                    </div>

                </div>

                {{-- Information --}}
                <div class="mt-6 flex flex-col justify-center items-start gap-2 ml-[12%]">

                    {{-- Date --}}
                    <div class="flex items-center justify-center gap-4">

                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                            </svg>

                        </div>

                        <div class="text-base">

                            <span class="font-bold">

                                Date:

                            </span>

                            {{ \Carbon\Carbon::parse($attendantList->start_date)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($attendantList->end_date)->format('d M Y') }}

                        </div>

                    </div>

                    {{-- Time --}}
                    <div class="flex items-center justify-center gap-4">

                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />

                            </svg>

                        </div>

                        <div class="text-base">

                            <span class="font-bold">

                                Time:

                            </span>

                            {{ $attendantList->start_time ? \Carbon\Carbon::parse($attendantList->start_time)->format('g:i A') : '7:30 AM' }}

                            -

                            {{ $attendantList->end_time ? \Carbon\Carbon::parse($attendantList->end_time)->format('g:i A') : '5:00 PM' }}

                        </div>

                    </div>

                    {{-- Venue --}}
                    <div class="flex items-center justify-center gap-4">

                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0L6.343 16.657A8 8 0 1117.657 16.657z" />

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0" />

                            </svg>

                        </div>

                        <div class="text-base">

                            <span class="font-bold">

                                Location:

                            </span>

                            {{ $attendantList->venue ?: 'TBC' }}

                        </div>

                    </div>

                </div>

            </div>

            {{-- Bottom Border --}}
            <div class="h-5 rounded-t-[0px] bg-green-600"></div>
        </div>

    </div>
    <script>
        async function downloadCard(id, title) {

            const card = document.getElementById(`card-${id}`);

            if (!card) {
                alert("Card not found.");
                return;
            }

            // Temporarily remove shadow for a cleaner image (optional)
            const originalShadow = card.style.boxShadow;
            card.style.boxShadow = "none";

            const canvas = await html2canvas(card, {
                backgroundColor: "#ffffff",
                scale: 3, // Higher quality
                useCORS: true,
                allowTaint: false,
                logging: false
            });

            // Restore shadow
            card.style.boxShadow = originalShadow;

            let safeTitle = title
                .trim()
                .replace(/[^\w\s-]/g, "")
                .replace(/\s+/g, "_")
                .substring(0, 60);

            const link = document.createElement("a");
            link.download = `${safeTitle}.png`;
            link.href = canvas.toDataURL("image/png");
            link.click();
        }
    </script>
</body>

</html>
