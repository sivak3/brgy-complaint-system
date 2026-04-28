<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('feedbacks.index') }}" style="width:36px;height:36px;background:white;border:1px solid #e8ecf4;border-radius:10px;display:flex;align-items:center;justify-content:center;text-decoration:none;color:#64748b;font-size:18px;transition:all 0.2s;" onmouseover="this.style.borderColor='#1a3a6b';this.style.color='#1a3a6b'" onmouseout="this.style.borderColor='#e8ecf4';this.style.color='#64748b'">←</a>
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Resident Services</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">Give Feedback</h1>
            </div>
        </div>
    </x-slot>

    <div style="max-width:700px;">
        <div class="card fade-in fade-in-1" style="overflow:hidden;">
            <div style="background:linear-gradient(135deg,#c9a84c,#a8832a);padding:24px 28px;">
                <h3 style="color:white;font-size:16px;font-weight:600;">⭐ Feedback Form</h3>
                <p style="color:rgba(255,255,255,0.7);font-size:13px;margin-top:4px;">Share your experience with barangay services</p>
            </div>
            <div style="padding:32px 28px;">
                <form method="POST" action="{{ route('feedbacks.store') }}">
                    @csrf

                    <div style="margin-bottom:22px;">
                        <label class="form-label">Subject <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="subject" value="{{ old('subject') }}"
                               class="form-input" placeholder="What is your feedback about?" required>
                        @error('subject')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="margin-bottom:22px;">
                        <label class="form-label">Rating <span style="color:#ef4444;">*</span></label>
                        <div style="display:flex;gap:8px;margin-top:4px;">
                            @for($i = 1; $i <= 5; $i++)
                            <label style="cursor:pointer;text-align:center;">
                                <input type="radio" name="rating" value="{{ $i }}"
                                       {{ old('rating') == $i ? 'checked' : '' }}
                                       style="display:none;" required
                                       onchange="updateStars({{ $i }})">
                                <span id="star-{{ $i }}" style="font-size:36px;color:#e2e8f0;transition:all 0.15s;display:block;">★</span>
                                <span style="font-size:11px;color:#94a3b8;font-weight:500;">{{ $i }}</span>
                            </label>
                            @endfor
                        </div>
                        @error('rating')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="margin-bottom:28px;">
                        <label class="form-label">Message <span style="color:#ef4444;">*</span></label>
                        <textarea name="message" rows="5" class="form-input"
                                  placeholder="Write your feedback here..." required>{{ old('message') }}</textarea>
                        @error('message')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:flex;gap:12px;">
                        <button type="submit" class="btn-gold">Submit Feedback</button>
                        <a href="{{ route('feedbacks.index') }}" class="btn-outline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateStars(rating) {
            for (let i = 1; i <= 5; i++) {
                const star = document.getElementById('star-' + i);
                star.style.color = i <= rating ? '#c9a84c' : '#e2e8f0';
                star.style.transform = i <= rating ? 'scale(1.2)' : 'scale(1)';
            }
        }
        // Set initial stars if old value exists
        const checked = document.querySelector('input[name="rating"]:checked');
        if (checked) updateStars(parseInt(checked.value));
    </script>
</x-app-layout>