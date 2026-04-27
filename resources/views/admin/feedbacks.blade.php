<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Feedbacks</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="font-bold text-gray-800">All Resident Feedbacks</h3>
                    <p class="text-sm text-gray-500 mt-1">Feedback and ratings submitted by barangay residents</p>
                </div>
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">#</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Resident</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Subject</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Rating</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Message</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($feedbacks as $index => $feedback)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-500 text-sm">{{ $index + 1 }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 font-bold text-sm">
                                        {{ strtoupper(substr($feedback->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">{{ $feedback->user->name }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-sm font-medium text-gray-700">{{ $feedback->subject }}</td>
                            <td class="p-4">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }} text-lg">★</span>
                                    @endfor
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-600">{{ Str::limit($feedback->message, 60) }}</td>
                            <td class="p-4 text-sm text-gray-500">{{ $feedback->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                <p class="text-4xl mb-3">⭐</p>
                                <p class="font-medium">No feedbacks yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>