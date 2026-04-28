<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('messages.index') }}" style="width:36px;height:36px;background:white;border:1px solid #e8ecf4;border-radius:10px;display:flex;align-items:center;justify-content:center;text-decoration:none;color:#64748b;font-size:18px;transition:all 0.2s;" onmouseover="this.style.borderColor='#1a3a6b';this.style.color='#1a3a6b'" onmouseout="this.style.borderColor='#e8ecf4';this.style.color='#64748b'">←</a>
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Resident Services</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">New Message</h1>
            </div>
        </div>
    </x-slot>

    <div style="max-width:700px;">
        <div class="card fade-in fade-in-1" style="overflow:hidden;">
            <div style="background:linear-gradient(135deg,#7c3aed,#5b21b6);padding:24px 28px;">
                <h3 style="color:white;font-size:16px;font-weight:600;">💬 Compose Message</h3>
                <p style="color:rgba(255,255,255,0.6);font-size:13px;margin-top:4px;">Send a message directly to barangay staff</p>
            </div>
            <div style="padding:32px 28px;">
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf

                    <div style="margin-bottom:22px;">
                        <label class="form-label">Send To <span style="color:#ef4444;">*</span></label>
                        <select name="receiver_id" class="form-input" required>
                            <option value="">-- Select Recipient --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('receiver_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} {{ $user->hasRole('admin') ? '(Admin)' : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('receiver_id')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="margin-bottom:28px;">
                        <label class="form-label">Message <span style="color:#ef4444;">*</span></label>
                        <textarea name="body" rows="6" class="form-input"
                                  placeholder="Type your message here..." required>{{ old('body') }}</textarea>
                        @error('body')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:flex;gap:12px;">
                        <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#7c3aed,#5b21b6);">Send Message ➤</button>
                        <a href="{{ route('messages.index') }}" class="btn-outline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>