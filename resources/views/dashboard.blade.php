<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->hasRole('admin') ? 'Admin Dashboard' : 'Resident Dashboard' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(auth()->user()->hasRole('admin'))
                <!-- Admin Welcome Banner -->
                <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-xl p-6 mb-8 flex items-center justify-between">
                    <div>
                        <h3 class="text-white text-2xl font-bold">Welcome, {{ auth()->user()->name }}! 👋</h3>
                        <p class="text-blue-100 text-sm mt-1">Manage complaints, feedbacks, and residents from your admin panel.</p>
                    </div>
                    <span class="text-6xl">🏛️</span>
                </div>

                <!-- Admin Quick Links -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('admin.dashboard') }}"
                       class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-blue-500 hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-3xl group-hover:bg-blue-200 transition">
                                ⚙️
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Admin Panel</p>
                                <p class="text-sm text-gray-500 mt-1">Full system overview</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.complaints') }}"
                       class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-yellow-400 hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center text-3xl group-hover:bg-yellow-200 transition">
                                📋
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Complaints</p>
                                <p class="text-sm text-gray-500 mt-1">Update complaint status</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.users') }}"
                       class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-gray-500 hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-gray-100 rounded-xl flex items-center justify-center text-3xl group-hover:bg-gray-200 transition">
                                👥
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Users</p>
                                <p class="text-sm text-gray-500 mt-1">Manage residents</p>
                            </div>
                        </div>
                    </a>
                </div>

            @else
                <!-- Resident Welcome Banner -->
                <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-xl p-6 mb-8 flex items-center justify-between">
                    <div>
                        <h3 class="text-white text-2xl font-bold">Welcome, {{ auth()->user()->name }}! 👋</h3>
                        <p class="text-blue-100 text-sm mt-1">Submit complaints, give feedback, and communicate with your barangay officials.</p>
                    </div>
                    <span class="text-6xl">🏛️</span>
                </div>

                <!-- Resident Quick Actions -->
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <a href="{{ route('complaints.create') }}"
                       class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-blue-500 hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-3xl group-hover:bg-blue-200 transition">
                                📋
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">File a Complaint</p>
                                <p class="text-sm text-gray-500 mt-1">Report a barangay issue</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('feedbacks.create') }}"
                       class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-green-500 hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-3xl group-hover:bg-green-200 transition">
                                ⭐
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Give Feedback</p>
                                <p class="text-sm text-gray-500 mt-1">Rate barangay services</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('messages.create') }}"
                       class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-purple-500 hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center text-3xl group-hover:bg-purple-200 transition">
                                💬
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Send Message</p>
                                <p class="text-sm text-gray-500 mt-1">Talk to barangay staff</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- My Activity -->
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">My Activity</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <a href="{{ route('complaints.index') }}"
                       class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">My Complaints</p>
                                <p class="text-4xl font-bold text-blue-600 mt-2">
                                    {{ auth()->user()->complaints()->count() }}
                                </p>
                            </div>
                            <span class="text-3xl">📋</span>
                        </div>
                        <p class="text-xs text-blue-500 mt-3 hover:underline">View all →</p>
                    </a>
                    <a href="{{ route('feedbacks.index') }}"
                       class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">My Feedbacks</p>
                                <p class="text-4xl font-bold text-green-600 mt-2">
                                    {{ auth()->user()->feedbacks()->count() }}
                                </p>
                            </div>
                            <span class="text-3xl">⭐</span>
                        </div>
                        <p class="text-xs text-green-500 mt-3 hover:underline">View all →</p>
                    </a>
                    <a href="{{ route('messages.index') }}"
                       class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">My Messages</p>
                                <p class="text-4xl font-bold text-purple-600 mt-2">
                                    {{ auth()->user()->sentMessages()->count() }}
                                </p>
                            </div>
                            <span class="text-3xl">💬</span>
                        </div>
                        <p class="text-xs text-purple-500 mt-3 hover:underline">View all →</p>
                    </a>
                </div>

                <!-- Recent Complaints Status -->
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Recent Complaint Status</h3>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="p-4 text-left text-sm font-semibold text-gray-600">Title</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-600">Category</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-600">Status</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-600">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse(auth()->user()->complaints()->latest()->take(5)->get() as $complaint)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 text-sm font-medium text-gray-800">{{ $complaint->title }}</td>
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
                                <td colspan="4" class="p-8 text-center text-gray-500">
                                    <p class="text-3xl mb-2">📋</p>
                                    <p class="text-sm">No complaints filed yet.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>