<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Feedback Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold">{{ $feedback->subject }}</h3>
                <p class="text-gray-500 text-sm mb-4">
                    {{ $feedback->created_at->format('M d, Y') }}
                </p>

                <div class="mb-3">
                    <span class="font-medium">Rating:</span>
                    @for($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}">
                            ★
                        </span>
                    @endfor
                </div>

                <div class="mb-3">
                    <span class="font-medium">Message:</span>
                    <p class="mt-1 text-gray-700">{{ $feedback->message }}</p>
                </div>

                <a href="{{ route('feedbacks.index') }}"
                   class="text-blue-600 underline">← Back to list</a>
            </div>
        </div>
    </div>
</x-app-layout>