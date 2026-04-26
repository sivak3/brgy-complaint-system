<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-blue-600">{{ $totalComplaints }}</p>
                    <p class="text-gray-600 mt-1">Total Complaints</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-yellow-500">{{ $pendingComplaints }}</p>
                    <p class="text-gray-600 mt-1">Pending</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-green-600">{{ $resolvedComplaints }}</p>
                    <p class="text-gray-600 mt-1">Resolved</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-purple-600">{{ $totalFeedbacks }}</p>
                    <p class="text-gray-600 mt-1">Feedbacks</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-pink-600">{{ $totalMessages }}</p>
                    <p class="text-gray-600 mt-1">Messages</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-gray-700">{{ $totalUsers }}</p>
                    <p class="text-gray-600 mt-1">Users</p>
                </div>
            </div>

            <!-- Recent Complaints -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Recent Complaints</h3>
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Resident</th>
                            <th class="p-2 text-left">Title</th>
                            <th class="p-2 text-left">Category</th>
                            <th class="p-2 text-left">Status</th>
                            <th class="p-2 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentComplaints as $complaint)
                        <tr class="border-t">
                            <td class="p-2">{{ $complaint->user->name }}</td>
                            <td class="p-2">{{ $complaint->title }}</td>
                            <td class="p-2">{{ ucfirst($complaint->category) }}</td>
                            <td class="p-2">
                                <span class="px-2 py-1 rounded text-sm
                                    {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ ucfirst($complaint->status) }}
                                </span>
                            </td>
                            <td class="p-2">{{ $complaint->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">
                                No complaints yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4 flex gap-3">
                    <a href="{{ route('admin.complaints') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded">
                        Manage Complaints
                    </a>
                    <a href="{{ route('admin.feedbacks') }}"
                       class="bg-purple-600 text-white px-4 py-2 rounded">
                        View Feedbacks
                    </a>
                    <a href="{{ route('admin.users') }}"
                       class="bg-gray-700 text-white px-4 py-2 rounded">
                        Manage Users
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>