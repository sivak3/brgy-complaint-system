<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">💬 Resident Messages</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="font-bold text-gray-800">All Conversations</h3>
                    <p class="text-sm text-gray-500 mt-1">Click any conversation to view and reply</p>
                </div>

                @forelse($messages as $key => $thread)
                    @php
                        $latest = $thread->last();
                        $sender = $latest->sender;
                        $receiver = $latest->receiver;
                    @endphp
                    <a href="{{ route('messages.show', $thread->first()) }}"
                       class="flex items-center gap-4 p-5 border-b hover:bg-gray-50 transition">
                        <!-- Avatars -->
                        <div class="flex -space-x-2 flex-shrink-0">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 font-bold text-sm border-2 border-white">
                                {{ strtoupper(substr($sender->name, 0, 1)) }}
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-sm border-2 border-white">
                                {{ strtoupper(substr($receiver->name, 0, 1)) }}
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-gray-800 text-sm">
                                    {{ $sender->name }}
                                    <span class="text-gray-400 font-normal">↔</span>
                                    {{ $receiver->name }}
                                </p>
                                <p class="text-xs text-gray-400">{{ $latest->created_at->format('M d, Y') }}</p>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">
                                <span class="font-medium text-gray-600">{{ $latest->sender->name }}:</span>
                                {{ Str::limit($latest->body, 60) }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">{{ $thread->count() }} message(s)</p>
                        </div>

                        <!-- Arrow -->
                        <div class="text-gray-400 flex-shrink-0">→</div>
                    </a>
                @empty
                    <div class="p-12 text-center text-gray-500">
                        <p class="text-5xl mb-4">💬</p>
                        <p class="font-semibold text-gray-700">No messages yet</p>
                        <p class="text-sm mt-1">Messages between residents will appear here</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>