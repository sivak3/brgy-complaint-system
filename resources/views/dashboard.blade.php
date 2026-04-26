<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->hasRole('admin') ? 'Admin Dashboard' : 'Resident Dashboard' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(auth()->user()->hasRole('admin'))
                <!-- Admin Quick Links -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('admin.dashboard') }}"
                       class="bg-blue-600 text-white rounded-lg p-6 text-center hover:bg-blue-700">
                        <p class="text-3xl mb-2">📋</p>
                        <p class="text-xl font-bold">Admin Panel</p>
                        <p class="text-sm mt-1">Manage complaints, feedbacks and users</p>
                    </a>
                    <a href="{{ route('admin.complaints') }}"
                       class="bg-yellow-500 text-white rounded-lg p-6 text-center hover:bg-yellow-600">
                        <p class="text-3xl mb-2">📝</p>
                        <p class="text-xl font-bold">Complaints</p>
                        <p class="text-sm mt-1">View and update complaint status</p>
                    </a>
                    <a href="{{ route('admin.users') }}"
                       class="bg-gray-700 text-white rounded-lg p-6 text-center hover:bg-gray-800">
                        <p class="text-3xl mb-2">👥</p>
                        <p class="text-xl font-bold">Users</p>
                        <p class="text-sm mt-1">Manage registered residents</p>
                    </a>
                </div>

            @else
                <!-- Resident Welcome -->
                <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800">
                        Welcome, {{ auth()->user()->name }}! 👋
                    </h3>
                    <p class="text-gray-600 mt-1">
                        This is the Barangay Complaint and Feedback Management System.
                        You can submit complaints, give feedback, and send messages to the barangay office.
                    </p>
                </div>

                <!-- Resident Quick Links -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('complaints.create') }}"
                       class="bg-blue-600 text-white rounded-lg p-6 text-center hover:bg-blue-700">
                        <p class="text-3xl mb-2">📋</p>
                        <p class="text-xl font-bold">File a Complaint</p>
                        <p class="text-sm mt-1">Submit a new barangay complaint</p>
                    </a>
                    <a href="{{ route('feedbacks.create') }}"
                       class="bg-green-600 text-white rounded-lg p-6 text-center hover:bg-green-700">
                        <p class="text-3xl mb-2">⭐</p>
                        <p class="text-xl font-bold">Give Feedback</p>
                        <p class="text-sm mt-1">Share your feedback with the barangay</p>
                    </a>
                    <a href="{{ route('messages.create') }}"
                       class="bg-purple-600 text-white rounded-lg p-6 text-center hover:bg-purple-700">
                        <p class="text-3xl mb-2">💬</p>
                        <p class="text-xl font-bold">Send Message</p>
                        <p class="text-sm mt-1">Message the barangay office directly</p>
                    </a>
                </div>

                <!-- My Activity -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <a href="{{ route('complaints.index') }}"
                       class="bg-white shadow-sm rounded-lg p-6 text-center hover:shadow-md">
                        <p class="text-gray-500">My Complaints</p>
                        <p class="text-3xl font-bold text-blue-600 mt-1">
                            {{ auth()->user()->complaints()->count() }}
                        </p>
                    </a>
                    <a href="{{ route('feedbacks.index') }}"
                       class="bg-white shadow-sm rounded-lg p-6 text-center hover:shadow-md">
                        <p class="text-gray-500">My Feedbacks</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">
                            {{ auth()->user()->feedbacks()->count() }}
                        </p>
                    </a>
                    <a href="{{ route('messages.index') }}"
                       class="bg-white shadow-sm rounded-lg p-6 text-center hover:shadow-md">
                        <p class="text-gray-500">My Messages</p>
                        <p class="text-3xl font-bold text-purple-600 mt-1">
                            {{ auth()->user()->sentMessages()->count() }}
                        </p>
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>