<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Complaints</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg mb-6 flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="font-bold text-gray-800">All Complaints</h3>
                    <p class="text-sm text-gray-500 mt-1">Update complaint status to notify residents automatically</p>
                </div>
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">#</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Resident</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Title</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Category</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Status</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Date</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Update Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($complaints as $index => $complaint)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-500 text-sm">{{ $index + 1 }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-sm">
                                        {{ strtoupper(substr($complaint->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">{{ $complaint->user->name }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-700 font-medium">{{ $complaint->title }}</td>
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
                            <td class="p-4">
                                <form method="POST" action="{{ route('admin.complaints.status', $complaint) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status"
                                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            onchange="this.form.submit()">
                                        <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-500">
                                <p class="text-4xl mb-3">📋</p>
                                <p class="font-medium">No complaints yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>