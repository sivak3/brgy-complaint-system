<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Administration</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Manage Complaints</h1>
            </div>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="fade-in fade-in-1" style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:14px 20px;margin-bottom:24px;display:flex;align-items:center;gap:10px;color:#15803d;font-size:14px;font-weight:500;">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
        <div class="stat-card fade-in fade-in-1" style="border-left:4px solid #1a3a6b;padding:20px;">
            <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Total</p>
            <p style="font-size:28px;font-weight:700;color:#0f2144;margin:4px 0;" class="font-display">{{ $complaints->count() }}</p>
        </div>
        <div class="stat-card fade-in fade-in-2" style="border-left:4px solid #f59e0b;padding:20px;">
            <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Pending</p>
            <p style="font-size:28px;font-weight:700;color:#f59e0b;margin:4px 0;" class="font-display">{{ $complaints->where('status','pending')->count() }}</p>
        </div>
        <div class="stat-card fade-in fade-in-3" style="border-left:4px solid #10b981;padding:20px;">
            <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Resolved</p>
            <p style="font-size:28px;font-weight:700;color:#10b981;margin:4px 0;" class="font-display">{{ $complaints->where('status','resolved')->count() }}</p>
        </div>
    </div>

    <div class="card fade-in fade-in-2">
        <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;">
            <h3 style="font-size:16px;font-weight:700;color:#0f2144;">All Complaints</h3>
            <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Update status to automatically notify residents</p>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Resident</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @forelse($complaints as $index => $complaint)
                <tr style="cursor:pointer;" onclick="window.location='{{ route('admin.complaints.show', $complaint) }}'"
                    onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                    <td style="color:#94a3b8;font-size:13px;">{{ $index + 1 }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="avatar" style="background:#eff6ff;color:#1a3a6b;font-size:12px;">{{ strtoupper(substr($complaint->user->name,0,1)) }}</div>
                            <span style="font-weight:500;font-size:14px;">{{ $complaint->user->name }}</span>
                        </div>
                    </td>
                    <td style="font-weight:600;color:#0f2144;">{{ $complaint->title }}</td>
                    <td>
                        <span style="background:#f1f5f9;color:#475569;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:500;">{{ ucfirst($complaint->category) }}</span>
                    </td>
                    <td><span class="badge-{{ $complaint->status }}">{{ $complaint->status === 'in_progress' ? 'In Progress' : ucfirst($complaint->status) }}</span></td>
                    <td style="color:#94a3b8;font-size:13px;">{{ $complaint->created_at->format('M d, Y') }}</td>
                    <td onclick="event.stopPropagation();">
                        <form method="POST" action="{{ route('admin.complaints.status', $complaint) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()"
                                    style="border:1.5px solid #e2e8f0;border-radius:8px;padding:6px 10px;font-size:13px;color:#374151;outline:none;cursor:pointer;font-family:'DM Sans',sans-serif;background:white;"
                                    onfocus="this.style.borderColor='#1a3a6b'" onblur="this.style.borderColor='#e2e8f0'">
                                <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                                <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>✅ Resolved</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:60px;color:#94a3b8;">
                        <div style="font-size:48px;margin-bottom:12px;">📋</div>
                        <p style="font-weight:600;">No complaints yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>