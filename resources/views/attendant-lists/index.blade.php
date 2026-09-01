@extends('layout.app')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div class="mb-4 rounded-3xl bg-gradient-to-r from-emerald-700 via-green-600 to-emerald-500 p-8 shadow-xl">

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                {{-- Left --}}
                <div class="flex items-center gap-5">

                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/20 backdrop-blur">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5V4H2v16h5m10 0v-4H7v4m10 0H7" />

                        </svg>

                    </div>

                    <div>

                        <h1 class="text-3xl font-bold text-white">

                            Attendance Management

                        </h1>

                        <p class="mt-2 text-emerald-100">

                            Create attendance sheets, manage online registrations,
                            export Excel, print PDF, and generate QR Codes.

                        </p>

                    </div>

                </div>

                {{-- Right --}}
                <div class="flex flex-wrap gap-3">

                    {{-- Template --}}
                    <button type="button" onclick="document.getElementById('templateModal').classList.remove('hidden')"
                        class="inline-flex items-center rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white shadow-lg hover:bg-blue-700">

                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v14l-5-3-5 3-5-3V6a2 2 0 012-2z" />

                        </svg>

                        Template

                    </button>

                    <a href="{{ route('attendant-lists.create') }}"
                        class="inline-flex items-center rounded-xl bg-white px-6 py-3 font-semibold text-green-700 shadow-lg transition hover:-translate-y-1 hover:bg-green-50">

                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        New

                    </a>

                </div>

            </div>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

                {{ session('success') }}

            </div>
        @endif

        {{-- Search --}}
        <div class="bg-white rounded-2xl shadow p-6 mb-4">

            <form method="GET">

                <div class="grid grid-cols-1 md:grid-cols-7 gap-4">

                    <div class="md:col-span-6">

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search title or venue..."
                            class="w-full rounded-xl border-gray-300 focus:border-green-600 focus:ring-green-600">

                    </div>

                    <div>

                        <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl">

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

        {{-- Attendance List Table --}}

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-green-700 text-white">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase">
                                #
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase">
                                Activity
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase">
                                Venue
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase">
                                Date
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase">
                                Participants
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase">
                                QR Code
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase">
                                Register Link
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($attendantLists as $list)
                            <tr class="hover:bg-green-50 transition">

                                {{-- No --}}
                                <td class="px-6 py-2">

                                    {{ $loop->iteration + ($attendantLists->currentPage() - 1) * $attendantLists->perPage() }}

                                </td>

                                {{-- Activity --}}
                                <td class="px-6 py-2">

                                    <div class="w-[450px] line-clamp-1">

                                        <h3 class="font-semibold text-gray-900">

                                            {{ $list->title }}

                                        </h3>

                                    </div>

                                </td>

                                {{-- Venue --}}
                                <td class="px-6 py-2">

                                    @if ($list->venue)
                                        <span class="text-gray-700">

                                            {{ $list->venue }}

                                        </span>
                                    @else
                                        <span class="text-gray-400">

                                            —

                                        </span>
                                    @endif

                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-2 text-center">

                                    {{ $list->start_date->format('d M Y') }}

                                </td>

                                {{-- Participants --}}
                                <td class="px-6 py-2 text-center">

                                    <div class="font-bold text-green-700">

                                        {{ $list->registered_count }}

                                        @if ($list->max_participants)
                                            <span class="text-gray-500">

                                                / {{ $list->max_participants }}

                                            </span>
                                        @endif
                                    </div>

                                </td>

                                <td class="px-6 py-2 text-center">

                                    @if ($list->registration_enabled)
                                        <a href="{{ route('attendant-lists.qr-preview', $list) }}" target="_blank"
                                            class="inline-flex items-center rounded-lg bg-green-100 px-3 py-2 text-xs font-medium text-green-700 hover:bg-green-200">

                                            Download QR

                                        </a>
                                    @else
                                        <span class="rounded-lg bg-gray-100 px-3 py-2 text-sm text-gray-500">

                                            Disabled

                                        </span>
                                    @endif

                                </td>

                                {{-- Register Link --}}
                                <td class="px-6 py-2 text-center">

                                    @if ($list->registration_enabled)
                                        <a href="{{ $list->registration_link }}" target="_blank"
                                            class="inline-flex items-center rounded-lg bg-green-100 px-3 py-2 text-xs font-medium text-green-700 hover:bg-green-200">

                                            Open Link

                                        </a>
                                    @else
                                        <span class="rounded-lg bg-gray-100 px-3 py-2 text-sm text-gray-500">

                                            Disabled

                                        </span>
                                    @endif

                                </td>

                                <td class="relative px-6 py-2 text-center">

                                    <button onclick="toggleMenu({{ $list->id }})"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-lg hover:bg-gray-100">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                                            fill="currentColor" viewBox="0 0 20 20">

                                            <path
                                                d="M10 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />

                                        </svg>

                                    </button>

                                    <div id="menu-{{ $list->id }}"
                                        class="absolute right-6 z-50 -mt-4 hidden w-14 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl">

                                        <a href="{{ route('attendant-registrations.index', $list) }}"
                                            class="flex items-center gap-3 px-4 py-3 text-sm text-green-600 hover:bg-green-50 hover:text-green-700">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-8 0v2m8 0H9m4-10a4 4 0 11-8 0 4 4 0 018 0z" />

                                            </svg>

                                        </a>

                                        <a href="{{ route('attendant-lists.edit', $list) }}"
                                            class="flex items-center gap-3 px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 hover:text-blue-700">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 8.586-8.586z" />

                                            </svg>

                                        </a>

                                        <button onclick="deleteItem({{ $list->id }})"
                                            class="flex w-full items-center gap-3 px-4 py-3 text-left text-sm text-red-600 hover:bg-red-50">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />

                                            </svg>

                                        </button>

                                        <!-- Hidden Delete Form -->
                                        <form id="delete-form-{{ $list->id }}"
                                            action="{{ route('attendant-lists.destroy', $list->id) }}" method="POST"
                                            class="hidden">

                                            @csrf
                                            @method('DELETE')

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="px-6 py-16 text-center text-gray-500">

                                    No attendance list found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div id="templateModal" class="fixed inset-0 z-50 hidden bg-black/50">

            <div class="flex min-h-[80vh] items-center justify-center p-4">

                <div class="w-full max-w-lg rounded-2xl bg-white">

                    <div class="border-b px-6 py-4">

                        <h2 class="text-xl font-bold text-green-700">

                            Select Donor Logos

                        </h2>

                    </div>

                    <form id="exportTemplateForm" action="{{ route('attendant-lists.template.export') }}"
                        method="POST">

                        @csrf

                        <div class="max-h-[75vh] overflow-y-auto p-6">

                            {{-- Optional message --}}
                            <div class="mb-4 rounded-lg bg-red-50 p-3 text-sm text-red-700">
                                Select donor logo(s) if you want them to appear on the template.
                                You may leave all options unchecked.
                            </div>

                            @foreach ($donorLogos as $logo)
                                <label
                                    class="mb-3 flex cursor-pointer items-center gap-4 rounded-xl border p-3 transition hover:bg-gray-50">

                                    <input type="checkbox" name="donor_logo_ids[]" value="{{ $logo->id }}"
                                        class="h-5 w-5 rounded border-gray-300 text-green-600">

                                    <img src="{{ asset('storage/' . $logo->logo) }}" class="h-14 w-14 object-contain">

                                    <span class="font-medium">
                                        {{ $logo->name }}
                                    </span>

                                </label>
                            @endforeach

                        </div>

                        <div class="flex justify-end border-t px-6 py-4">

                            <div class="space-x-2">

                                <button type="button"
                                    onclick="document.getElementById('templateModal').classList.add('hidden')"
                                    class="rounded-lg text-white bg-amber-300 hover:bg-amber-500 border px-5 py-2">

                                    Cancel

                                </button>

                                <button type="submit"
                                    class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700">

                                    Export PDF

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>
        function copyLink(link) {
            navigator.clipboard.writeText(link);

            alert('Registration link copied.');
        }

        function deleteItem(id) {

            Swal.fire({
                title: 'Delete Attendance List?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {

                if (result.isConfirmed) {

                    const form = document.getElementById('delete-form-' + id);

                    if (!form) {

                        console.error('Delete form not found. ID:', id);

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Delete form could not be found.'
                        });

                        return;
                    }

                    form.submit();
                }
            });
        }

        function toggleMenu(id) {

            // Close all other menus
            document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                if (menu.id !== 'menu-' + id) {
                    menu.classList.add('hidden');
                }
            });

            document
                .getElementById('menu-' + id)
                .classList
                .toggle('hidden');
        }

        // Close when clicking outside
        document.addEventListener('click', function(e) {

            if (!e.target.closest('td')) {
                document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }

        });

        document.getElementById('exportTemplateForm').addEventListener('submit', function() {
            document.getElementById('templateModal').classList.add('hidden');
        });
    </script>
@endsection
