<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Submit Feedback
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('feedbacks.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Subject</label>
                        <input type="text" name="subject"
                               class="w-full border rounded p-2 mt-1"
                               value="{{ old('subject') }}" required>
                        @error('subject')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Rating</label>
                        <select name="rating" class="w-full border rounded p-2 mt-1" required>
                            <option value="">-- Select Rating --</option>
                            <option value="5">★★★★★ Excellent</option>
                            <option value="4">★★★★☆ Good</option>
                            <option value="3">★★★☆☆ Average</option>
                            <option value="2">★★☆☆☆ Poor</option>
                            <option value="1">★☆☆☆☆ Very Poor</option>
                        </select>
                        @error('rating')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Message</label>
                        <textarea name="message" rows="5"
                                  class="w-full border rounded p-2 mt-1"
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded">
                        Submit Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>