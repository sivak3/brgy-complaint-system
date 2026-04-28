<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('messages.index') }}" style="width:36px;height:36px;background:white;border:1px solid #e8ecf4;border-radius:10px;display:flex;align-items:center;justify-content:center;text-decoration:none;color:#64748b;font-size:18px;transition:all 0.2s;" onmouseover="this.style.borderColor='#1a3a6b';this.style.color='#1a3a6b'" onmouseout="this.style.borderColor='#e8ecf4';this.style.color='#64748b'">←</a>
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:38px;height:38px;background:linear-gradient(135deg,#7c3aed,#5b21b6);border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:15px;">
                    {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                </div>
                <div>
                    <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Conversation</p>
                    <h1 class="font-display" style="font-size:20px;color:#0f2144;margin-top:1px;">{{ $otherUser->name }}</h1>
                </div>
            </div>
        </div>
    </x-slot>

    <div style="max-width:700px;">

        @if(session('success'))
            <div class="fade-in fade-in-1" style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:14px 20px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#15803d;font-size:14px;font-weight:500;">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <!-- Thread Card -->
        <div class="card fade-in fade-in-1" style="overflow:hidden;margin-bottom:16px;">
            <div style="background:linear-gradient(135deg,#7c3aed,#5b21b6);padding:16px 24px;display:flex;justify-content:space-between;align-items:center;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;background:rgba(255,255,255,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;">
                        {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                    </div>
                    <div>
                        <p style="color:white;font-weight:600;font-size:14px;">{{ $otherUser->name }}</p>
                        <p style="color:rgba(255,255,255,0.5);font-size:12px;">{{ $thread->count() }} message(s)</p>
                    </div>
                </div>
            </div>

            <!-- Messages Thread -->
            <div style="padding:24px;display:flex;flex-direction:column;gap:16px;max-height:420px;overflow-y:auto;" id="message-thread">
                @foreach($thread as $msg)
                    @if($msg->sender_id === auth()->id())
                        <!-- Sent -->
                        <div style="display:flex;justify-content:flex-end;">
                            <div style="max-width:75%;">
                                <div style="background:linear-gradient(135deg,#7c3aed,#5b21b6);color:white;border-radius:16px;border-bottom-right-radius:4px;padding:12px 16px;">
                                    <p style="font-size:14px;line-height:1.6;">{{ $msg->body }}</p>
                                </div>
                                <p style="font-size:11px;color:#94a3b8;margin-top:4px;text-align:right;">
                                    {{ $msg->created_at->format('M d, h:i A') }}
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- Received -->
                        <div style="display:flex;justify-content:flex-start;gap:10px;">
                            <div style="width:32px;height:32px;background:#f1f5f9;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#64748b;font-weight:700;font-size:13px;flex-shrink:0;margin-top:4px;">
                                {{ strtoupper(substr($msg->sender->name, 0, 1)) }}
                            </div>
                            <div style="max-width:75%;">
                                <div style="background:#f1f5f9;color:#374151;border-radius:16px;border-bottom-left-radius:4px;padding:12px 16px;">
                                    <p style="font-size:14px;line-height:1.6;">{{ $msg->body }}</p>
                                </div>
                                <p style="font-size:11px;color:#94a3b8;margin-top:4px;">
                                    {{ $msg->created_at->format('M d, h:i A') }}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Reply Box -->
        <div class="card fade-in fade-in-2" style="overflow:hidden;">
            <div style="padding:16px 24px;border-bottom:1px solid #f1f5f9;">
                <p style="font-size:13px;font-weight:600;color:#374151;">↩ Reply to {{ $otherUser->name }}</p>
            </div>
            <div style="padding:20px 24px;">
                <form method="POST" action="{{ route('messages.reply', $thread->first()) }}">
                    @csrf
                    <textarea name="body" rows="3"
                              style="width:100%;border:1.5px solid #e2e8f0;border-radius:10px;padding:12px 16px;font-size:14px;color:#1e293b;transition:all 0.2s;outline:none;resize:none;font-family:'DM Sans',sans-serif;"
                              onfocus="this.style.borderColor='#7c3aed';this.style.boxShadow='0 0 0 3px rgba(124,58,237,0.1)'"
                              onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'"
                              placeholder="Type your reply...">{{ old('body') }}</textarea>
                    @error('body')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;">
                        <a href="{{ route('messages.index') }}" style="font-size:13px;color:#64748b;text-decoration:none;font-weight:500;">← Back to Messages</a>
                        <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#7c3aed,#5b21b6);padding:10px 24px;">
                            Send Reply ➤
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const thread = document.getElementById('message-thread');
        if (thread) thread.scrollTop = thread.scrollHeight;
    </script>
</x-app-layout>