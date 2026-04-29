<x-app-layout>
    <x-slot name="header">
        <div>
            <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Resident Services</p>
            <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">My Feedbacks</h1>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="fade-in fade-in-1" style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:14px 20px;margin-bottom:24px;display:flex;align-items:center;gap:10px;color:#15803d;font-size:14px;font-weight:500;">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif

    <!-- Stats Row -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
        <div class="stat-card fade-in fade-in-1" style="border-left:4px solid #c9a84c;padding:20px;">
            <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Total Feedbacks</p>
            <p style="font-size:28px;font-weight:700;color:#0f2144;margin:4px 0;" class="font-display">{{ $feedbacks->count() }}</p>
        </div>
        <div class="stat-card fade-in fade-in-2" style="border-left:4px solid #10b981;padding:20px;">
            <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Average Rating</p>
            <p style="font-size:28px;font-weight:700;color:#10b981;margin:4px 0;" class="font-display">
                {{ $feedbacks->count() > 0 ? number_format($feedbacks->avg('rating'), 1) : '0.0' }}
            </p>
        </div>
        <div class="stat-card fade-in fade-in-3" style="border-left:4px solid #1a3a6b;padding:20px;">
            <p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">5 Star Ratings</p>
            <p style="font-size:28px;font-weight:700;color:#1a3a6b;margin:4px 0;" class="font-display">
                {{ $feedbacks->where('rating', 5)->count() }}
            </p>
        </div>
    </div>

    <div class="card fade-in fade-in-1">
        <div style="padding:24px 28px;border-bottom:1px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <h3 style="font-size:16px;font-weight:700;color:#0f2144;">All My Feedbacks</h3>
                <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Your submitted feedback to the barangay</p>
            </div>
            <a href="{{ route('feedbacks.create') }}" class="btn-gold">+ New Feedback</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Rating</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $index => $feedback)
                <tr>
                    <td style="color:#94a3b8;font-size:13px;">{{ $index + 1 }}</td>
                    <td style="font-weight:600;color:#0f2144;">{{ $feedback->subject }}</td>
                    <td>
                        <div style="display:flex;gap:2px;">
                            @for($i = 1; $i <= 5; $i++)
                                <span style="color:{{ $i <= $feedback->rating ? '#c9a84c' : '#e2e8f0' }};font-size:16px;">★</span>
                            @endfor
                        </div>
                    </td>
                    <td style="color:#64748b;font-size:13px;">{{ Str::limit($feedback->message, 50) }}</td>
                    <td style="color:#94a3b8;font-size:13px;">{{ $feedback->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('feedbacks.show', $feedback) }}"
                           style="background:#fffbeb;color:#a8832a;padding:6px 14px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;transition:all 0.2s;"
                           onmouseover="this.style.background='#c9a84c';this.style.color='white'"
                           onmouseout="this.style.background='#fffbeb';this.style.color='#a8832a'">
                            View →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:60px 20px;">
                        <div style="width:64px;height:64px;background:#fffbeb;border-radius:20px;display:flex;align-items:center;justify-content:center;font-size:32px;margin:0 auto 16px;">⭐</div>
                        <p style="font-weight:600;color:#374151;margin-bottom:6px;">No feedbacks yet</p>
                        <p style="font-size:13px;color:#94a3b8;margin-bottom:20px;">Share your experience with the barangay</p>
                        <a href="{{ route('feedbacks.create') }}" class="btn-gold" style="display:inline-flex;">+ Give Feedback</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>