@extends('layout.app')

@section('content')
    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-8 shadow-xl mb-6">

            <h1 class="text-3xl font-bold text-white">
                Create User
            </h1>

            <p class="text-green-100 mt-2">
                Add a new user to the Finance Management System
            </p>

        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

            <form action="{{ route('users.store') }}" method="POST">

                @csrf

                <div class="grid md:grid-cols-2 gap-6">

                    <!-- Name -->
                    <div>

                        <label class="block mb-2 font-medium text-gray-700">
                            Full Name <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter full name"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Email -->
                    <div>

                        <label class="block mb-2 font-medium text-gray-700">
                            Email Address <span class="text-red-500">*</span>
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="example@ngoforum.org.kh"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                        @error('email')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Position -->
                    <div>

                        <label class="block mb-2 font-medium text-gray-700">
                            Position
                        </label>

                        <input type="text" name="position" value="{{ old('position') }}" placeholder="Finance Officer"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                    </div>

                    <!-- Phone -->
                    <div>

                        <label class="block mb-2 font-medium text-gray-700">
                            Phone Number
                        </label>

                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="012345678"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                    </div>

                    <!-- Department -->
                    <div>

                        <label class="block mb-2 font-medium text-gray-700">
                            Department <span class="text-red-500">*</span>
                        </label>

                        <select name="department_id"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                            <option value="">
                                Select Department
                            </option>

                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}>

                                    {{ $department->name }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    <!-- Role -->
                    <div>

                        <label class="block mb-2 font-medium text-gray-700">
                            Role <span class="text-red-500">*</span>
                        </label>

                        <select name="role_id"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                            <option value="">
                                Select Role
                            </option>

                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>

                                    {{ $role->name }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    <!-- Password -->
                    <div class="md:col-span-2">

                        <label class="block mb-2 font-medium text-gray-700">
                            Password <span class="text-red-500">*</span>
                        </label>

                        <input type="password" name="password" placeholder="Enter password"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                        @error('password')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 mt-8">

                    <a href="{{ route('users.index') }}"
                        class="px-6 py-3 bg-orange-200 hover:bg-orange-400 text-white rounded-xl transition">

                        Cancel

                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl transition">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
