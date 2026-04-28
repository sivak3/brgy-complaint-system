<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Administration</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Resident Messages</h1>
            </div>
           
        </div>
    </x-slot>

    <div class="card fade-in fade-in-1">
        <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;">
            <h3 style="font-size:16px;font-weight:700;color:#0f2144;">All Conversations</h3>
            <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Click any conversation to view and reply</p>
        </div>

        @forelse($messages as $key => $thread)
            @php
                $latest = $thread->last();
                $sender = $latest->sender;
                $receiver = $latest->receiver;
            @endphp
            <a href="{{ route('messages.show', $thread->first()) }}"
               style="display:flex;align-items:center;gap:16px;padding:18px 24px;border-bottom:1px solid #f1f5f9;text-decoration:none;transition:all 0.2s;"
               onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">

                <!-- Overlapping Avatars -->
                <div style="display:flex;position:relative;width:52px;height:36px;flex-shrink:0;">
                    <div style="width:36px;height:36px;background:linear-gradient(135deg,#1a3a6b,#0f2144);border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;position:absolute;left:0;z-index:2;border:2px solid white;">
                        {{ strtoupper(substr($sender->name, 0, 1)) }}
                    </div>
                    <div style="width:36px;height:36px;background:linear-gradient(135deg,#7c3aed,#5b21b6);border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;position:absolute;left:16px;z-index:1;border:2px solid white;">
                        {{ strtoupper(substr($receiver->name, 0, 1)) }}
                    </div>
                </div>

                <!-- Info -->
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
                        <p style="font-weight:700;color:#0f2144;font-size:14px;">
                            {{ $sender->name }}
                            <span style="color:#94a3b8;font-weight:400;font-size:13px;">↔</span>
                            {{ $receiver->name }}
                        </p>
                        <p style="font-size:12px;color:#94a3b8;">{{ $latest->created_at->format('M d, Y') }}</p>
                    </div>
                    <p style="font-size:13px;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        <span style="font-weight:500;color:#374151;">{{ $latest->sender->name }}:</span>
                        {{ Str::limit($latest->body, 55) }}
                    </p>
                    <p style="font-size:11px;color:#94a3b8;margin-top:4px;">{{ $thread->count() }} message(s)</p>
                </div>

                <!-- Arrow -->
                <div style="background:#eff6ff;color:#1a3a6b;width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;">→</div>
            </a>
        @empty
            <div style="text-align:center;padding:60px 20px;">
                <div style="font-size:48px;margin-bottom:12px;">💬</div>
                <p style="font-weight:600;color:#374151;margin-bottom:6px;">No messages yet</p>
                <p style="font-size:13px;color:#94a3b8;">Messages between residents will appear here</p>
            </div>
        @endforelse
    </div>
</x-app-layout>