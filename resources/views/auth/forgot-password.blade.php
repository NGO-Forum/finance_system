<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-r from-green-100 to-green-200 flex items-center justify-center min-h-screen px-4">

    <div
        class="bg-white shadow-2xl rounded-3xl p-8 sm:p-10 w-full max-w-md transform transition duration-500 hover:scale-105">

        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="NGO Forum" class="mx-auto h-32">

            <h1 class="text-2xl font-bold text-green-600 tracking-wide mt-4">
                Forgot Your Password
            </h1>

            <p class="mt-3 text-gray-500 text-base">
                Enter your organization email address
            </p>
        </div>

        @if (session('status'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700">
                {{ session('status') }} </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-6">
                <label class="block text-lg font-semibold text-gray-700 mb-2">
                    Email Address
                </label>

                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">

                @error('email')
                    <p class="text-red-500 text-sm mt-2"> {{ $message }} </p>
                @enderror
            </div>


            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold text-base transition-all duration-300 shadow-md hover:shadow-lg">
                Send Password Reset
            </button>

            <div class="mt-4 text-center">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                    <span class="mr-2">←</span>
                    Back to Login
                </a>
            </div>

        </form>

    </div>

</body>

</html>
