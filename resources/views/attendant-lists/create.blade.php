@extends('layout.app')

@section('content')

    <div class="max-w-full mx-auto">

        {{-- Header --}}
        <div class="mb-6 rounded-3xl bg-gradient-to-r from-emerald-700 to-green-600 p-8 shadow-xl">

            <div class="flex items-center justify-between">

                <div>

                    <h1 class="text-3xl font-bold text-white">
                        Create Attendance List
                    </h1>

                    <p class="mt-2 text-emerald-100">
                        Create a new activity for attendance, online registration, PDF and Excel export.
                    </p>

                </div>

                <a href="{{ route('attendant-lists.index') }}"
                    class="rounded-xl bg-white px-5 py-3 font-semibold text-green-700 shadow hover:bg-green-50">

                    ← Back

                </a>

            </div>

        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5">

                <ul class="list-disc list-inside text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <form action="{{ route('attendant-lists.store') }}" method="POST">

            @csrf

            <div class="rounded-3xl bg-white shadow-lg">

                <div class="border-b px-8 py-5">

                    <h2 class="text-xl text-green-700 font-semibold">

                        Activity Information

                    </h2>

                </div>

                <div class=" p-8">

                    <div class="grid grid-cols-1 gap-6">

                        {{-- Title --}}
                        <div>

                            <label class="mb-2 block font-semibold">

                                Activity Title <span class="text-red-500">*</span>

                            </label>

                            <input type="text" name="title" value="{{ old('title') }}"
                                class="w-full rounded-xl border-gray-300 focus:border-green-600 focus:ring-green-600">

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-6 gap-5">

                            {{-- Activity Date --}}
                            <div>

                                <label class="mb-2 block font-semibold">

                                    Activity Date

                                </label>

                                <input type="date" name="activity_date" value="{{ old('activity_date') }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-green-600 focus:ring-green-600">

                            </div>

                            {{-- Start Time --}}
                            <div>

                                <label class="mb-2 block font-semibold text-gray-700">
                                    Start Time
                                    <span class="text-red-500">*</span>
                                </label>

                                <input type="time" name="start_time" value="{{ old('start_time') }}" required
                                    class="w-full rounded-xl border-gray-300
                                   focus:border-green-600
                                   focus:ring-green-600">

                                @error('start_time')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- End Time --}}
                            <div>

                                <label class="mb-2 block font-semibold text-gray-700">
                                    End Time
                                    <span class="text-red-500">*</span>
                                </label>

                                <input type="time" name="end_time" value="{{ old('end_time') }}" required
                                    class="w-full rounded-xl border-gray-300
                                   focus:border-green-600
                                   focus:ring-green-600">

                                @error('end_time')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- Venue --}}
                            <div class="col-span-2">

                                <label class="mb-2 block font-semibold">

                                    Venue

                                </label>

                                <input type="text" name="venue" value="{{ old('venue') }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-green-600 focus:ring-green-600">

                            </div>

                            <div>

                                <label class="mb-2 block font-semibold">

                                    Maximum Participants

                                </label>

                                <input type="number" name="max_participants" value="{{ old('max_participants') }}"
                                    min="1"
                                    class="w-full rounded-xl border-gray-300 focus:border-green-600 focus:ring-green-600">

                            </div>

                        </div>


                    </div>

                    {{-- Donor Logos --}}
                    <div class="mt-6">

                        <label class="mb-4 block font-semibold">

                            Donor Logos

                        </label>

                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-9 gap-4">

                            @foreach ($donorLogos as $logo)
                                <label
                                    class="cursor-pointer rounded-2xl border p-4 hover:border-green-600 hover:bg-green-50">

                                    <input type="checkbox" name="donor_logo_ids[]" value="{{ $logo->id }}"
                                        class="mb-3 rounded border-gray-300 text-green-600">

                                    <img src="{{ asset('storage/' . $logo->logo) }}" class="mx-auto h-16 object-contain">

                                    <div class="mt-3 text-center text-sm font-medium">

                                        {{ $logo->name }}

                                    </div>

                                </label>
                            @endforeach

                        </div>

                    </div>

                    {{-- Registration --}}
                    <div class="mt-6">

                        <div class="flex items-end">

                            <label class="flex items-center gap-3">

                                <input type="checkbox" name="registration_enabled" value="1"
                                    {{ old('registration_enabled') ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-green-600">

                                <span class="font-semibold text-green-700">

                                    Enable Online Registration

                                </span>

                            </label>

                        </div>

                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex justify-end gap-4 rounded-2xl bg-gray-50 px-8 py-5">

                    <a href="{{ route('attendant-lists.index') }}"
                        class="rounded-xl border px-6 py-3 font-semibold text-white bg-orange-400 hover:bg-orange-600">

                        Cancel

                    </a>

                    <button type="submit"
                        class="rounded-xl bg-green-600 px-8 py-3 font-semibold text-white hover:bg-green-700">

                        Save

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection
