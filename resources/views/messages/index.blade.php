<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                💬 Messages
            </h2>
            <a href="{{ route('messages.create') }}"
               class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-purple-700 transition">
                + New Message
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg mb-6 flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="font-bold text-gray-800">Conversations</h3>
                    <p class="text-sm text-gray-500 mt-1">Your message threads with barangay staff and residents</p>
                </div>

                @forelse($messages as $otherId => $thread)
                    @php
                        $latest = $thread->last();
                        $otherPerson = $latest->sender_id === auth()->id()
                            ? $latest->receiver
                            : $latest->sender;
                    @endphp
                    <a href="{{ route('messages.show', $thread->first()) }}"
                       class="flex items-center gap-4 p-5 border-b hover:bg-gray-50 transition">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 font-bold text-lg flex-shrink-0">
                            {{ strtoupper(substr($otherPerson->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-gray-800">{{ $otherPerson->name }}</p>
                                <p class="text-xs text-gray-400">{{ $latest->created_at->format('M d, Y') }}</p>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">
                                @if($latest->sender_id === auth()->id())
                                    <span class="text-purple-500">You: </span>
                                @endif
                                {{ Str::limit($latest->body, 60) }}
                            </p>
                        </div>
                        <div class="text-gray-400 flex-shrink-0">→</div>
                    </a>
                @empty
                    <div class="p-12 text-center text-gray-500">
                        <p class="text-5xl mb-4">💬</p>
                        <p class="font-semibold text-gray-700">No conversations yet</p>
                        <p class="text-sm mt-1 mb-4">Start a conversation with barangay staff</p>
                        <a href="{{ route('messages.create') }}"
                           class="bg-purple-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-purple-700 transition">
                            Send First Message
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>