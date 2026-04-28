<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Resident Services</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Notifications</h1>
            </div>
            <span style="background:#f1f5f9;color:#64748b;padding:6px 16px;border-radius:20px;font-size:13px;font-weight:600;">
                {{ auth()->user()->unreadNotifications->count() }} unread
            </span>
        </div>
    </x-slot>

    <!-- Stats -->
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-bottom:24px;">
        <div class="stat-card fade-in fade-in-1" style="border-left:4px solid #1a3a6b;padding:20px;">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Total</p>
                    <p style="font-size:32px;font-weight:700;color:#0f2144;margin:6px 0;" class="font-display">{{ auth()->user()->notifications->count() }}</p>
                </div>
                <div style="width:48px;height:48px;background:#eff6ff;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🔔</div>
            </div>
        </div>
        <div class="stat-card fade-in fade-in-2" style="border-left:4px solid #ef4444;padding:20px;">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Unread</p>
                    <p style="font-size:32px;font-weight:700;color:#ef4444;margin:6px 0;" class="font-display">{{ auth()->user()->unreadNotifications->count() }}</p>
                </div>
                <div style="width:48px;height:48px;background:#fef2f2;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🔴</div>
            </div>
        </div>
    </div>

    <div class="card fade-in fade-in-2">
        <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;">
            <h3 style="font-size:16px;font-weight:700;color:#0f2144;">All Notifications</h3>
            <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Complaint updates and new messages</p>
        </div>

        <div>
            @forelse($notifications as $notification)

                @if(isset($notification->data['type']) && $notification->data['type'] === 'message')
                    {{-- Message Notification --}}
                    <a href="{{ route('messages.index') }}"
                       style="display:flex;align-items:flex-start;gap:16px;padding:20px 24px;border-bottom:1px solid #f1f5f9;text-decoration:none;transition:all 0.2s;{{ $notification->read_at ? '' : 'background:#f8faff;' }}"
                       onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='{{ $notification->read_at ? 'white' : '#f8faff' }}'">

                        <div style="width:44px;height:44px;background:linear-gradient(135deg,#7c3aed,#5b21b6);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;">💬</div>

                        <div style="flex:1;min-width:0;">
                            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:4px;">
                                <p style="font-weight:700;color:#0f2144;font-size:14px;">New Message Received</p>
                                <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
                                    @if(!$notification->read_at)
                                        <span style="width:8px;height:8px;background:#3b82f6;border-radius:50%;display:inline-block;"></span>
                                    @endif
                                    <span style="font-size:12px;color:#94a3b8;">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <p style="font-size:13px;color:#64748b;line-height:1.5;">{{ $notification->data['message'] }}</p>
                        </div>

                        <div style="background:#f5f3ff;color:#7c3aed;width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;margin-top:4px;">→</div>
                    </a>

                @else
                    {{-- Complaint Notification --}}
                    <a href="{{ route('complaints.show', $notification->data['complaint_id']) }}"
                       style="display:flex;align-items:flex-start;gap:16px;padding:20px 24px;border-bottom:1px solid #f1f5f9;text-decoration:none;transition:all 0.2s;{{ $notification->read_at ? '' : 'background:#f8faff;' }}"
                       onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='{{ $notification->read_at ? 'white' : '#f8faff' }}'">

                        <div style="width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;
                            {{ $notification->data['status'] === 'pending' ? 'background:#fffbeb;' : '' }}
                            {{ $notification->data['status'] === 'in_progress' ? 'background:#eff6ff;' : '' }}
                            {{ $notification->data['status'] === 'resolved' ? 'background:#f0fdf4;' : '' }}">
                            {{ $notification->data['status'] === 'pending' ? '⏳' : '' }}
                            {{ $notification->data['status'] === 'in_progress' ? '🔄' : '' }}
                            {{ $notification->data['status'] === 'resolved' ? '✅' : '' }}
                        </div>

                        <div style="flex:1;min-width:0;">
                            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:4px;">
                                <p style="font-weight:700;color:#0f2144;font-size:14px;">Complaint Status Updated</p>
                                <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
                                    @if(!$notification->read_at)
                                        <span style="width:8px;height:8px;background:#3b82f6;border-radius:50%;display:inline-block;"></span>
                                    @endif
                                    <span style="font-size:12px;color:#94a3b8;">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <p style="font-size:13px;color:#64748b;line-height:1.5;margin-bottom:8px;">{{ $notification->data['message'] }}</p>
                            <span class="badge-{{ $notification->data['status'] }}">
                                {{ $notification->data['status'] === 'in_progress' ? 'In Progress' : ucfirst($notification->data['status']) }}
                            </span>
                        </div>

                        <div style="background:#eff6ff;color:#1a3a6b;width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;margin-top:4px;">→</div>
                    </a>
                @endif

            @empty
                <div style="text-align:center;padding:60px 20px;">
                    <div style="font-size:48px;margin-bottom:12px;">🔔</div>
                    <p style="font-weight:600;color:#374151;margin-bottom:6px;">No notifications yet</p>
                    <p style="font-size:13px;color:#94a3b8;">You'll be notified when your complaint status changes or you receive a message</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>