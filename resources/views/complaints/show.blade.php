<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('complaints.index') }}" class="text-gray-500 hover:text-gray-700">←</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Complaint Details</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Status Banner -->
            <div class="rounded-xl overflow-hidden shadow-sm mb-6
                {{ $complaint->status === 'pending' ? 'bg-yellow-500' : '' }}
                {{ $complaint->status === 'in_progress' ? 'bg-blue-500' : '' }}
                {{ $complaint->status === 'resolved' ? 'bg-green-500' : '' }}">
                <div class="px-6 py-4 flex justify-between items-center">
                    <div>
                        <p class="text-white text-xs font-semibold uppercase tracking-wider mb-1">Current Status</p>
                        <p class="text-white text-2xl font-bold">
                            {{ $complaint->status === 'pending' ? '⏳ Pending' : '' }}
                            {{ $complaint->status === 'in_progress' ? '🔄 In Progress' : '' }}
                            {{ $complaint->status === 'resolved' ? '✅ Resolved' : '' }}
                        </p>
                    </div>
                    <div class="text-5xl opacity-30">📋</div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-xl font-bold text-gray-800">{{ $complaint->title }}</h3>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold">
                            {{ ucfirst($complaint->category) }}
                        </span>
                        <span class="text-xs text-gray-400">
                            Filed on {{ $complaint->created_at->format('M d, Y h:i A') }}
                        </span>
                    </div>
                </div>

                <div class="p-6 space-y-5">

                    <!-- Description -->
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Description</p>
                        <p class="text-gray-800 leading-relaxed">{{ $complaint->description }}</p>
                    </div>

                    <!-- Attachment -->
                    @if($complaint->attachment)
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Attachment</p>
                        <a href="{{ asset('storage/' . $complaint->attachment) }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 text-blue-600 hover:underline text-sm font-medium">
                            <span>📎</span> View Attachment
                        </a>
                    </div>
                    @endif

                    <!-- Timeline -->
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Timeline</p>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-sm">📝</div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Complaint Filed</p>
                                    <p class="text-xs text-gray-400">{{ $complaint->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>
                            @if($complaint->status !== 'pending')
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center text-sm">🔄</div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Status Updated</p>
                                    <p class="text-xs text-gray-400">{{ $complaint->updated_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>
                            @endif
                            @if($complaint->status === 'resolved')
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-sm">✅</div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Complaint Resolved</p>
                                    <p class="text-xs text-gray-400">{{ $complaint->updated_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <a href="{{ route('complaints.index') }}"
                           class="bg-gray-100 text-gray-700 px-5 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200 transition">
                            ← Back to Complaints
                        </a>
                        @if($complaint->status === 'resolved')
                            <a href="{{ route('feedbacks.create') }}"
                               class="bg-green-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                                ⭐ Leave Feedback
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>