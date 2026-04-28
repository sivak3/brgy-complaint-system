<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('feedbacks.index') }}" style="width:36px;height:36px;background:white;border:1px solid #e8ecf4;border-radius:10px;display:flex;align-items:center;justify-content:center;text-decoration:none;color:#64748b;font-size:18px;transition:all 0.2s;" onmouseover="this.style.borderColor='#1a3a6b';this.style.color='#1a3a6b'" onmouseout="this.style.borderColor='#e8ecf4';this.style.color='#64748b'">←</a>
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Resident Services</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Feedback Details</h1>
            </div>
        </div>
    </x-slot>

    <div style="max-width:700px;">

        <!-- Rating Banner -->
        <div class="fade-in fade-in-1" style="background:linear-gradient(135deg,#c9a84c,#a8832a);border-radius:16px;padding:28px;margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <p style="color:rgba(255,255,255,0.7);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;">Your Rating</p>
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="display:flex;gap:4px;">
                        @for($i = 1; $i <= 5; $i++)
                            <span style="font-size:28px;color:{{ $i <= $feedback->rating ? 'white' : 'rgba(255,255,255,0.3)' }};">★</span>
                        @endfor
                    </div>
                    <span style="color:white;font-size:24px;font-weight:700;" class="font-display">{{ $feedback->rating }}/5</span>
                </div>
            </div>
            <div style="font-size:60px;opacity:0.2;">⭐</div>
        </div>

        <div class="card fade-in fade-in-2" style="overflow:hidden;">
            <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;">
                <h2 style="font-size:20px;font-weight:700;color:#0f2144;" class="font-display">{{ $feedback->subject }}</h2>
                <p style="font-size:13px;color:#94a3b8;margin-top:6px;">Submitted on {{ $feedback->created_at->format('M d, Y h:i A') }}</p>
            </div>

            <div style="padding:28px;">
                <!-- Message -->
                <div style="background:#f8fafc;border-radius:12px;padding:20px;margin-bottom:20px;">
                    <p style="font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Your Message</p>
                    <p style="color:#374151;font-size:14px;line-height:1.8;">{{ $feedback->message }}</p>
                </div>

                <!-- Details -->
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;">
                    <div style="background:#f8fafc;border-radius:12px;padding:18px;">
                        <p style="font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Submitted By</p>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="avatar" style="background:linear-gradient(135deg,#c9a84c,#a8832a);color:white;">
                                {{ strtoupper(substr($feedback->user->name, 0, 1)) }}
                            </div>
                            <p style="font-size:14px;font-weight:600;color:#374151;">{{ $feedback->user->name }}</p>
                        </div>
                    </div>
                    <div style="background:#f8fafc;border-radius:12px;padding:18px;">
                        <p style="font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Date Submitted</p>
                        <p style="font-size:14px;font-weight:600;color:#374151;">{{ $feedback->created_at->format('M d, Y') }}</p>
                        <p style="font-size:12px;color:#94a3b8;">{{ $feedback->created_at->format('h:i A') }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div style="display:flex;gap:12px;">
                    <a href="{{ route('feedbacks.index') }}" class="btn-outline">← Back</a>
                    <a href="{{ route('feedbacks.create') }}" class="btn-gold">+ New Feedback</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>