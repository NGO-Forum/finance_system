@extends('layout.app')

@section('title', 'Purchase Requests')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-700 via-green-600 to-emerald-500 p-6 shadow-xl mb-4">

            {{-- Background Decoration --}}
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl">
            </div>

            <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-white/5 rounded-full blur-3xl">
            </div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                {{-- Left --}}
                <div class="flex items-start gap-4">

                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shadow-lg">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M7 4h10l2 2v14H5V6l2-2z" />

                        </svg>

                    </div>

                    <div>

                        <h1 class="text-3xl font-bold text-white">
                            Purchase Request Management
                        </h1>

                        <p class="mt-2 text-green-100 max-w-2xl">
                            Create, review, approve, and monitor all purchase requests in one place.
                            Manage procurement efficiently with a clear approval workflow.
                        </p>

                    </div>

                </div>

                {{-- Right --}}
                <div class="flex flex-wrap gap-3">

                    <a href="{{ route('purchase-requests.create') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-green-700 font-semibold shadow-lg transition hover:scale-105 hover:bg-green-50">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        New

                    </a>

                </div>

            </div>

        </div>

        {{-- Search & Filter --}}
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden mb-4">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 7v5l-4 2v-7L3 6V4z" />

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            Search & Filters
                        </h2>

                        <p class="text-sm text-slate-500">
                            Quickly find purchase requests using keywords and status.
                        </p>

                    </div>

                </div>

            </div>

            <form method="GET" action="{{ route('purchase-requests.index') }}">

                <div class="p-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

                        {{-- Search --}}
                        <div class="lg:col-span-10">

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Search
                            </label>

                            <div class="relative">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="absolute left-3 top-3.5 w-5 h-5 text-slate-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-5.2-5.2M10.8 18a7.2 7.2 0 100-14.4 7.2 7.2 0 000 14.4z" />

                                </svg>

                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Purchase No, Donor, Purpose..."
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-green-600 focus:border-green-600">

                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="lg:col-span-2 flex items-end gap-3">

                            <button type="submit"
                                class="flex-1 inline-flex justify-center items-center gap-2 rounded-xl bg-green-700 px-5 py-3 text-white font-semibold shadow hover:bg-green-800 transition">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-5.2-5.2M10.8 18a7.2 7.2 0 100-14.4 7.2 7.2 0 000 14.4z" />

                                </svg>

                                Search

                            </button>

                            <a href="{{ route('purchase-requests.index') }}"
                                class="inline-flex justify-center items-center gap-2 rounded-xl bg-slate-200 px-5 py-3 text-slate-700 font-semibold hover:bg-slate-300 transition">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h5M20 20v-5h-5M5.6 9A7 7 0 0117 6M18.4 15A7 7 0 017 18" />

                                </svg>

                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-5 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="mb-5 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-green-700 text-white">

                        <tr>

                            <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                                Purchase No
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                                Donor
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                                Date
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                                Purpose
                            </th>

                            <th class="px-4 py-3 text-right text-xs font-bold uppercase">
                                Total Request
                            </th>

                            <th class="px-4 py-3 text-center text-xs font-bold uppercase">
                                Prepared By
                            </th>

                            <th class="px-4 py-3 text-center text-xs font-bold uppercase">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">

                        @forelse($purchaseRequests as $purchase)
                            <tr class="hover:bg-slate-50">

                                <td class="px-4 py-2 font-semibold text-green-700">
                                    {{ $purchase->purchase_no }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $purchase->donor }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($purchase->request_date)->format('d M Y') }}
                                </td>

                                <td class="px-4 py-2 w-[500px] ">
                                    <span class="line-clamp-1">
                                        {{ $purchase->purpose }}
                                    </span>
                                </td>

                                <td class="px-4 py-2 text-right font-semibold">
                                    ${{ number_format($purchase->grand_total, 2) }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    {{ $purchase->preparer?->name }}
                                </td>

                                <td class="px-4 py-2 text-center">

                                    <div class="relative inline-block text-left">

                                        <button onclick="toggleActionMenu({{ $purchase->id }})"
                                            class="p-2 rounded-full hover:bg-slate-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-600"
                                                fill="currentColor" viewBox="0 0 24 24">

                                                <circle cx="12" cy="5" r="2" />
                                                <circle cx="12" cy="12" r="2" />
                                                <circle cx="12" cy="19" r="2" />

                                            </svg>

                                        </button>

                                        <div id="actionMenu{{ $purchase->id }}"
                                            class="hidden absolute right-0 -mt-3 w-12 bg-white border border-slate-200 rounded-xl shadow-xl z-50">

                                            <a href="{{ route('purchase-requests.pdf', $purchase) }}" target="_blank"
                                                class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50">

                                                <i class="fas fa-file-pdf"></i>

                                            </a>

                                            {{-- View --}}
                                            <a href="{{ route('purchase-requests.show', $purchase) }}"
                                                class="flex items-center gap-3 px-4 py-3 hover:bg-blue-100 transition">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('purchase-requests.edit', $purchase) }}"
                                                class="flex items-center gap-3 px-4 py-3 text-green-700 hover:bg-green-100 transition">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <button type="button"
                                                onclick="deletePurchase('{{ route('purchase-requests.destroy', $purchase) }}')"
                                                class="flex items-center gap-3 w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition">

                                                <i class="fas fa-trash"></i>
                                            </button>


                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="10" class="text-center py-12 text-slate-500">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 mx-auto mb-3 text-slate-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 12h6m-6 4h6M7 4h10l2 2v14H5V6l2-2z" />

                                    </svg>

                                    <p class="text-lg font-semibold">
                                        No Purchase Requests Found
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    <script>
        // Toggle Action Menu
        function toggleActionMenu(id) {
            // Close all other menus
            document.querySelectorAll('[id^="actionMenu"]').forEach(menu => {
                if (menu.id !== 'actionMenu' + id) {
                    menu.classList.add('hidden');
                }
            });

            // Toggle selected menu
            document.getElementById('actionMenu' + id).classList.toggle('hidden');
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                document.querySelectorAll('[id^="actionMenu"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });

        // SweetAlert Delete Confirmation
        function deletePurchase(url) {
            Swal.fire({
                title: 'Delete Purchase Request?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    // CSRF Token
                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';

                    // DELETE Method
                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';

                    form.appendChild(csrf);
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
