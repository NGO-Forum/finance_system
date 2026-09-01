@extends('layout.app')

@section('content')
    <div class="space-y-4">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-8 shadow-xl">

            <div class="flex flex-col md:flex-row justify-between items-center gap-4">

                <div>

                    <h1 class="text-4xl font-bold text-white">
                        Concept Note Management
                    </h1>

                    <p class="text-green-100 mt-2">
                        Manage all Concept Note
                    </p>

                </div>

                <div class="flex justify-between gap-6">

                    <a href="{{ route('fund-requests.template.word') }}"
                        class="bg-red-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition">
                        Word Template
                    </a>

                    <a href="{{ route('fund-requests.create') }}"
                        class="bg-white text-green-600 px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition">

                        + New Concept Note

                    </a>

                </div>

            </div>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-xl">

                {{ session('success') }}

            </div>
        @endif

        {{-- Search --}}
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <form method="GET">

                <div class="flex gap-3">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search Concept Note..."
                        class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700">

                        Search

                    </button>

                </div>

            </form>

        </div>

        {{-- Table --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="px-6 py-5 bg-green-600">

                <h2 class="text-xl font-semibold text-white">
                    Fund Requests
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gradient-to-r from-green-50 to-emerald-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Title
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Department
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Requested By
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Date Request
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Budget
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Reviewer
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($fundRequests as $index => $fundRequest)
                            <tr class="hover:bg-green-100 transition duration-200">

                                {{-- Title --}}
                                <td class="px-6 py-2">

                                    <div class="max-w-md">

                                        <h4 class="font-semibold text-gray-800 truncate">
                                            {{ $fundRequest->title }}
                                        </h4>

                                    </div>

                                </td>

                                {{-- Department --}}
                                <td class="px-6 py-2">
                                    <span class="text-gray-700">
                                        {{ $fundRequest->department?->name ?? '-' }}
                                    </span>
                                </td>

                                {{-- Requester --}}
                                <td class="px-6 py-2">
                                    <div class="flex items-center gap-2">

                                        <span class="text-gray-700">
                                            {{ $fundRequest->user?->name ?? '-' }}
                                        </span>

                                    </div>
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-2 text-center text-gray-600 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($fundRequest->request_date)->format('d M Y') }}
                                </td>

                                {{-- Budget --}}
                                <td class="px-6 py-2 text-center">

                                    <span class="font-bold text-green-700">
                                        ${{ number_format($fundRequest->total_budget, 2) }}
                                    </span>

                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-2 text-center">

                                    @if ($fundRequest->status == 'Approved')
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                            Approved
                                        </span>
                                    @elseif($fundRequest->status == 'Rejected')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                            Rejected
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                            Pending
                                        </span>
                                    @endif

                                </td>

                                {{-- Reviewer --}}
                                <td class="px-6 py-2 text-center text-gray-600">
                                    {{ $fundRequest->reviewer?->name ?? '-' }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-2 text-center">

                                    <div class="relative inline-block">

                                        <button type="button" onclick="toggleMenu({{ $fundRequest->id }})"
                                            class="p-2 rounded-lg hover:bg-gray-100">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600"
                                                fill="currentColor" viewBox="0 0 20 20">

                                                <path
                                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />

                                            </svg>

                                        </button>

                                        <div id="menu-{{ $fundRequest->id }}"
                                            class="hidden absolute right-0 -mt-3 w-12 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-50">

                                            {{-- @if ($fundRequest->status === 'Approved') --}}
                                            <a href="{{ route('fund-requests.pdf', $fundRequest) }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50">

                                                <i class="fas fa-file-pdf"></i>

                                            </a>
                                            {{-- @endif --}}


                                            <a href="{{ route('fund-requests.show', $fundRequest) }}"
                                                class="flex items-center px-4 py-3 text-sm text-blue-700 hover:bg-blue-50">
                                                <i class="fas fa-eye"></i>
                                            </a>



                                            <a href="{{ route('fund-requests.edit', $fundRequest) }}"
                                                class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-blue-50">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            @if ($fundRequest->status !== 'Approved')
                                                <form id="delete-form-{{ $fundRequest->id }}"
                                                    action="{{ route('fund-requests.destroy', $fundRequest) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button" onclick="confirmDelete({{ $fundRequest->id }})"
                                                        class="w-full flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>
                                            @endif

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="py-20 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center text-4xl mb-4">
                                            💰
                                        </div>

                                        <h3 class="text-lg font-semibold text-gray-700">
                                            No Fund Requests Found
                                        </h3>

                                        <p class="text-gray-500 mt-1">
                                            Create your first fund request to get started.
                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t bg-gray-50 flex justify-between items-center">

                <p class="text-sm text-gray-600">

                    Showing
                    {{ $fundRequests->firstItem() ?? 0 }}
                    -
                    {{ $fundRequests->lastItem() ?? 0 }}

                    of

                    {{ $fundRequests->total() }}

                </p>

                {{ $fundRequests->links() }}

            </div>

        </div>

    </div>

    <script>
        function toggleMenu(id) {

            document.querySelectorAll('[id^="menu-"]').forEach(menu => {

                if (menu.id !== `menu-${id}`) {
                    menu.classList.add('hidden');
                }

            });

            document
                .getElementById(`menu-${id}`)
                .classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {

            if (!e.target.closest('.relative')) {

                document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                    menu.classList.add('hidden');
                });

            }

        });

        function confirmDelete(id) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to recover this record.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById(
                        'delete-form-' + id
                    ).submit();
                }
            });
        }
    </script>
@endsection
