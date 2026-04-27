<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('messages.index') }}" class="text-gray-500 hover:text-gray-700">←</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Send a Message</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="bg-purple-600 px-6 py-4">
                    <h3 class="text-white font-semibold text-lg">💬 New Message</h3>
                    <p class="text-purple-100 text-sm mt-1">Send a message directly to barangay staff</p>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('messages.store') }}">
                        @csrf

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Send To <span class="text-red-500">*</span>
                            </label>
                            <select name="receiver_id"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                                    required>
                                <option value="">-- Select Recipient --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('receiver_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                        @if($user->hasRole('admin'))
                                            (Admin)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('receiver_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="body" rows="6"
                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                                      placeholder="Type your message here..."
                                      required>{{ old('body') }}</textarea>
                            @error('body')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                                Send Message
                            </button>
                            <a href="{{ route('messages.index') }}"
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