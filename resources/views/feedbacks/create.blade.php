<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('feedbacks.index') }}" class="text-gray-500 hover:text-gray-700">←</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Give Feedback</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="bg-green-600 px-6 py-4">
                    <h3 class="text-white font-semibold text-lg">⭐ Feedback Form</h3>
                    <p class="text-green-100 text-sm mt-1">Share your experience with barangay services</p>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('feedbacks.store') }}">
                        @csrf

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="subject"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                   placeholder="What is your feedback about?"
                                   value="{{ old('subject') }}" required>
                            @error('subject')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Rating <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-3">
                                @for($i = 1; $i <= 5; $i++)
                                <label class="flex items-center gap-1 cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}"
                                           {{ old('rating') == $i ? 'checked' : '' }} required>
                                    <span class="text-yellow-400 text-xl">★</span>
                                    <span class="text-sm text-gray-600">{{ $i }}</span>
                                </label>
                                @endfor
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" rows="5"
                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                      placeholder="Write your feedback here..."
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                                Submit Feedback
                            </button>
                            <a href="{{ route('feedbacks.index') }}"
                               class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>