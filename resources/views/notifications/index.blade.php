<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🔔 Notifications
            </h2>
            <span class="text-sm text-gray-500">
                {{ auth()->user()->unreadNotifications->count() }} unread
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Row -->
            <div class="grid grid-cols-2 gap-5 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 font-medium">Total Notifications</p>
                    <p class="text-4xl font-bold text-blue-600 mt-2">
                        {{ auth()->user()->notifications->count() }}
                    </p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-red-500">
                    <p class="text-sm text-gray-500 font-medium">Unread</p>
                    <p class="text-4xl font-bold text-red-500 mt-2">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-800">All Notifications</h3>
                        <p class="text-sm text-gray-500 mt-1">Complaint updates and new messages</p>
                    </div>
                    @if(auth()->user()->notifications->count() > 0)
                        <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">
                            {{ auth()->user()->notifications->count() }} total
                        </span>
                    @endif
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($notifications as $notification)

                        @if(isset($notification->data['type']) && $notification->data['type'] === 'message')
                            {{-- Message Notification --}}
                            <a href="{{ route('messages.index') }}"
                               class="flex items-start gap-4 p-5 hover:bg-gray-50 transition
                                   {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xl">
                                        💬
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start gap-2">
                                        <p class="text-sm font-semibold text-gray-800">New Message Received</p>
                                        @if(!$notification->read_at)
                                            <span class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full mt-1.5"></span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-2">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-gray-400 mt-3">→</div>
                            </a>

                        @else
                            {{-- Complaint Status Notification --}}
                            <a href="{{ route('complaints.show', $notification->data['complaint_id']) }}"
                               class="flex items-start gap-4 p-5 hover:bg-gray-50 transition
                                   {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xl
                                        {{ $notification->data['status'] === 'pending' ? 'bg-yellow-100' : '' }}
                                        {{ $notification->data['status'] === 'in_progress' ? 'bg-blue-100' : '' }}
                                        {{ $notification->data['status'] === 'resolved' ? 'bg-green-100' : '' }}">
                                        {{ $notification->data['status'] === 'pending' ? '⏳' : '' }}
                                        {{ $notification->data['status'] === 'in_progress' ? '🔄' : '' }}
                                        {{ $notification->data['status'] === 'resolved' ? '✅' : '' }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start gap-2">
                                        <p class="text-sm font-semibold text-gray-800">Complaint Status Updated</p>
                                        @if(!$notification->read_at)
                                            <span class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full mt-1.5"></span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                            {{ $notification->data['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $notification->data['status'] === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $notification->data['status'] === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ $notification->data['status'] === 'in_progress' ? 'In Progress' : ucfirst($notification->data['status']) }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 text-gray-400 mt-3">→</div>
                            </a>
                        @endif

                    @empty
                        <div class="p-12 text-center text-gray-500">
                            <p class="text-5xl mb-4">🔔</p>
                            <p class="font-semibold text-gray-700">No notifications yet</p>
                            <p class="text-sm mt-1">You'll be notified when your complaint status changes or you receive a message</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>