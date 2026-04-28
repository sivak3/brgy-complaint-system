<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Barangay System') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        .font-display { font-family: 'Playfair Display', serif; }
        body { min-height: 100vh; display: flex; background: #0f2144; }

        .auth-left {
            width: 45%;
            background: linear-gradient(160deg, #0f2144 0%, #1a3a6b 60%, #0f2144 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }
        .auth-left::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(201,168,76,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -80px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(201,168,76,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        .auth-right {
            width: 55%;
            background: #f0f2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .auth-card {
            background: white;
            border-radius: 24px;
            padding: 48px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.1);
        }
        .form-input {
            width: 100%;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            color: #1e293b;
            transition: all 0.2s;
            outline: none;
            background: white;
            font-family: 'DM Sans', sans-serif;
        }
        .form-input:focus { border-color: #1a3a6b; box-shadow: 0 0 0 3px rgba(26,58,107,0.1); }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px; }
        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #1a3a6b, #0f2144);
            color: white;
            padding: 14px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(15,33,68,0.35); }

        .feature-item { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 28px; }
        .feature-icon { width: 44px; height: 44px; background: rgba(201,168,76,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; border: 1px solid rgba(201,168,76,0.3); }

        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeInUp 0.5s ease forwards; }
        .fade-in-1 { animation-delay: 0.1s; opacity: 0; }
        .fade-in-2 { animation-delay: 0.2s; opacity: 0; }
        .fade-in-3 { animation-delay: 0.3s; opacity: 0; }
        .fade-in-4 { animation-delay: 0.4s; opacity: 0; }
    </style>
</head>
<body>
    <!-- Left Panel -->
    <div class="auth-left">
        <div style="position:relative;z-index:1;">
            <!-- Logo -->
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:48px;" class="fade-in fade-in-1">
                <div style="width:52px;height:52px;background:linear-gradient(135deg,#c9a84c,#a8832a);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:26px;box-shadow:0 4px 16px rgba(201,168,76,0.3);">🏛️</div>
                <div>
                    <p style="color:white;font-weight:700;font-size:18px;line-height:1.2;" class="font-display">Barangay Portal</p>
                    <p style="color:rgba(255,255,255,0.4);font-size:12px;">Official Management System</p>
                </div>
            </div>

            <!-- Headline -->
            <div class="fade-in fade-in-2" style="margin-bottom:40px;">
                <h1 class="font-display" style="color:white;font-size:36px;line-height:1.2;margin-bottom:16px;">
                    Your Voice,<br>
                    <span style="color:#c9a84c;">Our Priority</span>
                </h1>
                <p style="color:rgba(255,255,255,0.55);font-size:15px;line-height:1.7;">
                    A modern platform connecting residents with barangay officials for faster, more transparent governance.
                </p>
            </div>

            <!-- Features -->
            <div class="fade-in fade-in-3">
                <div class="feature-item">
                    <div class="feature-icon">📋</div>
                    <div>
                        <p style="color:white;font-weight:600;font-size:14px;margin-bottom:4px;">File Complaints</p>
                        <p style="color:rgba(255,255,255,0.45);font-size:13px;">Report issues and track their resolution status in real-time</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">⭐</div>
                    <div>
                        <p style="color:white;font-weight:600;font-size:14px;margin-bottom:4px;">Give Feedback</p>
                        <p style="color:rgba(255,255,255,0.45);font-size:13px;">Rate barangay services and help improve governance</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">💬</div>
                    <div>
                        <p style="color:white;font-weight:600;font-size:14px;margin-bottom:4px;">Direct Messaging</p>
                        <p style="color:rgba(255,255,255,0.45);font-size:13px;">Communicate directly with barangay officials anytime</p>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div style="border-top:1px solid rgba(255,255,255,0.1);margin-top:8px;padding-top:24px;" class="fade-in fade-in-4">
                <p style="color:rgba(255,255,255,0.3);font-size:12px;">© 2026 Barangay Complaint & Feedback Management System</p>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="auth-right">
        <div class="auth-card fade-in fade-in-2">
            {{ $slot }}
        </div>
    </div>
</body>
</html>