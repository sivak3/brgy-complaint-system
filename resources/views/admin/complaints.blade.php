<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Complaints
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Resident</th>
                            <th class="p-2 text-left">Title</th>
                            <th class="p-2 text-left">Category</th>
                            <th class="p-2 text-left">Status</th>
                            <th class="p-2 text-left">Date</th>
                            <th class="p-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
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
                            <td class="p-2">
                                <form method="POST"
                                      action="{{ route('admin.complaints.status', $complaint) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status"
                                            class="border rounded p-1 text-sm"
                                            onchange="this.form.submit()">
                                        <option value="pending"
                                            {{ $complaint->status === 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="in_progress"
                                            {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>
                                            In Progress
                                        </option>
                                        <option value="resolved"
                                            {{ $complaint->status === 'resolved' ? 'selected' : '' }}>
                                            Resolved
                                        </option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">
                                No complaints yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>