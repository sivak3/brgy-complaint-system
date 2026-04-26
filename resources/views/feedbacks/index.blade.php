<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Feedbacks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('feedbacks.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
                    + New Feedback
                </a>

                <table class="w-full mt-4 border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Subject</th>
                            <th class="p-2 text-left">Rating</th>
                            <th class="p-2 text-left">Date</th>
                            <th class="p-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feedbacks as $feedback)
                        <tr class="border-t">
                            <td class="p-2">{{ $feedback->subject }}</td>
                            <td class="p-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}">
                                        ★
                                    </span>
                                @endfor
                            </td>
                            <td class="p-2">{{ $feedback->created_at->format('M d, Y') }}</td>
                            <td class="p-2">
                                <a href="{{ route('feedbacks.show', $feedback) }}"
                                   class="text-blue-600 underline">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                No feedbacks yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>