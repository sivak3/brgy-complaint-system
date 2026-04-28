<x-app-layout>
    <x-slot name="header">
        <div>
            <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Administration</p>
            <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Resident Messages</h1>
        </div>
    </x-slot>

    <div class="card fade-in fade-in-1">
        <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <h3 style="font-size:16px;font-weight:700;color:#0f2144;">All Conversations</h3>
                <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Click any conversation to view and reply</p>
            </div>
            <a href="{{ route('messages.create') }}" class="btn-primary"
               style="background:linear-gradient(135deg,#1a3a6b,#0f2144);">
               + Message a Resident
            </a>
        </div>

        @forelse($messages as $residentId => $thread)
            @php
                $latest   = $thread->sortByDesc('created_at')->first();
                $resident = $latest->sender->hasRole('admin')
                            ? $latest->receiver
                            : $latest->sender;
                $unread   = $thread->where('is_read', false)
                                   ->where('receiver_id', auth()->id())
                                   ->count();
            @endphp
            <a href="{{ route('messages.show', $thread->first()) }}"
               style="display:flex;align-items:center;gap:16px;padding:18px 24px;border-bottom:1px solid #f1f5f9;text-decoration:none;transition:all 0.2s;"
               onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">

                <!-- Avatar -->
                <div style="position:relative;flex-shrink:0;">
                    <div style="width:44px;height:44px;background:linear-gradient(135deg,#1a3a6b,#0f2144);border-radius:12px;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:16px;">
                        {{ strtoupper(substr($resident->name, 0, 1)) }}
                    </div>
                    @if($unread > 0)
                        <div style="position:absolute;top:-4px;right:-4px;width:18px;height:18px;background:#ef4444;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:10px;font-weight:700;border:2px solid white;">
                            {{ $unread }}
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
                        <p style="font-weight:700;color:#0f2144;font-size:14px;">
                            {{ $resident->name }}
                            <span style="font-size:11px;color:#7c3aed;font-weight:500;margin-left:6px;background:#f5f3ff;padding:2px 8px;border-radius:20px;">Resident</span>
                        </p>
                        <p style="font-size:12px;color:#94a3b8;">{{ $latest->created_at->format('M d, Y') }}</p>
                    </div>
                    <p style="font-size:13px;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        <span style="font-weight:500;color:#374151;">
                            {{ $latest->sender_id === auth()->id() ? 'You' : $resident->name }}:
                        </span>
                        {{ Str::limit($latest->body, 50) }}
                    </p>
                    <p style="font-size:11px;color:#94a3b8;margin-top:4px;">{{ $thread->count() }} message(s)</p>
                </div>

                <!-- Arrow / Unread -->
                <div style="background:#eff6ff;color:#1a3a6b;width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;">
                    {{ $unread > 0 ? '🔵' : '→' }}
                </div>
            </a>
        @empty
            <div style="text-align:center;padding:60px 20px;">
                <div style="font-size:48px;margin-bottom:12px;">💬</div>
                <p style="font-weight:600;color:#374151;margin-bottom:6px;">No messages yet</p>
                <p style="font-size:13px;color:#94a3b8;">Resident messages will appear here</p>
            </div>
        @endforelse
    </div>
</x-app-layout>