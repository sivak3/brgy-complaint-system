<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('complaints.index') }}" class="text-gray-500 hover:text-gray-700">←</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                File a Complaint
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="bg-blue-600 px-6 py-4">
                    <h3 class="text-white font-semibold text-lg">📋 New Complaint Form</h3>
                    <p class="text-blue-100 text-sm mt-1">Fill in the details of your complaint below</p>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('complaints.store') }}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Complaint Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Brief title of your complaint"
                                   value="{{ old('title') }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select name="category"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                <option value="">-- Select Category --</option>
                                <option value="noise" {{ old('category') == 'noise' ? 'selected' : '' }}>🔊 Noise Complaint</option>
                                <option value="garbage" {{ old('category') == 'garbage' ? 'selected' : '' }}>🗑️ Garbage/Sanitation</option>
                                <option value="road" {{ old('category') == 'road' ? 'selected' : '' }}>🛣️ Road/Infrastructure</option>
                                <option value="safety" {{ old('category') == 'safety' ? 'selected' : '' }}>🛡️ Safety/Security</option>
                                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>📌 Other</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" rows="5"
                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Describe your complaint in detail..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Attachment <span class="text-gray-400 font-normal">(optional)</span>
                            </label>
                            <div class="border border-dashed border-gray-300 rounded-lg px-4 py-3">
                                <input type="file" name="attachment"
                                       class="w-full text-sm text-gray-500"
                                       accept=".jpg,.png,.pdf">
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Accepted: JPG, PNG, PDF (max 2MB)</p>
                            @error('attachment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                                Submit Complaint
                            </button>
                            <a href="{{ route('complaints.index') }}"
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