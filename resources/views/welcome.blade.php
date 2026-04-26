<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Complaint & Feedback System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <nav class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold">🏛️ Barangay Complaint & Feedback System</h1>
        </div>
        <div class="flex gap-3">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="bg-white text-blue-700 px-4 py-2 rounded font-semibold hover:bg-gray-100">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="bg-white text-blue-700 px-4 py-2 rounded font-semibold hover:bg-gray-100">
                    Log In
                </a>
                <a href="{{ route('register') }}"
                   class="bg-yellow-400 text-blue-900 px-4 py-2 rounded font-semibold hover:bg-yellow-300">
                    Register
                </a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-blue-700 text-white py-16 px-6 text-center">
        <h2 class="text-4xl font-bold mb-4">Welcome to the Barangay Portal</h2>
        <p class="text-lg mb-8 text-blue-100">
            Submit complaints, give feedback, and communicate directly with your barangay officials.
        </p>
        @guest
            <a href="{{ route('register') }}"
               class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-lg font-bold text-lg hover:bg-yellow-300">
                Get Started
            </a>
        @endguest
    </div>

    <!-- Features -->
    <div class="max-w-6xl mx-auto px-6 py-16">
        <h3 class="text-2xl font-bold text-center text-gray-800 mb-10">What You Can Do</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-5xl mb-4">📋</p>
                <h4 class="text-xl font-bold text-gray-800 mb-2">File a Complaint</h4>
                <p class="text-gray-600">
                    Report issues in your barangay such as noise, garbage, road problems, or safety concerns.
                </p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-5xl mb-4">⭐</p>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Give Feedback</h4>
                <p class="text-gray-600">
                    Share your experience and rate the services provided by your barangay officials.
                </p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-5xl mb-4">💬</p>
                <h4 class="text-xl font-bold text="text-gray-800 mb-2">Send a Message</h4>
                <p class="text-gray-600">
                    Communicate directly with barangay staff for quick assistance and updates.
                </p>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-700 text-white text-center py-4">
        <p>© 2026 Barangay Complaint & Feedback Management System</p>
    </footer>

</body>
</html>