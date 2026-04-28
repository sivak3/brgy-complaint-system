<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('admin.complaints') }}" style="width:36px;height:36px;background:white;border:1px solid #e8ecf4;border-radius:10px;display:flex;align-items:center;justify-content:center;text-decoration:none;color:#64748b;font-size:18px;transition:all 0.2s;" onmouseover="this.style.borderColor='#1a3a6b';this.style.color='#1a3a6b'" onmouseout="this.style.borderColor='#e8ecf4';this.style.color='#64748b'">←</a>
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Administration</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Complaint Details</h1>
            </div>
        </div>
    </x-slot>

    <div style="max-width:750px;">

        <!-- Status Banner -->
        <div class="fade-in fade-in-1" style="border-radius:16px;padding:24px 28px;margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;
            {{ $complaint->status === 'pending' ? 'background:linear-gradient(135deg,#f59e0b,#d97706);' : '' }}
            {{ $complaint->status === 'in_progress' ? 'background:linear-gradient(135deg,#1a3a6b,#0f2144);' : '' }}
            {{ $complaint->status === 'resolved' ? 'background:linear-gradient(135deg,#10b981,#059669);' : '' }}">
            <div>
                <p style="color:rgba(255,255,255,0.7);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;">Current Status</p>
                <p style="color:white;font-size:24px;font-weight:700;" class="font-display">
                    @if($complaint->status === 'pending') ⏳ Pending
                    @elseif($complaint->status === 'in_progress') 🔄 In Progress
                    @else ✅ Resolved
                    @endif
                </p>
            </div>
            <div style="font-size:60px;opacity:0.2;">📋</div>
        </div>

        <!-- Main Card -->
        <div class="card fade-in fade-in-2" style="overflow:hidden;">
            <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;">
                <h2 style="font-size:20px;font-weight:700;color:#0f2144;margin-bottom:10px;" class="font-display">{{ $complaint->title }}</h2>
                <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
                    <span style="background:#f1f5f9;color:#475569;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
                        {{ ucfirst($complaint->category) }}
                    </span>
                    <span style="color:#94a3b8;font-size:13px;">
                        📅 Filed {{ $complaint->created_at->format('M d, Y h:i A') }}
                    </span>
                    <span style="color:#94a3b8;font-size:13px;">
                        👤 <span style="font-weight:600;color:#374151;">{{ $complaint->user->name }}</span>
                    </span>
                </div>
            </div>

            <div style="padding:28px;">

                <!-- Description -->
                <div style="background:#f8fafc;border-radius:12px;padding:20px;margin-bottom:20px;">
                    <p style="font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Description</p>
                    <p style="color:#374151;font-size:14px;line-height:1.8;">{{ $complaint->description }}</p>
                </div>

                <!-- Attachment -->
                @if($complaint->attachment)
                <div style="background:#f8fafc;border-radius:12px;padding:20px;margin-bottom:20px;">
                    <p style="font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Attachment</p>
                    <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank"
                       style="display:inline-flex;align-items:center;gap:8px;background:#eff6ff;color:#1a3a6b;padding:10px 16px;border-radius:10px;font-size:13px;font-weight:600;text-decoration:none;">
                        📎 View Attachment
                    </a>
                </div>
                @endif

                <!-- Update Status -->
                <div style="background:#f8fafc;border-radius:12px;padding:20px;margin-bottom:20px;">
                    <p style="font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Update Status</p>
                    <form method="POST" action="{{ route('admin.complaints.status', $complaint) }}" style="display:flex;gap:12px;align-items:center;">
                        @csrf
                        @method('PATCH')
                        <select name="status" style="border:1.5px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:13px;color:#374151;outline:none;cursor:pointer;background:white;"
                                onfocus="this.style.borderColor='#1a3a6b'" onblur="this.style.borderColor='#e2e8f0'">
                            <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                            <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>✅ Resolved</option>
                        </select>
                        <button type="submit" class="btn-primary" style="padding:8px 20px;">Update</button>
                    </form>
                </div>

                <!-- Timeline -->
                <div style="background:#f8fafc;border-radius:12px;padding:20px;margin-bottom:24px;">
                    <p style="font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;margin-bottom:16px;">Timeline</p>
                    <div style="display:flex;flex-direction:column;gap:14px;">
                        <div style="display:flex;align-items:center;gap:14px;">
                            <div style="width:36px;height:36px;background:#eff6ff;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">📝</div>
                            <div>
                                <p style="font-size:13px;font-weight:600;color:#374151;">Complaint Filed</p>
                                <p style="font-size:12px;color:#94a3b8;">{{ $complaint->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                        @if($complaint->status !== 'pending')
                        <div style="display:flex;align-items:center;gap:14px;">
                            <div style="width:36px;height:36px;background:#fffbeb;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">🔄</div>
                            <div>
                                <p style="font-size:13px;font-weight:600;color:#374151;">Status Updated</p>
                                <p style="font-size:12px;color:#94a3b8;">{{ $complaint->updated_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                        @endif
                        @if($complaint->status === 'resolved')
                        <div style="display:flex;align-items:center;gap:14px;">
                            <div style="width:36px;height:36px;background:#f0fdf4;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">✅</div>
                            <div>
                                <p style="font-size:13px;font-weight:600;color:#374151;">Complaint Resolved</p>
                                <p style="font-size:12px;color:#94a3b8;">{{ $complaint->updated_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Back Button -->
                <a href="{{ route('admin.complaints') }}" class="btn-outline">← Back</a>

            </div>
        </div>
    </div>
</x-app-layout>