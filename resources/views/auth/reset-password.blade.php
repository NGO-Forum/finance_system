<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gradient-to-r from-green-100 to-green-200 min-h-screen flex items-center justify-center px-4 py-10">

    <div class="bg-white shadow-2xl rounded-3xl p-8 sm:p-10 w-full max-w-xl">

        <!-- Logo -->
        <div class="text-center mb-8">

            <img src="{{ asset('images/logo.png') }}" alt="NGO Forum" class="mx-auto h-32">

            <h1 class="text-3xl font-bold text-green-600 mt-6">
                Reset Password
            </h1>

            <p class="mt-3 text-gray-500">
                Create a new secure password for your account.
            </p>

        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="mb-5">

                <label class="block text-lg font-semibold text-gray-700 mb-2">
                    Email Address
                </label>

                <input type="email" name="email" value="{{ old('email', $request->email) }}" readonly
                    class="w-full px-5 py-3 border border-gray-300 bg-gray-100 rounded-xl">

                @error('email')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <!-- Password -->
            <div class="mb-5">

                <label class="block text-lg font-semibold text-gray-700 mb-2">
                    New Password
                </label>

                <input type="password" name="password" placeholder="Enter new password" required
                    class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none">

                @error('password')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <!-- Confirm Password -->
            <div class="mb-8">

                <label class="block text-lg font-semibold text-gray-700 mb-2">
                    Confirm Password
                </label>

                <input type="password" name="password_confirmation" placeholder="Confirm new password" required
                    class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none">

            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl text-lg font-semibold shadow-md transition">
                Reset Password
            </button>

        </form>

    </div>

</body>

</html>
