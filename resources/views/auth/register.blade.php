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
                <h2 class="text-2xl font-bold text-gray-800 mb-1">Create Account</h2>
                <p class="text-gray-500 text-sm mb-6">Register as a barangay resident</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter your full name" required autofocus>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter your email" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Create a password" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Confirm your password" required>
                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition">
                        Create Account
                    </button>

                    <p class="text-center text-sm text-gray-500 mt-4">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                            Log in here
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