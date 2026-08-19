@extends('layout.app')

@section('content')
    <div class="container mx-auto max-w-4xl">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

            <!-- Card Header -->
            <div class="bg-gradient-to-r from-emerald-600 to-green-700 px-6 py-5">

                <h2 class="text-xl font-semibold text-white">
                    Donor Information
                </h2>

                <p class="text-emerald-100 text-sm mt-1">
                    Fields marked with <span class="text-red-200">*</span> are required.
                </p>

            </div>

            <!-- Form -->
            <form action="{{ route('donor-logos.store') }}" method="POST" enctype="multipart/form-data" class="p-8">

                @csrf

                <!-- Donor Name -->
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Donor Name <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter donor name"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                </div>


                <!-- Logo -->
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Donor Logo
                    </label>

                    <input type="file" name="logo"
                        class="block w-full rounded-xl border border-gray-300
                           file:mr-4
                           file:rounded-lg
                           file:border-0
                           file:bg-emerald-600
                           file:px-4
                           file:py-2
                           file:text-white
                           hover:file:bg-emerald-700">

                    <p class="mt-2 text-sm text-gray-500">
                        Supported formats: JPG, PNG, SVG, WEBP (Max: 2MB)
                    </p>

                    @error('logo')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3">

                    <a href="{{ route('donor-logos.index') }}"
                        class="rounded-xl border border-gray-300 bg-orange-300 px-6 py-3 font-medium text-white hover:bg-orange-400">

                        Cancel

                    </a>

                    <button type="submit"
                        class="rounded-xl bg-emerald-600 px-6 py-3 font-medium text-white shadow hover:bg-emerald-700">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
