<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-xl p-6 mb-8 flex items-center justify-between">
                <div>
                    <h3 class="text-white text-2xl font-bold">Welcome, {{ auth()->user()->name }}! 👋</h3>
                    <p class="text-blue-100 text-sm mt-1">Here's an overview of the barangay system today.</p>
                </div>
                <span class="text-6xl">🏛️</span>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-5 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 font-medium">Total Complaints</p>
                    <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalComplaints }}</p>
                    <a href="{{ route('admin.complaints') }}" class="text-xs text-blue-500 hover:underline mt-2 inline-block">View all →</a>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-400">
                    <p class="text-sm text-gray-500 font-medium">Pending</p>
                    <p class="text-4xl font-bold text-yellow-500 mt-2">{{ $pendingComplaints }}</p>
                    <p class="text-xs text-gray-400 mt-2">Awaiting action</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 font-medium">Resolved</p>
                    <p class="text-4xl font-bold text-green-600 mt-2">{{ $resolvedComplaints }}</p>
                    <p class="text-xs text-gray-400 mt-2">Successfully resolved</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                    <p class="text-sm text-gray-500 font-medium">Total Feedbacks</p>
                    <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalFeedbacks }}</p>
                    <a href="{{ route('admin.feedbacks') }}" class="text-xs text-purple-500 hover:underline mt-2 inline-block">View all →</a>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-pink-500">
                    <p class="text-sm text-gray-500 font-medium">Total Messages</p>
                    <p class="text-4xl font-bold text-pink-600 mt-2">{{ $totalMessages }}</p>
                    <p class="text-xs text-gray-400 mt-2">Sent by residents</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-gray-500">
                    <p class="text-sm text-gray-500 font-medium">Registered Users</p>
                    <p class="text-4xl font-bold text-gray-700 mt-2">{{ $totalUsers }}</p>
                    <a href="{{ route('admin.users') }}" class="text-xs text-gray-500 hover:underline mt-2 inline-block">View all →</a>
                </div>
            </div>

            <!-- Recent Complaints -->
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-800">Recent Complaints</h3>
                        <p class="text-sm text-gray-500 mt-1">Latest 5 complaints submitted by residents</p>
                    </div>
                    <a href="{{ route('admin.complaints') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                        Manage All
                    </a>
                </div>
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Resident</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Title</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Category</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Status</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentComplaints as $complaint)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-sm font-medium text-gray-800">{{ $complaint->user->name }}</td>
                            <td class="p-4 text-sm text-gray-700">{{ $complaint->title }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ ucfirst($complaint->category) }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ $complaint->status === 'in_progress' ? 'In Progress' : ucfirst($complaint->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-sm text-gray-500">{{ $complaint->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">
                                <p class="text-4xl mb-3">📋</p>
                                <p>No complaints yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Quick Links -->
                <div class="p-6 border-t bg-gray-50 flex flex-wrap gap-3">
                    <a href="{{ route('admin.complaints') }}"
                       class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                        📋 Manage Complaints
                    </a>
                    <a href="{{ route('admin.feedbacks') }}"
                       class="bg-purple-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-purple-700 transition">
                        ⭐ View Feedbacks
                    </a>
                    <a href="{{ route('admin.users') }}"
                       class="bg-gray-700 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-gray-800 transition">
                        👥 Manage Users
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>