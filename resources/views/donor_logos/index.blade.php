@extends('layout.app')

@section('content')
    <div class="container mx-auto">

        <div class="mb-6">
            <div
                class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 rounded-2xl bg-gradient-to-r from-emerald-600 to-green-700 p-6 shadow-lg">

                <!-- Left -->
                <div class="flex items-center gap-5">

                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/20 backdrop-blur">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5V4H2v16h5m10 0v-5a3 3 0 00-6 0v5m6 0H11" />

                        </svg>

                    </div>

                    <div>

                        <h1 class="text-3xl font-bold text-white">
                            Donor Management
                        </h1>

                        <p class="mt-2 text-emerald-100">
                            Manage donor information, logos, and descriptions for your organization.
                        </p>

                    </div>

                </div>

                <!-- Right -->
                <div>

                    <a href="{{ route('donor-logos.create') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 font-semibold text-emerald-700 shadow-md transition duration-200 hover:-translate-y-0.5 hover:bg-emerald-50">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        Add Donor

                    </a>

                </div>

            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4">

                <div class="flex items-center gap-3">

                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

                    </svg>

                    <span class="text-green-700 font-medium">
                        {{ session('success') }}
                    </span>

                </div>

            </div>
        @endif

        <div class="overflow-auto h-[60vh]">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3">

                @forelse($logos as $logo)
                    <div
                        class="bg-white rounded-2xl border border-gray-200 shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">

                        {{-- Logo --}}
                        <div class="h-52 bg-gray-50 flex items-center justify-center border-b">
                            @if ($logo->logo)
                                <img src="{{ asset('storage/' . $logo->logo) }}" alt="{{ $logo->name }}"
                                    class="max-h-36 max-w-36 object-contain">
                            @else
                                <div
                                    class="w-24 h-24 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400">
                                    No Image
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-5">

                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-600 text-white text-sm font-bold">
                                    {{ $loop->iteration }}
                                </span>

                                <span class="text-xs text-gray-500 bg-orange-100 px-3 py-1 rounded-full">
                                    {{ $logo->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-800 truncate mb-5">
                                {{ $logo->name }}
                            </h3>

                            <div class="flex justify-end gap-3">

                                <a href="{{ route('donor-logos.edit', $logo) }}"
                                    class="w-10 h-10 rounded-xl bg-green-100 text-green-600 hover:bg-green-600 hover:text-white flex items-center justify-center transition"
                                    title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form id="delete-form-{{ $logo->id }}"
                                    action="{{ route('donor-logos.destroy', $logo) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        onclick="confirmDelete({{ $logo->id }}, '{{ $logo->name }}')"
                                        class="w-10 h-10 rounded-xl bg-red-100 text-red-600 hover:bg-red-600 hover:text-white flex items-center justify-center transition"
                                        title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full">

                        <div class="bg-white rounded-2xl border border-dashed border-gray-300 shadow py-20 text-center">

                            <div class="text-7xl mb-4">🖼️</div>

                            <h2 class="text-2xl font-bold text-gray-700">
                                No Donor Logos Found
                            </h2>

                            <p class="text-gray-500 mt-2">
                                Click <strong>Add Donor Logo</strong> to create your first donor logo.
                            </p>

                        </div>

                    </div>
                @endforelse

            </div>
        </div>

    </div>

    <script>
        function confirmDelete(id, name) {

            Swal.fire({
                title: 'Delete Donor?',
                text: `Are you sure you want to delete "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-trash"></i> Yes, Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {

                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }

            });

        }
    </script>
@endsection
