<x-app-layout>
    <x-slot name="header">
        <div>
            <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Resident Services</p>
            <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Messages</h1>
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
                <h3 style="font-size:16px;font-weight:700;color:#0f2144;">Conversations</h3>
                <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Your message threads with barangay staff</p>
            </div>
            <a href="{{ route('messages.create') }}" class="btn-primary" style="background:linear-gradient(135deg,#7c3aed,#5b21b6);">+ New Message</a>
        </div>

        @forelse($messages as $otherId => $thread)
            @php
                $latest = $thread->last();
                $otherPerson = $latest->sender_id === auth()->id() ? $latest->receiver : $latest->sender;
            @endphp
            <a href="{{ route('messages.show', $thread->first()) }}"
               style="display:flex;align-items:center;gap:16px;padding:18px 24px;border-bottom:1px solid #f1f5f9;text-decoration:none;transition:all 0.2s;"
               onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">

                <!-- Avatar -->
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#7c3aed,#5b21b6);border-radius:14px;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:18px;flex-shrink:0;">
                    {{ strtoupper(substr($otherPerson->name, 0, 1)) }}
                </div>

                <!-- Info -->
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
                        <p style="font-weight:700;color:#0f2144;font-size:14px;">{{ $otherPerson->name }}</p>
                        <p style="font-size:12px;color:#94a3b8;flex-shrink:0;">{{ $latest->created_at->format('M d, Y') }}</p>
                    </div>
                    <p style="font-size:13px;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        @if($latest->sender_id === auth()->id())
                            <span style="color:#7c3aed;font-weight:500;">You: </span>
                        @endif
                        {{ Str::limit($latest->body, 55) }}
                    </p>
                </div>

                <!-- Arrow -->
                <div style="width:32px;height:32px;background:#f5f3ff;color:#7c3aed;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;">→</div>
            </a>
        @empty
            <div style="text-align:center;padding:60px 20px;">
                <div style="width:64px;height:64px;background:#f5f3ff;border-radius:20px;display:flex;align-items:center;justify-content:center;font-size:32px;margin:0 auto 16px;">💬</div>
                <p style="font-weight:600;color:#374151;margin-bottom:6px;">No conversations yet</p>
                <p style="font-size:13px;color:#94a3b8;margin-bottom:20px;">Start a conversation with barangay staff</p>
                <a href="{{ route('messages.create') }}" class="btn-primary" style="display:inline-flex;background:linear-gradient(135deg,#7c3aed,#5b21b6);">+ Send First Message</a>
            </div>
        @endforelse
    </div>
</x-app-layout>