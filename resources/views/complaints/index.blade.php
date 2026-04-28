<x-app-layout>
    <x-slot name="header">
        <div>
            <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Resident Services</p>
            <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">My Complaints</h1>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="fade-in fade-in-1" style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:14px 20px;margin-bottom:24px;display:flex;align-items:center;gap:10px;color:#15803d;font-size:14px;font-weight:500;">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif

    <div class="card fade-in fade-in-1">
        <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <h3 style="font-size:16px;font-weight:700;color:#0f2144;">All My Complaints</h3>
                <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Track the status of your submitted complaints</p>
            </div>
            <a href="{{ route('complaints.create') }}" class="btn-primary">+ New Complaint</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date Filed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($complaints as $index => $complaint)
                <tr>
                    <td style="color:#94a3b8;font-size:13px;">{{ $index + 1 }}</td>
                    <td style="font-weight:600;color:#0f2144;">{{ $complaint->title }}</td>
                    <td>
                        <span style="background:#f1f5f9;color:#475569;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:500;">
                            {{ ucfirst($complaint->category) }}
                        </span>
                    </td>
                    <td><span class="badge-{{ $complaint->status }}">{{ $complaint->status === 'in_progress' ? 'In Progress' : ucfirst($complaint->status) }}</span></td>
                    <td style="color:#94a3b8;font-size:13px;">{{ $complaint->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('complaints.show', $complaint) }}"
                           style="background:#eff6ff;color:#1a3a6b;padding:6px 14px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;transition:all 0.2s;"
                           onmouseover="this.style.background='#1a3a6b';this.style.color='white'"
                           onmouseout="this.style.background='#eff6ff';this.style.color='#1a3a6b'">
                            View →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:60px 20px;">
                        <div style="width:64px;height:64px;background:#eff6ff;border-radius:20px;display:flex;align-items:center;justify-content:center;font-size:32px;margin:0 auto 16px;">📋</div>
                        <p style="font-weight:600;color:#374151;margin-bottom:6px;">No complaints yet</p>
                        <p style="font-size:13px;color:#94a3b8;margin-bottom:20px;">Click the button below to file your first complaint</p>
                        <a href="{{ route('complaints.create') }}" class="btn-primary" style="display:inline-flex;">+ File a Complaint</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>