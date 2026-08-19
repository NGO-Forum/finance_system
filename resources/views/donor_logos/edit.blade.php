@extends('layout.app')

@section('title', 'Edit Donor')

@section('content')

    <div class="container mx-auto max-w-4xl">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

            <!-- Card Header -->
            <div class="bg-gradient-to-r from-green-500 to-green-500 px-6 py-5">

                <h2 class="text-xl font-semibold text-white">
                    Donor Information
                </h2>

                <p class="text-green-100 text-sm mt-1">
                    Update the donor details below.
                </p>

            </div>

            <form action="{{ route('donor-logos.update', $donorLogo) }}" method="POST" enctype="multipart/form-data"
                class="p-8">

                @csrf
                @method('PUT')

                <!-- Donor Name -->
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Donor Name <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="name" value="{{ old('name', $donorLogo->name) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500">

                    @error('name')
                        <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Current Logo -->
                @if ($donorLogo->logo)
                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Current Logo
                        </label>

                        <div class="w-36 h-36 rounded-2xl border bg-white shadow flex items-center justify-center p-4">

                            <img src="{{ asset('storage/' . $donorLogo->logo) }}"
                                class="max-w-full max-h-full object-contain">

                        </div>

                    </div>
                @endif

                <!-- Upload New Logo -->
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Replace Logo
                    </label>

                    <input type="file" name="logo"
                        class="block w-full rounded-xl border border-gray-300
                    file:mr-4
                    file:rounded-lg
                    file:border-0
                    file:bg-green-500
                    file:px-4
                    file:py-2
                    file:text-white
                    hover:file:bg-green-600">

                    <p class="mt-2 text-sm text-gray-500">
                        Leave blank if you don't want to change the logo.
                    </p>

                    @error('logo')
                        <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3">

                    <a href="{{ route('donor-logos.index') }}"
                        class="px-6 py-3 rounded-xl border border-gray-300 bg-amber-300 hover:bg-amber-500 text-white">

                        Cancel

                    </a>

                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-green-500 hover:bg-green-600 text-white shadow-lg">

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
