@extends('layout.app')

@section('content')
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-8 shadow-xl mb-6">

            <div class="flex items-center justify-between">

                <div>

                    <h1 class="text-3xl font-bold text-white">
                        Edit Department
                    </h1>

                    <p class="text-green-100 mt-2">
                        Update department information and description
                    </p>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 8.586-8.586z" />

                    </svg>

                </div>

            </div>

        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-xl p-8">

            <form action="{{ route('departments.update', $department) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- Department Name --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Department Name
                    </label>

                    <input type="text" name="name" value="{{ old('name', $department->name) }}"
                        placeholder="Enter department name"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none">

                    @error('name')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Description --}}
                <div class="mb-8">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea name="description" rows="5" placeholder="Enter department description"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none">{{ old('description', $department->description) }}</textarea>

                    @error('description')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-3">

                    <a href="{{ route('departments.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition font-medium">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                        </svg>

                        Cancel

                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl transition font-medium shadow-sm hover:shadow-lg">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

                        </svg>

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
