<nav x-data="{ open: false }" class="bg-blue-800 border-b border-blue-900 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <span class="text-2xl">🏛️</span>
                    <div class="hidden sm:block">
                        <p class="text-white font-bold text-sm leading-tight">Barangay System</p>
                        <p class="text-blue-300 text-xs">Complaint & Feedback Portal</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Nav Links -->
            <div class="hidden sm:flex sm:items-center sm:gap-1">
                <a href="{{ route('dashboard') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                    🏠 Dashboard
                </a>

                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                               {{ request()->routeIs('admin.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                            ⚙️ Admin Panel
                        </a>
                        <a href="{{ route('admin.complaints') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                               {{ request()->routeIs('admin.complaints') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                            📋 Complaints
                        </a>
                        <a href="{{ route('admin.feedbacks') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                               {{ request()->routeIs('admin.feedbacks') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                            ⭐ Feedbacks
                        </a>

                        <a href="{{ route('admin.messages') }}"
   class="px-3 py-2 rounded-lg text-sm font-medium transition
       {{ request()->routeIs('admin.messages') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
    💬 Messages
</a>

                        <a href="{{ route('admin.users') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                               {{ request()->routeIs('admin.users') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                            👥 Users
                        </a>
                    @else
                        <a href="{{ route('complaints.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                               {{ request()->routeIs('complaints.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                            📋 Complaints
                        </a>
                        <a href="{{ route('feedbacks.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                               {{ request()->routeIs('feedbacks.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                            ⭐ Feedback
                        </a>
                        <a href="{{ route('messages.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                               {{ request()->routeIs('messages.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                            💬 Messages
                        </a>
                        <a href="{{ route('notifications.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition relative
                               {{ request()->routeIs('notifications.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                            🔔 Notifications
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                    @endif
                @endauth
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 bg-blue-700 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition">
                            <div class="w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center font-bold text-xs">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden md:block">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-3 border-b">
                            <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            👤 My Profile
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="text-blue-200 hover:text-white p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden bg-blue-900 border-t border-blue-700 px-4 py-3 space-y-1">
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">
            🏠 Dashboard
        </a>
        @auth
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">⚙️ Admin Panel</a>
                <a href="{{ route('admin.complaints') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">📋 Complaints</a>
                <a href="{{ route('admin.feedbacks') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">⭐ Feedbacks</a>
                <a href="{{ route('admin.users') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">👥 Users</a>
            @else
                <a href="{{ route('complaints.index') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">📋 Complaints</a>
                <a href="{{ route('feedbacks.index') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">⭐ Feedback</a>
                <a href="{{ route('messages.index') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">💬 Messages</a>
                <a href="{{ route('notifications.index') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">🔔 Notifications</a>
            @endif
        @endauth
        <div class="border-t border-blue-700 pt-3 mt-2">
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">👤 My Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm text-blue-200 hover:bg-blue-700 hover:text-white">
                    🚪 Log Out
                </button>
            </form>
        </div>
    </div>
</nav>