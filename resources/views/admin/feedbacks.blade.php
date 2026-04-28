<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Administration</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">View Feedbacks</h1>
            </div>
            
        </div>
    </x-slot>

    <!-- Average Rating -->
    <div class="fade-in fade-in-1" style="background:linear-gradient(135deg,#c9a84c,#a8832a);border-radius:20px;padding:28px 32px;margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;">
        <div>
            <p style="color:rgba(255,255,255,0.7);font-size:13px;margin-bottom:8px;">Overall Rating</p>
            <div style="display:flex;align-items:center;gap:12px;">
                <p style="color:white;font-size:40px;font-weight:700;" class="font-display">
                    {{ $feedbacks->count() > 0 ? number_format($feedbacks->avg('rating'), 1) : '0.0' }}
                </p>
                <div>
                    <div style="display:flex;gap:3px;">
                        @php $avg = $feedbacks->count() > 0 ? round($feedbacks->avg('rating')) : 0; @endphp
                        @for($i = 1; $i <= 5; $i++)
                            <span style="font-size:24px;color:{{ $i <= $avg ? 'white' : 'rgba(255,255,255,0.3)' }};">★</span>
                        @endfor
                    </div>
                    <p style="color:rgba(255,255,255,0.6);font-size:13px;">{{ $feedbacks->count() }} total feedbacks</p>
                </div>
            </div>
        </div>
        <div style="font-size:70px;opacity:0.2;">⭐</div>
    </div>

    <div class="card fade-in fade-in-2">
        <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;">
            <h3 style="font-size:16px;font-weight:700;color:#0f2144;">All Resident Feedbacks</h3>
            <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Ratings and messages from barangay residents</p>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Resident</th>
                    <th>Subject</th>
                    <th>Rating</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $index => $feedback)
                <tr>
                    <td style="color:#94a3b8;font-size:13px;">{{ $index + 1 }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="avatar" style="background:#fffbeb;color:#a8832a;font-size:12px;">{{ strtoupper(substr($feedback->user->name,0,1)) }}</div>
                            <span style="font-weight:500;font-size:14px;">{{ $feedback->user->name }}</span>
                        </div>
                    </td>
                    <td style="font-weight:600;color:#0f2144;">{{ $feedback->subject }}</td>
                    <td>
                        <div style="display:flex;gap:2px;">
                            @for($i = 1; $i <= 5; $i++)
                                <span style="color:{{ $i <= $feedback->rating ? '#c9a84c' : '#e2e8f0' }};font-size:16px;">★</span>
                            @endfor
                        </div>
                    </td>
                    <td style="color:#64748b;font-size:13px;">{{ Str::limit($feedback->message, 55) }}</td>
                    <td style="color:#94a3b8;font-size:13px;">{{ $feedback->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:60px;color:#94a3b8;">
                        <div style="font-size:48px;margin-bottom:12px;">⭐</div>
                        <p style="font-weight:600;">No feedbacks yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>