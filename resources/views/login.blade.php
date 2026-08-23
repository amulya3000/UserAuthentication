<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — System Workspace Hub</title>
    <meta name="description" content="Sign in to your System Workspace Hub account.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg:      #060c1a;
            --surface: #0d1528;
            --card:    #111827;
            --border:  rgba(255,255,255,0.08);
            --border2: rgba(255,255,255,0.14);
            --text:    #f1f5f9;
            --muted:   #94a3b8;
            --accent:  #10b981;
            --accent2: #34d399;
            --green:   #10b981;
            --red:     #ef4444;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
        }

        /* ── ANIMATED BACKGROUND ── */
        .bg-glow {
            position: fixed; inset: 0; pointer-events: none; overflow: hidden;
        }
        .glow-orb {
            position: absolute; border-radius: 50%;
            filter: blur(80px); opacity: 0.35;
            animation: drift 12s ease-in-out infinite alternate;
        }
        .glow-orb:nth-child(1) { width: 400px; height: 400px; background: #10b981; top: -100px; left: -100px; animation-delay: 0s; }
        .glow-orb:nth-child(2) { width: 300px; height: 300px; background: #047857; bottom: -80px; right: 0px; animation-delay: -4s; }
        .glow-orb:nth-child(3) { width: 200px; height: 200px; background: #06b6d4; top: 40%; right: 20%; animation-delay: -8s; opacity: 0.2; }
        @keyframes drift { 0% { transform: translate(0,0) scale(1); } 100% { transform: translate(40px, 40px) scale(1.1); } }

        /* ── GRID OVERLAY ── */
        .bg-grid {
            position: fixed; inset: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* ── CARD ── */
        .card-wrap {
            position: relative; z-index: 10;
            width: 100%; max-width: 420px;
            margin: 0 20px;
            animation: fadeUp 0.5s ease both;
        }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .card {
            background: rgba(17, 24, 39, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border2);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.06);
        }

        /* ── BRAND ── */
        .brand { display: flex; align-items: center; gap: 10px; margin-bottom: 28px; justify-content: center; }
        .brand-icon {
            width: 40px; height: 40px; border-radius: 12px;
            background: linear-gradient(135deg, #10b981, #047857);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 20px rgba(16,185,129,0.5);
        }
        .brand-icon svg { width: 20px; height: 20px; color: #fff; }
        .brand-name { font-size: 18px; font-weight: 800; letter-spacing: -0.4px; }

        .card-title { font-size: 24px; font-weight: 800; letter-spacing: -0.5px; text-align: center; margin-bottom: 6px; }
        .card-sub { font-size: 14px; color: var(--muted); text-align: center; margin-bottom: 28px; }

        /* ── ERRORS ── */
        .alert-error {
            background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25);
            border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
            font-size: 13px; color: #fca5a5;
        }
        .alert-error ul { margin: 0; padding-left: 18px; }
        .alert-success {
            background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.25);
            border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
            font-size: 13px; color: #6ee7b7;
        }

        /* ── FORM ── */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block; font-size: 12px; font-weight: 600;
            color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em;
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%; padding: 12px 16px;
            background: rgba(255,255,255,0.04); border: 1px solid var(--border2);
            border-radius: 10px; color: var(--text); font-size: 14px;
            font-family: 'Inter', sans-serif; transition: all 0.2s; outline: none;
        }
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(16,185,129,0.18);
            background: rgba(16,185,129,0.05);
        }
        .form-control::placeholder { color: rgba(148,163,184,0.4); }

        .remember-row {
            display: flex; align-items: center; gap: 8px; margin-bottom: 22px;
        }
        .remember-row input { width: 16px; height: 16px; accent-color: var(--accent); cursor: pointer; }
        .remember-row label { font-size: 13px; color: var(--muted); cursor: pointer; }

        .btn-submit {
            width: 100%; padding: 13px;
            background: linear-gradient(135deg, #10b981, #047857);
            color: #fff; font-size: 14px; font-weight: 700;
            border: none; border-radius: 10px; cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 8px 24px rgba(16,185,129,0.35);
            position: relative; overflow: hidden;
        }
        .btn-submit::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
            opacity: 0; transition: opacity 0.2s;
        }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 12px 30px rgba(16,185,129,0.45); }
        .btn-submit:hover::after { opacity: 1; }
        .btn-submit:active { transform: translateY(0); }

        .card-footer {
            margin-top: 22px; text-align: center;
            font-size: 13px; color: var(--muted);
        }
        .card-footer a { color: var(--accent2); font-weight: 600; text-decoration: none; transition: color 0.2s; }
        .card-footer a:hover { color: #fff; }

        /* ── DIVIDER ── */
        .divider { display: flex; align-items: center; gap: 12px; margin: 20px 0; }
        .divider-line { flex: 1; height: 1px; background: var(--border); }
        .divider-text { font-size: 11px; color: var(--muted); }
    </style>
</head>
<body>
    <div class="bg-glow">
        <div class="glow-orb"></div>
        <div class="glow-orb"></div>
        <div class="glow-orb"></div>
    </div>
    <div class="bg-grid"></div>

    <div class="card-wrap">
        <div class="card">
            <div class="brand">
                <div class="brand-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                </div>
                <span class="brand-name">System Workspace Hub</span>
            </div>

            <h1 class="card-title">Welcome back</h1>
            <p class="card-sub">Sign in to your workspace account</p>

            @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('loginMatch') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="useremail" class="form-label">Email address</label>
                    <input type="email" name="email" id="useremail" class="form-control"
                           value="{{ old('email') }}" required autofocus placeholder="you@company.com">
                </div>
                <div class="form-group">
                    <label for="userpassword" class="form-label">Password</label>
                    <input type="password" name="password" id="userpassword" class="form-control"
                           required placeholder="Your password">
                </div>
                <div class="remember-row">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me for 30 days</label>
                </div>
                <button type="submit" class="btn-submit">Sign In →</button>
            </form>

            <div class="card-footer">
                Don't have an account? <a href="{{ route('register') }}">Create one</a>
            </div>
        </div>
    </div>
</body>
</html>