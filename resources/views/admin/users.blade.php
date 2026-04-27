<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Users</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Row -->
            <div class="grid grid-cols-2 gap-5 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 font-medium">Total Residents</p>
                    <p class="text-4xl font-bold text-blue-600 mt-2">
                        {{ $users->where('id', '!=', auth()->id())->count() }}
                    </p>
                    <p class="text-xs text-gray-400 mt-1">Registered in the system</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
                    <p class="text-sm text-gray-500 font-medium">Admin Accounts</p>
                    <p class="text-4xl font-bold text-red-600 mt-2">
                        {{ $users->filter(fn($u) => $u->hasRole('admin'))->count() }}
                    </p>
                    <p class="text-xs text-gray-400 mt-1">With admin privileges</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="font-bold text-gray-800">All Registered Users</h3>
                    <p class="text-sm text-gray-500 mt-1">List of all residents and admins in the system</p>
                </div>
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">#</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Name</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Email</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Role</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Joined</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-600">Message</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $index => $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-500 text-sm">{{ $index + 1 }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm
                                        {{ $user->hasRole('admin') ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $user->name }}</p>
                                        @if($user->id === auth()->id())
                                            <p class="text-xs text-gray-400">You</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $user->hasRole('admin') ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $user->hasRole('admin') ? '🔐 Admin' : '👤 Resident' }}
                                </span>
                            </td>
                            <td class="p-4 text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="p-4">
                                @if($user->id !== auth()->id())
                                    <a href="{{ route('messages.create') }}?to={{ $user->id }}"
                                       class="text-purple-600 hover:underline text-sm font-medium">
                                        💬 Message
                                    </a>
                                @else
                                    <span class="text-gray-300 text-sm">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                <p class="text-4xl mb-3">👥</p>
                                <p class="font-medium">No users yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>