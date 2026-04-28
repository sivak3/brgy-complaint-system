<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Administration</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Manage Users</h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-outline" style="font-size:13px;padding:8px 16px;">← Dashboard</a>
        </div>
    </x-slot>

    <!-- Stats Row -->
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-bottom:24px;">
        <div class="stat-card fade-in fade-in-1" style="border-left:4px solid #1a3a6b;padding:20px;">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Total Residents</p>
                    <p style="font-size:32px;font-weight:700;color:#0f2144;margin:6px 0 2px;" class="font-display">{{ $users->filter(fn($u) => !$u->hasRole('admin'))->count() }}</p>
                    <p style="font-size:12px;color:#94a3b8;">Registered accounts</p>
                </div>
                <div style="width:48px;height:48px;background:#eff6ff;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">👤</div>
            </div>
        </div>
        <div class="stat-card fade-in fade-in-2" style="border-left:4px solid #c9a84c;padding:20px;">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Admin Accounts</p>
                    <p style="font-size:32px;font-weight:700;color:#0f2144;margin:6px 0 2px;" class="font-display">{{ $users->filter(fn($u) => $u->hasRole('admin'))->count() }}</p>
                    <p style="font-size:12px;color:#94a3b8;">With admin access</p>
                </div>
                <div style="width:48px;height:48px;background:#fffbeb;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🔐</div>
            </div>
        </div>
    </div>

    <div class="card fade-in fade-in-2">
        <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;">
            <h3 style="font-size:16px;font-weight:700;color:#0f2144;">All Registered Users</h3>
            <p style="font-size:13px;color:#94a3b8;margin-top:2px;">List of all residents and admins in the system</p>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td style="color:#94a3b8;font-size:13px;">{{ $index + 1 }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div class="avatar" style="background:{{ $user->hasRole('admin') ? 'linear-gradient(135deg,#c9a84c,#a8832a)' : 'linear-gradient(135deg,#1a3a6b,#0f2144)' }};color:white;font-size:13px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p style="font-weight:600;color:#0f2144;font-size:14px;">{{ $user->name }}</p>
                                @if($user->id === auth()->id())
                                    <p style="font-size:11px;color:#94a3b8;">You</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="color:#64748b;font-size:13px;">{{ $user->email }}</td>
                    <td>
                        @if($user->hasRole('admin'))
                            <span style="background:#fffbeb;color:#a8832a;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">🔐 Admin</span>
                        @else
                            <span style="background:#eff6ff;color:#1a3a6b;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">👤 Resident</span>
                        @endif
                    </td>
                    <td style="color:#94a3b8;font-size:13px;">{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($user->id !== auth()->id())
                            <a href="{{ route('messages.create') }}"
                               style="background:#f5f3ff;color:#7c3aed;padding:6px 14px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;transition:all 0.2s;"
                               onmouseover="this.style.background='#7c3aed';this.style.color='white'"
                               onmouseout="this.style.background='#f5f3ff';this.style.color='#7c3aed'">
                                💬 Message
                            </a>
                        @else
                            <span style="color:#e2e8f0;font-size:13px;">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:60px;color:#94a3b8;">
                        <div style="font-size:48px;margin-bottom:12px;">👥</div>
                        <p style="font-weight:600;">No users yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>