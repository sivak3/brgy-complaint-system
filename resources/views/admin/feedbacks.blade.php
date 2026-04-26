<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Feedbacks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Resident</th>
                            <th class="p-2 text-left">Subject</th>
                            <th class="p-2 text-left">Rating</th>
                            <th class="p-2 text-left">Message</th>
                            <th class="p-2 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feedbacks as $feedback)
                        <tr class="border-t">
                            <td class="p-2">{{ $feedback->user->name }}</td>
                            <td class="p-2">{{ $feedback->subject }}</td>
                            <td class="p-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}">
                                        ★
                                    </span>
                                @endfor
                            </td>
                            <td class="p-2">{{ Str::limit($feedback->message, 60) }}</td>
                            <td class="p-2">{{ $feedback->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">
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