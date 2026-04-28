<x-guest-layout>
    <div style="margin-bottom:32px;">
        <h2 class="font-display" style="font-size:28px;color:#0f2144;margin-bottom:8px;">Welcome Back</h2>
        <p style="color:#64748b;font-size:14px;">Sign in to your barangay portal account</p>
    </div>

    <x-auth-session-status style="margin-bottom:16px;" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div style="margin-bottom:20px;">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-input"
                   placeholder="Enter your email address"
                   required autofocus>
            @error('email')
                <p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div style="margin-bottom:20px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                <label class="form-label" style="margin-bottom:0;">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       style="font-size:12px;color:#1a3a6b;text-decoration:none;font-weight:500;">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input type="password" name="password"
                   class="form-input"
                   placeholder="Enter your password"
                   required>
            @error('password')
                <p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:28px;">
            <input type="checkbox" name="remember" id="remember"
                   style="width:16px;height:16px;accent-color:#1a3a6b;">
            <label for="remember" style="font-size:13px;color:#64748b;cursor:pointer;">Remember me for 30 days</label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-primary">
            Sign In to Portal
        </button>

        <!-- Divider -->
        <div style="display:flex;align-items:center;gap:12px;margin:24px 0;">
            <div style="flex:1;height:1px;background:#e2e8f0;"></div>
            <span style="font-size:12px;color:#94a3b8;">Don't have an account?</span>
            <div style="flex:1;height:1px;background:#e2e8f0;"></div>
        </div>

        <!-- Register Link -->
        <a href="{{ route('register') }}"
           style="display:block;text-align:center;padding:13px;border-radius:10px;border:1.5px solid #e2e8f0;font-size:14px;font-weight:600;color:#1a3a6b;text-decoration:none;transition:all 0.2s;"
           onmouseover="this.style.borderColor='#1a3a6b';this.style.background='#f0f4ff';"
           onmouseout="this.style.borderColor='#e2e8f0';this.style.background='transparent';">
            Create Resident Account
        </a>
    </form>
</x-guest-layout>