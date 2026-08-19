@extends('layout.app')

@section('content')
    <div class="max-w-4xl mx-auto">

        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-8 shadow-xl mb-6">

            <div class="flex items-center justify-between">

                <div>
                    <h1 class="text-3xl font-bold text-white">
                        Create Role
                    </h1>

                    <p class="text-green-100 mt-2">
                        Add a new role to your organization
                    </p>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-xl p-8">

            <form action="{{ route('roles.store') }}" method="POST">

                @csrf

                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Role Name
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                </div>

                <div class="mb-8">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea name="description" rows="5" class="w-full border border-gray-300 rounded-xl px-4 py-3">{{ old('description') }}</textarea>

                </div>

                <div class="flex items-center gap-3">

                    <a href="{{ route('roles.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border bg-orange-200 text-white hover:bg-orange-400 transition">

                        Cancel

                    </a>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

                        Save
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
