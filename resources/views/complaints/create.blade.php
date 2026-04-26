<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Submit a Complaint
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('complaints.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Title</label>
                        <input type="text" name="title"
                               class="w-full border rounded p-2 mt-1"
                               value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Category</label>
                        <select name="category" class="w-full border rounded p-2 mt-1" required>
                            <option value="">-- Select Category --</option>
                            <option value="noise">Noise Complaint</option>
                            <option value="garbage">Garbage/Sanitation</option>
                            <option value="road">Road/Infrastructure</option>
                            <option value="safety">Safety/Security</option>
                            <option value="other">Other</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="5"
                                  class="w-full border rounded p-2 mt-1"
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">
                            Attachment (optional)
                        </label>
                        <input type="file" name="attachment"
                               class="w-full border rounded p-2 mt-1"
                               accept=".jpg,.png,.pdf">
                        @error('attachment')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded">
                        Submit Complaint
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>