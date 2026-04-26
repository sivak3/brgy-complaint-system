<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Message Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-3">
                    <span class="font-medium">From:</span>
                    {{ $message->sender->name }}
                </div>

                <div class="mb-3">
                    <span class="font-medium">To:</span>
                    {{ $message->receiver->name }}
                </div>

                <div class="mb-3">
                    <span class="font-medium">Date:</span>
                    {{ $message->created_at->format('M d, Y h:i A') }}
                </div>

                <div class="mb-3">
                    <span class="font-medium">Message:</span>
                    <p class="mt-1 text-gray-700">{{ $message->body }}</p>
                </div>

                <a href="{{ route('messages.index') }}"
                   class="text-blue-600 underline">← Back to messages</a>
            </div>
        </div>
    </div>
</x-app-layout>