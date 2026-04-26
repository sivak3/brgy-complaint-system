<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Send a Message
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Send To</label>
                        <select name="receiver_id" class="w-full border rounded p-2 mt-1" required>
                            <option value="">-- Select Recipient --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('receiver_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Message</label>
                        <textarea name="body" rows="5"
                                  class="w-full border rounded p-2 mt-1"
                                  required>{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>