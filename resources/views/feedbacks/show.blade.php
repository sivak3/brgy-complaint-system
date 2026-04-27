<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('feedbacks.index') }}" class="text-gray-500 hover:text-gray-700">←</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Feedback Details</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Rating Banner -->
            <div class="bg-gradient-to-r from-green-600 to-green-400 rounded-xl p-6 mb-6 shadow-sm">
                <p class="text-white text-xs font-semibold uppercase tracking-wider mb-2">Your Rating</p>
                <div class="flex items-center gap-3">
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $feedback->rating ? 'text-yellow-300' : 'text-green-300' }} text-3xl">★</span>
                        @endfor
                    </div>
                    <span class="text-white text-2xl font-bold">{{ $feedback->rating }}/5</span>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-xl font-bold text-gray-800">{{ $feedback->subject }}</h3>
                    <p class="text-xs text-gray-400 mt-2">
                        Submitted on {{ $feedback->created_at->format('M d, Y h:i A') }}
                    </p>
                </div>

                <div class="p-6 space-y-5">

                    <!-- Message -->
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Your Message</p>
                        <p class="text-gray-800 leading-relaxed">{{ $feedback->message }}</p>
                    </div>

                    <!-- Details -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Submitted By</p>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-sm">
                                    {{ strtoupper(substr($feedback->user->name, 0, 1)) }}
                                </div>
                                <p class="text-sm font-medium text-gray-800">{{ $feedback->user->name }}</p>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Date Submitted</p>
                            <p class="text-sm font-medium text-gray-800 mt-2">
                                {{ $feedback->created_at->format('M d, Y') }}
                            </p>
                            <p class="text-xs text-gray-400">{{ $feedback->created_at->format('h:i A') }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <a href="{{ route('feedbacks.index') }}"
                           class="bg-gray-100 text-gray-700 px-5 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200 transition">
                            ← Back to Feedbacks
                        </a>
                        <a href="{{ route('feedbacks.create') }}"
                           class="bg-green-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                            + New Feedback
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>