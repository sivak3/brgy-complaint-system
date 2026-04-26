<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-800 to-blue-600 flex items-center justify-center px-4">
        <div class="w-full max-w-md">

            <!-- Header -->
            <div class="text-center mb-8">
                <span class="text-6xl">🏛️</span>
                <h1 class="text-white text-2xl font-bold mt-3">Barangay Management System</h1>
                <p class="text-blue-200 text-sm mt-1">Complaint & Feedback Portal</p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-1">Welcome Back!</h2>
                <p class="text-gray-500 text-sm mb-6">Log in to your resident account</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter your email" required autofocus>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter your password" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center gap-2 text-sm text-gray-600">
                            <input type="checkbox" name="remember" class="rounded">
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-sm text-blue-600 hover:underline">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition">
                        Log In
                    </button>

                    <p class="text-center text-sm text-gray-500 mt-4">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">
                            Register here
                        </a>
                    </p>
                </form>
            </div>

            <p class="text-center text-blue-200 text-xs mt-6">
                © 2026 Barangay Complaint & Feedback Management System
            </p>
        </div>
    </div>
</x-guest-layout>