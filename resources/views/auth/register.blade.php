<x-guest-layout>
    <div style="margin-bottom:32px;">
        <h2 class="font-display" style="font-size:28px;color:#0f2144;margin-bottom:8px;">Create Account</h2>
        <p style="color:#64748b;font-size:14px;">Register as a barangay resident to get started</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div style="margin-bottom:18px;">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="form-input"
                   placeholder="Enter your full name"
                   required autofocus>
            @error('name')
                <p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div style="margin-bottom:18px;">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-input"
                   placeholder="Enter your email address"
                   required>
            @error('email')
                <p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div style="margin-bottom:18px;">
            <label class="form-label">Password</label>
            <input type="password" name="password"
                   class="form-input"
                   placeholder="Create a strong password"
                   required>
            @error('password')
                <p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom:28px;">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="form-input"
                   placeholder="Confirm your password"
                   required>
            @error('password_confirmation')
                <p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-primary">
            Create My Account
        </button>

        <!-- Divider -->
        <div style="display:flex;align-items:center;gap:12px;margin:24px 0;">
            <div style="flex:1;height:1px;background:#e2e8f0;"></div>
            <span style="font-size:12px;color:#94a3b8;">Already have an account?</span>
            <div style="flex:1;height:1px;background:#e2e8f0;"></div>
        </div>

        <!-- Login Link -->
        <a href="{{ route('login') }}"
           style="display:block;text-align:center;padding:13px;border-radius:10px;border:1.5px solid #e2e8f0;font-size:14px;font-weight:600;color:#1a3a6b;text-decoration:none;transition:all 0.2s;"
           onmouseover="this.style.borderColor='#1a3a6b';this.style.background='#f0f4ff';"
           onmouseout="this.style.borderColor='#e2e8f0';this.style.background='transparent';">
            Sign In Instead
        </a>
    </form>
</x-guest-layout>