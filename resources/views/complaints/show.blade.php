<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Complaint Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold">{{ $complaint->title }}</h3>
                <p class="text-gray-500 text-sm mb-4">
                    {{ $complaint->created_at->format('M d, Y') }}
                </p>

                <div class="mb-3">
                    <span class="font-medium">Category:</span>
                    {{ ucfirst($complaint->category) }}
                </div>

                <div class="mb-3">
                    <span class="font-medium">Status:</span>
                    <span class="px-2 py-1 rounded text-sm
                        {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                        {{ ucfirst($complaint->status) }}
                    </span>
                </div>

                <div class="mb-3">
                    <span class="font-medium">Description:</span>
                    <p class="mt-1 text-gray-700">{{ $complaint->description }}</p>
                </div>

                @if($complaint->attachment)
                <div class="mb-3">
                    <span class="font-medium">Attachment:</span>
                    <a href="{{ Storage::url($complaint->attachment) }}"
                       class="text-blue-600 underline ml-2" target="_blank">
                        View File
                    </a>
                </div>
                @endif

                <a href="{{ route('complaints.index') }}"
                   class="text-blue-600 underline">← Back to list</a>
            </div>
        </div>
    </div>
</x-app-layout>