<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('messages.index') }}" class="text-gray-500 hover:text-gray-700">←</a>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 font-bold text-sm">
                    {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                </div>
                <h2 class="font-semibold text-xl text-gray-800">Conversation with {{ $otherUser->name }}</h2>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded-lg mb-4 text-sm flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <!-- Conversation Thread -->
            <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-4">
                <div class="bg-purple-600 px-6 py-4 flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-400 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-white font-semibold">{{ $otherUser->name }}</p>
                        <p class="text-purple-200 text-xs">{{ $thread->count() }} message(s) in this conversation</p>
                    </div>
                </div>

                <!-- Messages -->
                <div class="p-6 space-y-4 max-h-96 overflow-y-auto" id="message-thread">
                    @foreach($thread as $msg)
                        @if($msg->sender_id === auth()->id())
                            <!-- Sent Message (Right) -->
                            <div class="flex justify-end">
                                <div class="max-w-xs lg:max-w-md">
                                    <div class="bg-purple-600 text-white rounded-2xl rounded-tr-sm px-4 py-3">
                                        <p class="text-sm">{{ $msg->body }}</p>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1 text-right">
                                        {{ $msg->created_at->format('M d, h:i A') }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <!-- Received Message (Left) -->
                            <div class="flex justify-start gap-2">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold text-sm flex-shrink-0 mt-1">
                                    {{ strtoupper(substr($msg->sender->name, 0, 1)) }}
                                </div>
                                <div class="max-w-xs lg:max-w-md">
                                    <div class="bg-gray-100 text-gray-800 rounded-2xl rounded-tl-sm px-4 py-3">
                                        <p class="text-sm">{{ $msg->body }}</p>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $msg->created_at->format('M d, h:i A') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Reply Box -->
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-4 border-b">
                    <p class="text-sm font-semibold text-gray-700">Reply to {{ $otherUser->name }}</p>
                </div>
                <div class="p-4">
                    <form method="POST" action="{{ route('messages.reply', $thread->first()) }}">
                        @csrf
                        <textarea name="body" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 resize-none"
                                  placeholder="Type your reply here...">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <div class="flex justify-between items-center mt-3">
                            <a href="{{ route('messages.index') }}"
                               class="text-sm text-gray-500 hover:text-gray-700">
                                ← Back to Messages
                            </a>
                            <button type="submit"
                                    class="bg-purple-600 text-white px-6 py-2 rounded-lg text-sm font-semibold hover:bg-purple-700 transition">
                                Send Reply ➤
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Auto scroll to bottom of thread -->
    <script>
        const thread = document.getElementById('message-thread');
        if (thread) thread.scrollTop = thread.scrollHeight;
    </script>
</x-app-layout>