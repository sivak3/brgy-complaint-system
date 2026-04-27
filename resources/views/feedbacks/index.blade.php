<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Feedbacks
            </h2>
            <a href="{{ route('feedbacks.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                + New Feedback
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
                    <h3 class="font-semibold text-gray-700">All My Feedbacks</h3>
                    <p class="text-sm text-gray-500 mt-1">Your submitted feedback to the barangay</p>
                </div>
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">#</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Subject</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Rating</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Message</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Date</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($feedbacks as $index => $feedback)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-500 text-sm">{{ $index + 1 }}</td>
                            <td class="p-4 font-medium text-gray-800">{{ $feedback->subject }}</td>
                            <td class="p-4">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }} text-lg">★</span>
                                    @endfor
                                </div>
                            </td>
                            <td class="p-4 text-gray-600 text-sm">{{ Str::limit($feedback->message, 50) }}</td>
                            <td class="p-4 text-gray-500 text-sm">{{ $feedback->created_at->format('M d, Y') }}</td>
                            <td class="p-4">
                                <a href="{{ route('feedbacks.show', $feedback) }}"
                                   class="text-green-600 hover:underline text-sm font-medium">
                                    View →
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                <p class="text-4xl mb-3">⭐</p>
                                <p class="font-medium">No feedbacks yet.</p>
                                <p class="text-sm mt-1">Click "New Feedback" to submit one.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>