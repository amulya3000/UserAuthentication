<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — System Workspace Hub</title>
    <meta name="description" content="Register a new account on the System Workspace Hub.">
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
        html, body { min-height: 100%; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .bg-glow { position: fixed; inset: 0; pointer-events: none; overflow: hidden; z-index: 0; }
        .glow-orb { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.3; animation: drift 14s ease-in-out infinite alternate; }
        .glow-orb:nth-child(1) { width: 450px; height: 450px; background: #047857; top: -100px; right: -120px; animation-delay: 0s; }
        .glow-orb:nth-child(2) { width: 350px; height: 350px; background: #10b981; bottom: -100px; left: -80px; animation-delay: -5s; }
        .glow-orb:nth-child(3) { width: 200px; height: 200px; background: #06b6d4; top: 30%; left: 15%; animation-delay: -9s; opacity: 0.2; }
        @keyframes drift { 0% { transform: translate(0,0) scale(1); } 100% { transform: translate(30px,30px) scale(1.1); } }
        .bg-grid {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background-image: linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .card-wrap {
            position: relative; z-index: 10;
            width: 100%; max-width: 440px;
            animation: fadeUp 0.5s ease both;
        }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .card {
            background: rgba(17, 24, 39, 0.88);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border2);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.45), inset 0 1px 0 rgba(255,255,255,0.06);
        }

        .brand { display: flex; align-items: center; gap: 10px; margin-bottom: 24px; justify-content: center; }
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

        .alert-error {
            background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25);
            border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
            font-size: 13px; color: #fca5a5;
        }
        .alert-error ul { margin: 0; padding-left: 18px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-group { margin-bottom: 16px; }
        .form-label {
            display: block; font-size: 12px; font-weight: 600;
            color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em;
            margin-bottom: 7px;
        }
        .form-control {
            width: 100%; padding: 11px 14px;
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
        select.form-control option { background: #111827; color: var(--text); }

        /* Role selector pills */
        .role-pills { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .role-pill { position: relative; }
        .role-pill input { position: absolute; opacity: 0; width: 0; height: 0; }
        .role-pill label {
            display: flex; flex-direction: column; align-items: center; gap: 6px;
            padding: 14px 10px; border: 1.5px solid var(--border2);
            border-radius: 12px; cursor: pointer; transition: all 0.2s;
            font-size: 13px; font-weight: 600; color: var(--muted);
        }
        .role-pill label svg { width: 20px; height: 20px; }
        .role-pill input:checked + label {
            border-color: var(--accent);
            background: rgba(16,185,129,0.12);
            color: var(--accent2);
            box-shadow: 0 0 0 3px rgba(16,185,129,0.12);
        }
        .role-pill label:hover { border-color: rgba(16,185,129,0.4); color: var(--text); }

        .btn-submit {
            width: 100%; padding: 13px; margin-top: 4px;
            background: linear-gradient(135deg, #10b981, #047857);
            color: #fff; font-size: 14px; font-weight: 700;
            border: none; border-radius: 10px; cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 8px 24px rgba(16,185,129,0.35);
        }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 12px 30px rgba(16,185,129,0.45); }
        .btn-submit:active { transform: translateY(0); }

        .pending-notice {
            background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.2);
            border-radius: 10px; padding: 11px 14px; margin-top: 16px;
            font-size: 12px; color: #fbbf24; display: flex; gap: 8px; align-items: flex-start;
        }
        .pending-notice svg { width: 14px; height: 14px; flex-shrink: 0; margin-top: 1px; }

        .card-footer {
            margin-top: 20px; text-align: center;
            font-size: 13px; color: var(--muted);
        }
        .card-footer a { color: var(--accent2); font-weight: 600; text-decoration: none; transition: color 0.2s; }
        .card-footer a:hover { color: #fff; }
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

            <h1 class="card-title">Create an account</h1>
            <p class="card-sub">Join your team's workspace</p>

            @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('registerSave') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="username" class="form-label">Full Name</label>
                        <input type="text" name="name" id="username" class="form-control"
                               value="{{ old('name') }}" required placeholder="Jane Smith">
                    </div>
                    <div class="form-group">
                        <label for="userage" class="form-label">Age</label>
                        <input type="number" name="age" id="userage" class="form-control"
                               value="{{ old('age') }}" required placeholder="25" min="16" max="120">
                    </div>
                </div>

                <div class="form-group">
                    <label for="useremail" class="form-label">Email address</label>
                    <input type="email" name="email" id="useremail" class="form-control"
                           value="{{ old('email') }}" required placeholder="you@company.com">
                </div>

                <div class="form-group">
                    <label class="form-label">Select Role</label>
                    <div class="role-pills">
                        <div class="role-pill">
                            <input type="radio" name="role" id="role-employee" value="employee"
                                   {{ old('role','employee') === 'employee' ? 'checked' : '' }}>
                            <label for="role-employee">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Employee
                            </label>
                        </div>
                        <div class="role-pill">
                            <input type="radio" name="role" id="role-admin" value="admin"
                                   {{ old('role') === 'admin' ? 'checked' : '' }}>
                            <label for="role-admin">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                Admin
                            </label>
                        </div>
                        <div class="role-pill">
                            <input type="radio" name="role" id="role-superadmin" value="super_admin"
                                   {{ old('role') === 'super_admin' ? 'checked' : '' }}>
                            <label for="role-superadmin">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/></svg>
                                Super Admin
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="userpassword" class="form-label">Password</label>
                    <input type="password" name="password" id="userpassword" class="form-control"
                           required placeholder="Min. 8 characters">
                </div>
                <div class="form-group">
                    <label for="userpassword-confirm" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="userpassword-confirm" class="form-control"
                           required placeholder="Repeat your password">
                </div>

                <button type="submit" class="btn-submit">Create Account →</button>
            </form>

            <div class="pending-notice">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Employee accounts require admin approval before you can sign in.
            </div>

            <div class="card-footer">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </div>
    </div>
</body>
</html>