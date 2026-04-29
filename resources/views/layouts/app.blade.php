<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Barangay System') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        body { background: #fff5f0; }

        /* Sidebar */
        .sidebar { background: linear-gradient(180deg, #c97b5a 0%, #e8956d 100%); min-height: 100vh; width: 260px; position: fixed; left: 0; top: 0; z-index: 50; box-shadow: 4px 0 20px rgba(0,0,0,0.15); }
        .sidebar-logo { border-bottom: 1px solid rgba(255,255,255,0.1); padding: 24px 20px; }
        .sidebar-nav a { display: flex; align-items: center; gap: 12px; padding: 11px 20px; color: rgba(255,255,255,0.85); font-size: 14px; font-weight: 500; transition: all 0.2s; border-left: 3px solid transparent; text-decoration: none; }
        .sidebar-nav a:hover { background: rgba(255,255,255,0.15); color: white; border-left-color: white; }
        .sidebar-nav a.active { background: rgba(255,255,255,0.25); color: white; border-left-color: white; }
        .sidebar-nav .nav-section { padding: 20px 20px 8px; font-size: 10px; font-weight: 600; color: rgba(255,255,255,0.5); letter-spacing: 1.5px; text-transform: uppercase; }

        /* Main Content */
        .main-content { margin-left: 260px; min-height: 100vh; }
        .topbar { background: white; border-bottom: 1px solid #fde0d0; padding: 0 32px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 40; box-shadow: 0 1px 8px rgba(232,149,109,0.1); }

        /* Cards */
        .card { background: white; border-radius: 16px; box-shadow: 0 2px 16px rgba(232,149,109,0.1); border: 1px solid #fde0d0; }
        .stat-card { background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 16px rgba(232,149,109,0.1); border: 1px solid #fde0d0; position: relative; overflow: hidden; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-2px); }

        /* Buttons */
        .btn-primary { background: linear-gradient(135deg, #e8956d, #c97b5a); color: white; padding: 10px 20px; border-radius: 10px; font-size: 14px; font-weight: 500; border: none; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(201,123,90,0.4); color: white; }
        .btn-gold { background: linear-gradient(135deg, #f0a87a, #e8956d); color: white; padding: 10px 20px; border-radius: 10px; font-size: 14px; font-weight: 500; border: none; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-gold:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(232,149,109,0.4); color: white; }
        .btn-outline { background: transparent; color: #c97b5a; padding: 10px 20px; border-radius: 10px; font-size: 14px; font-weight: 500; border: 2px solid #fde0d0; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-outline:hover { border-color: #e8956d; background: #fff5f0; color: #c97b5a; }

        /* Badges */
        .badge-pending { background: #fff3e0; color: #e65100; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-in_progress { background: #fde0d0; color: #c97b5a; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-resolved { background: #f0fdf4; color: #15803d; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }

        /* Table */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { padding: 14px 16px; text-align: left; font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.8px; background: #fff5f0; border-bottom: 1px solid #fde0d0; }
        .data-table td { padding: 16px; font-size: 14px; color: #374151; border-bottom: 1px solid #fff0ea; }
        .data-table tr:hover td { background: #fff5f0; }
        .data-table tr:last-child td { border-bottom: none; }

        /* Form inputs */
        .form-input { width: 100%; border: 1.5px solid #fde0d0; border-radius: 10px; padding: 12px 16px; font-size: 14px; color: #1e293b; transition: all 0.2s; outline: none; background: white; }
        .form-input:focus { border-color: #e8956d; box-shadow: 0 0 0 3px rgba(232,149,109,0.15); }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px; }

        /* Avatar */
        .avatar { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; }

        /* Notification badge */
        .notif-badge { position: absolute; top: -4px; right: -4px; background: #ef4444; color: white; font-size: 10px; font-weight: 700; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }

        /* Animations */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeInUp 0.4s ease forwards; }
        .fade-in-1 { animation-delay: 0.05s; opacity: 0; }
        .fade-in-2 { animation-delay: 0.1s; opacity: 0; }
        .fade-in-3 { animation-delay: 0.15s; opacity: 0; }
        .fade-in-4 { animation-delay: 0.2s; opacity: 0; }
        .fade-in-5 { animation-delay: 0.25s; opacity: 0; }
        .fade-in-6 { animation-delay: 0.3s; opacity: 0; }
    </style>
</head>
<body>
    <div style="display:flex;">
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Logo -->
            <div class="sidebar-logo">
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:44px;height:44px;background:rgba(255,255,255,0.3);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0;">🏛️</div>
                    <div>
                        <p style="color:white;font-weight:700;font-size:14px;line-height:1.2;" class="font-display">Barangay Portal</p>
                        <p style="color:rgba(255,255,255,0.6);font-size:11px;">Management System</p>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div style="padding:16px 20px;border-bottom:1px solid rgba(255,255,255,0.1);">
                <div style="display:flex;align-items:center;gap:12px;">
                    <div class="avatar" style="background:rgba(255,255,255,0.3);color:white;flex-shrink:0;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div style="min-width:0;">
                        <p style="color:white;font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</p>
                        <p style="color:rgba(255,255,255,0.6);font-size:11px;">
                            {{ auth()->user()->hasRole('admin') ? 'Administrator' : 'Resident' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav" style="padding:12px 0;overflow-y:auto;max-height:calc(100vh - 200px);">
                <div class="nav-section">Main Menu</div>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span>🏠</span> Dashboard
                </a>

                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <div class="nav-section">Administration</div>
                        <a href="{{ route('admin.complaints') }}" class="{{ request()->routeIs('admin.complaints') ? 'active' : '' }}">
                            <span>📋</span> Complaints
                            @php $unreadComplaints = \App\Models\Complaint::where('is_read', false)->count(); @endphp
                            @if($unreadComplaints > 0)
                                <span style="margin-left:auto;background:rgba(255,255,255,0.3);color:white;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">
                                    {{ $unreadComplaints }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('admin.feedbacks') }}" class="{{ request()->routeIs('admin.feedbacks') ? 'active' : '' }}">
                            <span>⭐</span> Feedbacks
                            @php $unreadFeedbacks = \App\Models\Feedback::where('is_read', false)->count(); @endphp
                            @if($unreadFeedbacks > 0)
                                <span style="margin-left:auto;background:rgba(255,255,255,0.3);color:white;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">
                                    {{ $unreadFeedbacks }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('admin.messages') }}" class="{{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                            <span>💬</span> Messages
                            @php $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count(); @endphp
                            @if($unreadCount > 0)
                                <span style="margin-left:auto;background:rgba(255,255,255,0.3);color:white;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                            <span>👥</span> Users
                        </a>
                    @else
                        <div class="nav-section">Resident Services</div>
                        <a href="{{ route('complaints.index') }}" class="{{ request()->routeIs('complaints.*') ? 'active' : '' }}">
                            <span>📋</span> My Complaints
                        </a>
                        <a href="{{ route('feedbacks.index') }}" class="{{ request()->routeIs('feedbacks.*') ? 'active' : '' }}">
                            <span>⭐</span> My Feedbacks
                        </a>
                        <a href="{{ route('messages.index') }}" class="{{ request()->routeIs('messages.*') ? 'active' : '' }}">
                            <span>💬</span> Messages
                            @php $residentUnread = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count(); @endphp
                            @if($residentUnread > 0)
                                <span style="margin-left:auto;background:rgba(255,255,255,0.3);color:white;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">
                                    {{ $residentUnread }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('notifications.index') }}" class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                            <span>🔔</span> Notifications
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span style="margin-left:auto;background:rgba(255,255,255,0.3);color:white;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                    @endif
                @endauth

                <div class="nav-section">Account</div>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <span>👤</span> My Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;display:flex;align-items:center;gap:12px;padding:11px 20px;color:rgba(255,255,255,0.85);font-size:14px;font-weight:500;transition:all 0.2s;border-left:3px solid transparent;font-family:'DM Sans',sans-serif;" onmouseover="this.style.background='rgba(255,255,255,0.15)';this.style.color='white';this.style.borderLeftColor='white'" onmouseout="this.style.background='none';this.style.color='rgba(255,255,255,0.85)';this.style.borderLeftColor='transparent'">
                        <span>🚪</span> Log Out
                    </button>
                </form>
            </nav>

            <!-- Sidebar Footer -->
            <div style="position:absolute;bottom:0;left:0;right:0;padding:16px 20px;border-top:1px solid rgba(255,255,255,0.1);">
                <p style="color:rgba(255,255,255,0.4);font-size:11px;text-align:center;">© 2026 Barangay Portal v1.0</p>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content" style="flex:1;">
            <!-- Top Bar -->
            <div class="topbar">
                <div style="flex:1;min-width:0;">
                    {{ $header ?? '' }}
                </div>
                <div style="display:flex;align-items:center;gap:16px;flex-shrink:0;">
                    @if(!auth()->user()->hasRole('admin'))
                        <a href="{{ route('notifications.index') }}" style="position:relative;width:36px;height:36px;background:#fff5f0;border-radius:10px;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all 0.2s;flex-shrink:0;" onmouseover="this.style.background='#fde0d0'" onmouseout="this.style.background='#fff5f0'">
                            <span style="font-size:18px;">🔔</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </a>
                    @endif
                    <div style="text-align:right;padding-left:16px;border-left:1px solid #fde0d0;">
                        <p style="font-size:13px;font-weight:600;color:#c97b5a;line-height:1.3;" id="current-time"></p>
                        <p style="font-size:11px;color:#94a3b8;line-height:1.3;" id="current-date"></p>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main style="padding:32px;">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const date = now.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' });
            const timeEl = document.getElementById('current-time');
            const dateEl = document.getElementById('current-date');
            if (timeEl) timeEl.textContent = time;
            if (dateEl) dateEl.textContent = date;
        }
        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>
</html>