<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance System Login</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-r from-green-100 to-green-200 flex items-center justify-center min-h-screen px-4">

    <div
        class="bg-white shadow-2xl rounded-3xl p-6 w-full max-w-md transform transition duration-500 hover:scale-105 h-[90vh] overflow-auto">

        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="NGO Forum" class="mx-auto h-28">

            <h1 class="text-xl font-bold text-green-600 tracking-wide mt-4">
                Finance Management System
            </h1>

            <p class="mt-3 text-gray-500 text-base">
                Please login to your account
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-base font-semibold text-gray-700 mb-2">
                    Email Address
                </label>

                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">

                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-base font-semibold text-gray-700 mb-2">
                    Password
                </label>

                <input type="password" name="password" placeholder="Enter password"
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">

                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between mb-5">

                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded-md text-green-600">

                    <span class="ml-3 text-base text-gray-700">
                        Remember me
                    </span>
                </label>

                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline text-base">
                    Forgot password?
                </a>

            </div>

            <!-- Login Button -->
            <div class="flex justify-center">
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white text-xl font-semibold py-2 rounded-lg transition">
                    Login
                </button>
            </div>

            <!-- Divider -->
            <div class="flex items-center my-4">
                <div class="flex-1 border-t border-gray-300"></div>

                <span class="px-4 text-gray-500 text-sm">
                    OR
                </span>

                <div class="flex-1 border-t border-gray-300"></div>
            </div>

            <!-- Microsoft Login -->
            <a href="{{ route('auth.microsoft') }}"
                class="w-full flex items-center justify-center gap-3 border border-gray-300 bg-white hover:bg-gray-50 rounded-lg py-3 px-4 transition">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" class="w-6 h-6">

                    <path fill="#F25022" d="M1 1h10v10H1z" />
                    <path fill="#00A4EF" d="M12 1h10v10H12z" />
                    <path fill="#7FBA00" d="M1 12h10v10H1z" />
                    <path fill="#FFB900" d="M12 12h10v10H12z" />

                </svg>

                <span class="font-semibold text-gray-700">
                    Continue with Microsoft
                </span>

            </a>

        </form>

    </div>

</body>

</html>
