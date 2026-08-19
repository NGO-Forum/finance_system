@extends('layout.app')

@section('content')
    <div class="space-y-4">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-8 shadow-xl">

            <div class="flex flex-col md:flex-row justify-between items-center gap-4">

                <div>
                    <h1 class="text-4xl font-bold text-white">
                        Department Management
                    </h1>

                    <p class="text-green-100 mt-2">
                        Manage departments and organizational structure
                    </p>
                </div>

                <a href="{{ route('departments.create') }}"
                    class="inline-flex items-center gap-2 bg-white text-green-600 px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                    </svg>

                    Add Department

                </a>

            </div>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Search --}}
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <form method="GET">

                <div class="flex flex-col md:flex-row gap-3">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search department..."
                        class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl transition">

                        Search

                    </button>

                </div>

            </form>

        </div>

        {{-- Table --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="px-6 py-5 border-b bg-green-600">

                <h2 class="text-xl font-semibold text-white">
                    Departments Directory
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-green-100">

                        <tr>

                            <th class="px-6 py-4 text-left text-sm font-bold uppercase text-gray-500">
                                Department
                            </th>

                            <th class="px-4 py-4 text-left text-sm font-bold uppercase text-gray-500">
                                Description
                            </th>

                            <th class="px-4 py-4 text-center text-sm font-bold uppercase text-gray-500">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($departments as $department)
                            <tr class="border-b hover:bg-green-50 transition">

                                <td class="px-6 py-3">

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="w-12 h-12 rounded-full bg-gradient-to-r from-green-500 to-emerald-600 text-white flex items-center justify-center font-bold shadow">

                                            {{ strtoupper(substr($department->name, 0, 1)) }}

                                        </div>

                                        <div>

                                            <div class="font-semibold text-gray-800">
                                                {{ $department->name }}
                                            </div>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-4 py-3 w-[950px] text-gray-600">
                                    {{ $department->description ?? '-' }}
                                </td>

                                <td class="px-4 py-3">

                                    <div class="flex justify-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('departments.edit', $department) }}"
                                            class="w-8 h-8 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600 hover:bg-blue-200 transition"
                                            title="Edit">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 8.586-8.586z" />

                                            </svg>

                                        </a>

                                        {{-- Delete --}}
                                        {{-- <form id="delete-form-{{ $department->id }}"
                                            action="{{ route('departments.destroy', $department) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="button" onclick="confirmDelete({{ $department->id }})"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition"
                                                title="Delete">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />

                                                </svg>

                                            </button>

                                        </form> --}}

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="py-16 text-center">

                                    <div class="text-6xl mb-4">
                                        🏢
                                    </div>

                                    <h3 class="text-lg font-semibold text-gray-700">
                                        No Departments Found
                                    </h3>

                                    <p class="text-gray-500 mt-2">
                                        There are currently no departments available.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 px-6 py-4 border-t bg-gray-50">

                <p class="text-sm text-gray-600">
                    Showing {{ $departments->firstItem() ?? 0 }}
                    to {{ $departments->lastItem() ?? 0 }}
                    of {{ $departments->total() }} departments
                </p>

                {{ $departments->links() }}

            </div>

        </div>

    </div>

    <script>
        function confirmDelete(id) {

            Swal.fire({
                title: 'Delete Department?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }

            });

        }
    </script>
@endsection
