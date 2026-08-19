@extends('layout.app')

@section('content')
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-8 shadow-xl mb-6">

            <div class="flex items-center justify-between">

                <div>

                    <h1 class="text-3xl font-bold text-white">
                        Edit Role
                    </h1>

                    <p class="text-green-100 mt-2">
                        Update role information and description
                    </p>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-4-4H11a4 4 0 00-4 4v2m10 0H7m10-9a4 4 0 11-8 0 4 4 0 018 0z" />

                    </svg>

                </div>

            </div>

        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-xl p-8">

            <form action="{{ route('roles.update', $role) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- Role Name --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Role Name
                    </label>

                    <input type="text" name="name" value="{{ old('name', $role->name) }}"
                        placeholder="Enter role name"
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

                    <textarea name="description" rows="5" placeholder="Enter role description"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none">{{ old('description', $role->description) }}</textarea>

                    @error('description')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-3">

                    <a href="{{ route('roles.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border bg-orange-200 text-white hover:bg-orange-400 transition font-medium">

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
