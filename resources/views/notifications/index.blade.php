<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Notifications
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                @forelse($notifications as $notification)
                <a href="{{ route('complaints.show', $notification->data['complaint_id']) }}"
                   class="block border-l-4 {{ $notification->read_at ? 'border-gray-300 bg-gray-50' : 'border-blue-500 bg-blue-50' }} p-4 mb-3 rounded-r-lg hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-800">
                                {{ $notification->data['message'] }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $notification->created_at->format('M d, Y h:i A') }}
                            </p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full
                            {{ $notification->data['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $notification->data['status'] === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $notification->data['status'] === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                            {{ ucfirst($notification->data['status']) }}
                        </span>
                    </div>
                </a>
                @empty
                <div class="text-center text-gray-500 py-8">
                    <p class="text-4xl mb-3">🔔</p>
                    <p>No notifications yet.</p>
                </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>