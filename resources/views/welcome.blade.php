<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Complaint & Feedback Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-blue-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <span class="text-3xl">🏛️</span>
                <div>
                    <h1 class="text-white font-bold text-lg leading-tight">Barangay Management System</h1>
                    <p class="text-blue-200 text-xs">Complaint & Feedback Portal</p>
                </div>
            </div>
            <div class="flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="bg-white text-blue-800 px-5 py-2 rounded-lg font-semibold text-sm hover:bg-blue-50 transition">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-white border border-white px-5 py-2 rounded-lg font-semibold text-sm hover:bg-blue-700 transition">
                        Log In
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-yellow-400 text-blue-900 px-5 py-2 rounded-lg font-semibold text-sm hover:bg-yellow-300 transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="bg-gradient-to-br from-blue-800 to-blue-600 text-white py-20 px-6 text-center">
        <div class="max-w-4xl mx-auto">
            <span class="text-6xl mb-6 block">🏛️</span>
            <h2 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                Barangay Complaint &<br>Feedback Management System
            </h2>
            <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                A digital platform for residents to submit complaints, give feedback,
                and communicate directly with barangay officials — fast, easy, and transparent.
            </p>
            @guest
                <div class="flex justify-center gap-4">
                    <a href="{{ route('register') }}"
                       class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-lg font-bold text-lg hover:bg-yellow-300 transition shadow-lg">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}"
                       class="bg-white text-blue-800 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                        Log In
                    </a>
                </div>
            @endguest
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-3 gap-6 text-center">
            <div>
                <p class="text-3xl font-bold text-blue-700">📋</p>
                <p class="font-semibold text-gray-700 mt-1">File Complaints</p>
                <p class="text-gray-500 text-sm">Report barangay issues easily</p>
            </div>
            <div>
                <p class="text-3xl font-bold text-green-600">⭐</p>
                <p class="font-semibold text-gray-700 mt-1">Give Feedback</p>
                <p class="text-gray-500 text-sm">Rate barangay services</p>
            </div>
            <div>
                <p class="text-3xl font-bold text-purple-600">💬</p>
                <p class="font-semibold text-gray-700 mt-1">Send Messages</p>
                <p class="text-gray-500 text-sm">Talk to barangay officials</p>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="max-w-7xl mx-auto px-6 py-16">
        <h3 class="text-3xl font-bold text-center text-gray-800 mb-2">What You Can Do</h3>
        <p class="text-center text-gray-500 mb-12">Everything you need to communicate with your barangay</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-md p-8 text-center hover:shadow-lg transition border-t-4 border-blue-600">
                <p class="text-5xl mb-4">📋</p>
                <h4 class="text-xl font-bold text-gray-800 mb-3">File a Complaint</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Report issues such as noise, garbage, road damage, safety concerns,
                    and other barangay-related problems with supporting attachments.
                </p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-8 text-center hover:shadow-lg transition border-t-4 border-green-500">
                <p class="text-5xl mb-4">⭐</p>
                <h4 class="text-xl font-bold text-gray-800 mb-3">Give Feedback</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Share your experience and rate the quality of services provided
                    by your barangay officials to help improve governance.
                </p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-8 text-center hover:shadow-lg transition border-t-4 border-purple-500">
                <p class="text-5xl mb-4">💬</p>
                <h4 class="text-xl font-bold text-gray-800 mb-3">Send a Message</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Communicate directly with barangay staff for quick assistance,
                    follow-ups, and real-time updates on your concerns.
                </p>
            </div>
        </div>
    </div>

    <!-- How it Works -->
    <div class="bg-blue-50 py-16 px-6">
        <div class="max-w-5xl mx-auto">
            <h3 class="text-3xl font-bold text-center text-gray-800 mb-2">How It Works</h3>
            <p class="text-center text-gray-500 mb-12">Simple steps to get started</p>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="bg-blue-700 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">1</div>
                    <h4 class="font-bold text-gray-700 mb-1">Register</h4>
                    <p class="text-gray-500 text-sm">Create your resident account</p>
                </div>
                <div>
                    <div class="bg-blue-700 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">2</div>
                    <h4 class="font-bold text-gray-700 mb-1">Log In</h4>
                    <p class="text-gray-500 text-sm">Access your personal dashboard</p>
                </div>
                <div>
                    <div class="bg-blue-700 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">3</div>
                    <h4 class="font-bold text-gray-700 mb-1">Submit</h4>
                    <p class="text-gray-500 text-sm">File complaints or give feedback</p>
                </div>
                <div>
                    <div class="bg-blue-700 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">4</div>
                    <h4 class="font-bold text-gray-700 mb-1">Track</h4>
                    <p class="text-gray-500 text-sm">Monitor your complaint status</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white py-8 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <p class="font-bold text-lg mb-1">🏛️ Barangay Complaint & Feedback Management System</p>
            <p class="text-blue-200 text-sm">© 2026 All Rights Reserved</p>
        </div>
    </footer>

</body>
</html>