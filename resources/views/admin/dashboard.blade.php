<x-app-layout>
    <x-slot name="header">
        <div>
            <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Administration</p>
            <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Admin Panel</h1>
        </div>
    </x-slot>

    <!-- Welcome Banner -->
    <div class="fade-in fade-in-1" style="background:linear-gradient(135deg,#c97b5a 0%,#e8956d 100%);border-radius:20px;padding:32px 36px;margin-bottom:28px;display:flex;justify-content:space-between;align-items:center;overflow:hidden;position:relative;">
        <div style="position:absolute;top:-40px;right:200px;width:200px;height:200px;background:radial-gradient(circle,rgba(201,168,76,0.15) 0%,transparent 70%);border-radius:50%;"></div>
        <div style="position:relative;z-index:1;">
            <p style="color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:8px;">Welcome back,</p>
            <h2 class="font-display" style="color:white;font-size:28px;margin-bottom:10px;">{{ auth()->user()->name }}</h2>
            <p style="color:rgba(255,255,255,0.5);font-size:14px;">Here's your barangay system overview.</p>
        </div>
        <div style="font-size:80px;opacity:0.15;position:relative;z-index:1;">🏛️</div>
    </div>

    <!-- Stats -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:28px;">
        <div class="stat-card fade-in fade-in-1" style="border-top:4px solid #1a3a6b;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Total Complaints</p>
                    <p style="font-size:36px;font-weight:700;color:#0f2144;margin:8px 0 4px;" class="font-display">{{ $totalComplaints }}</p>
                    <a href="{{ route('admin.complaints') }}" style="font-size:12px;color:#1a3a6b;text-decoration:none;font-weight:500;">Manage →</a>
                </div>
                <div style="width:48px;height:48px;background:#eff6ff;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">📋</div>
            </div>
        </div>
        <div class="stat-card fade-in fade-in-2" style="border-top:4px solid #f59e0b;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Pending</p>
                    <p style="font-size:36px;font-weight:700;color:#0f2144;margin:8px 0 4px;" class="font-display">{{ $pendingComplaints }}</p>
                    <p style="font-size:12px;color:#f59e0b;font-weight:500;">Needs attention</p>
                </div>
                <div style="width:48px;height:48px;background:#fffbeb;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">⏳</div>
            </div>
        </div>
        <div class="stat-card fade-in fade-in-3" style="border-top:4px solid #10b981;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Resolved</p>
                    <p style="font-size:36px;font-weight:700;color:#0f2144;margin:8px 0 4px;" class="font-display">{{ $resolvedComplaints }}</p>
                    <p style="font-size:12px;color:#10b981;font-weight:500;">Successfully closed</p>
                </div>
                <div style="width:48px;height:48px;background:#f0fdf4;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">✅</div>
            </div>
        </div>
        <div class="stat-card fade-in fade-in-4" style="border-top:4px solid #8b5cf6;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Feedbacks</p>
                    <p style="font-size:36px;font-weight:700;color:#0f2144;margin:8px 0 4px;" class="font-display">{{ $totalFeedbacks }}</p>
                    <a href="{{ route('admin.feedbacks') }}" style="font-size:12px;color:#8b5cf6;text-decoration:none;font-weight:500;">View all →</a>
                </div>
                <div style="width:48px;height:48px;background:#f5f3ff;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">⭐</div>
            </div>
        </div>
        <div class="stat-card fade-in fade-in-5" style="border-top:4px solid #ec4899;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Messages</p>
                    <p style="font-size:36px;font-weight:700;color:#0f2144;margin:8px 0 4px;" class="font-display">{{ $totalMessages }}</p>
                    <a href="{{ route('admin.messages') }}" style="font-size:12px;color:#ec4899;text-decoration:none;font-weight:500;">View all →</a>
                </div>
                <div style="width:48px;height:48px;background:#fdf2f8;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">💬</div>
            </div>
        </div>
        <div class="stat-card fade-in fade-in-6" style="border-top:4px solid #c9a84c;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Residents</p>
                    <p style="font-size:36px;font-weight:700;color:#0f2144;margin:8px 0 4px;" class="font-display">{{ $totalUsers }}</p>
                    <a href="{{ route('admin.users') }}" style="font-size:12px;color:#c9a84c;text-decoration:none;font-weight:500;">View all →</a>
                </div>
                <div style="width:48px;height:48px;background:#fffbeb;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">👥</div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints -->
    <div class="card fade-in fade-in-4">
        <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <h3 style="font-size:16px;font-weight:700;color:#0f2144;">Recent Complaints</h3>
                <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Latest submissions from residents</p>
            </div>
            <a href="{{ route('admin.complaints') }}" class="btn-primary" style="font-size:13px;padding:8px 16px;">Manage All</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Resident</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentComplaints as $complaint)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="avatar" style="background:#eff6ff;color:#1a3a6b;font-size:12px;">{{ strtoupper(substr($complaint->user->name,0,1)) }}</div>
                            <span style="font-weight:500;font-size:14px;">{{ $complaint->user->name }}</span>
                        </div>
                    </td>
                    <td style="font-weight:500;color:#0f2144;">{{ $complaint->title }}</td>
                    <td>
                        <span style="background:#f1f5f9;color:#475569;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:500;">{{ ucfirst($complaint->category) }}</span>
                    </td>
                    <td><span class="badge-{{ $complaint->status }}">{{ $complaint->status === 'in_progress' ? 'In Progress' : ucfirst($complaint->status) }}</span></td>
                    <td style="color:#94a3b8;font-size:13px;">{{ $complaint->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;padding:40px;color:#94a3b8;">No complaints yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>