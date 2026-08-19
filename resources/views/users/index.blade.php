@extends('layout.app')

@section('content')
    <div class="space-y-4">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 rounded-3xl p-8 shadow-xl">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>
                    <h1 class="text-4xl font-bold text-white">
                        User Management
                    </h1>

                    <p class="text-green-100 mt-2">
                        Manage users, departments, permissions and system access
                    </p>
                </div>

                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center gap-2 bg-white text-green-700 px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                    </svg>

                    Add User

                </a>

            </div>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-2xl px-6 py-4 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-gray-500 text-sm">
                            Total Users
                        </p>

                        <h3 class="text-4xl font-bold text-gray-800 mt-2">
                            {{ \App\Models\User::count() }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
                        👥
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-gray-500 text-sm">
                            Active Users
                        </p>

                        <h3 class="text-4xl font-bold text-green-600 mt-2">
                            {{ \App\Models\User::where('is_active', true)->count() }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
                        ✅
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-gray-500 text-sm">
                            Departments
                        </p>

                        <h3 class="text-4xl font-bold text-indigo-600 mt-2">
                            {{ \App\Models\Department::count() }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center text-2xl">
                        🏢
                    </div>

                </div>

            </div>

        </div>

        {{-- Search --}}
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <form method="GET">

                <div class="flex flex-col md:flex-row gap-4">

                    <div class="relative flex-1">

                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 w-5 h-5 text-gray-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />

                        </svg>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by name, email, phone or position..."
                            class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none">

                    </div>

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl font-medium transition">

                        Search

                    </button>

                </div>

            </form>

        </div>

        {{-- User Table --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="px-6 py-5 border-b bg-green-600">

                <h2 class="text-xl font-semibold text-white">
                    Users Directory
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-green-50">

                        <tr>

                            <th class="px-6 py-4 text-left text- font-bold uppercase text-gray-500">
                                User
                            </th>

                            <th class="px-4 py-4 text-left text- font-bold uppercase text-gray-500">
                                Position
                            </th>

                            <th class="px-4 py-4 text-left text- font-bold uppercase text-gray-500">
                                Department
                            </th>

                            <th class="px-4 py-4 text-left text- font-bold uppercase text-gray-500">
                                Role
                            </th>

                            <th class="px-4 py-4 text-left text- font-bold uppercase text-gray-500">
                                Phone
                            </th>

                            <th class="px-4 py-4 text-center text-sm font-bold uppercase text-gray-500">
                                Status
                            </th>

                            <th class="px-4 py-4 text-center text- font-bold uppercase text-gray-500">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)
                            <tr class="border-b hover:bg-green-100 transition">

                                <td class="px-6 py-3">

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="h-12 w-12 rounded-full bg-gradient-to-r from-green-500 to-emerald-600 flex items-center justify-center text-white font-bold shadow">

                                            {{ strtoupper(substr($user->name, 0, 1)) }}

                                        </div>

                                        <div>

                                            <div class="font-semibold text-gray-800">
                                                {{ $user->name }}
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{ $user->email }}
                                            </div>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-4 py-3 text-left">{{ $user->position ?? '-' }}</td>

                                <td class="px-4 py-3 text-left">{{ $user->department?->name ?? '-' }}</td>

                                <td class="px-4 py-3 text-left">{{ $user->role?->name ?? '-' }}</td>

                                <td class="px-4 py-3 text-left">{{ $user->phone ?? '-' }}</td>

                                <td class="px-4 py-3 text-center">

                                    @if ($user->is_active)
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>

                                            Active

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>

                                            Inactive

                                        </span>
                                    @endif

                                </td>

                                <td>

                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('users.edit', $user) }}"
                                            class="w-8 h-8 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600 hover:bg-blue-200 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 8.586-8.586z" />

                                            </svg>

                                        </a>

                                        @if ($user->role?->name !== 'Admin')
                                            <form id="delete-form-{{ $user->id }}"
                                                action="{{ route('users.destroy', $user) }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button" onclick="confirmDelete({{ $user->id }})"
                                                    class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />

                                                    </svg>

                                                </button>

                                            </form>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="py-16 text-center">

                                    <div class="text-6xl mb-4">
                                        👥
                                    </div>

                                    <h3 class="text-lg font-semibold text-gray-700">
                                        No Users Found
                                    </h3>

                                    <p class="text-gray-500 mt-2">
                                        There are currently no users available.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination Footer --}}
            @if ($users->count())
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 px-6 py-4 border-t bg-gray-50">

                    <p class="text-sm text-gray-600">
                        Showing
                        <span class="font-semibold">{{ $users->firstItem() }}</span>
                        to
                        <span class="font-semibold">{{ $users->lastItem() }}</span>
                        of
                        <span class="font-semibold">{{ $users->total() }}</span>
                        users
                    </p>

                    <div>
                        {{ $users->links() }}
                    </div>

                </div>
            @endif

        </div>

    </div>

    <script>
        function confirmDelete(id) {

            Swal.fire({
                title: 'Delete User?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
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
