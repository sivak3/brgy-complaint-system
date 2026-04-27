<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Complaints
            </h2>
            <a href="{{ route('complaints.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                + New Complaint
            </a>
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
                    <h3 class="font-semibold text-gray-700">All My Complaints</h3>
                    <p class="text-sm text-gray-500 mt-1">Track the status of your submitted complaints</p>
                </div>
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">#</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Title</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Category</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Status</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Date</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($complaints as $index => $complaint)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-500 text-sm">{{ $index + 1 }}</td>
                            <td class="p-4 font-medium text-gray-800">{{ $complaint->title }}</td>
                            <td class="p-4 text-gray-600 text-sm">{{ ucfirst($complaint->category) }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ $complaint->status === 'in_progress' ? 'In Progress' : ucfirst($complaint->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-500 text-sm">{{ $complaint->created_at->format('M d, Y') }}</td>
                            <td class="p-4">
                                <a href="{{ route('complaints.show', $complaint) }}"
                                   class="text-blue-600 hover:underline text-sm font-medium">
                                    View →
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                <p class="text-4xl mb-3">📋</p>
                                <p class="font-medium">No complaints yet.</p>
                                <p class="text-sm mt-1">Click "New Complaint" to submit one.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>