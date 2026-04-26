<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
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

                <a href="{{ route('messages.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
                    + New Message
                </a>

                <table class="w-full mt-4 border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">From</th>
                            <th class="p-2 text-left">To</th>
                            <th class="p-2 text-left">Message</th>
                            <th class="p-2 text-left">Status</th>
                            <th class="p-2 text-left">Date</th>
                            <th class="p-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                        <tr class="border-t">
                            <td class="p-2">{{ $message->sender->name }}</td>
                            <td class="p-2">{{ $message->receiver->name }}</td>
                            <td class="p-2">
                                {{ Str::limit($message->body, 50) }}
                            </td>
                            <td class="p-2">
                                @if($message->is_read)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                        Read
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">
                                        Unread
                                    </span>
                                @endif
                            </td>
                            <td class="p-2">{{ $message->created_at->format('M d, Y') }}</td>
                            <td class="p-2">
                                <a href="{{ route('messages.show', $message) }}"
                                   class="text-blue-600 underline">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">
                                No messages yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>