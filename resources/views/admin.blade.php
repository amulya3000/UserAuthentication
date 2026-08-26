<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control — System Workspace Hub</title>
    <meta name="description" content="Administrator control panel for user role management, workspace oversight, and global workflow configuration.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --bg:        #0a0f1e;
            --surface:   #111827;
            --surface2:  #1a2235;
            --border:    rgba(255,255,255,0.07);
            --border2:   rgba(255,255,255,0.12);
            --text:      #f1f5f9;
            --muted:     #94a3b8;
            --accent:    #10b981;
            --accent2:   #34d399;
            --green:     #10b981;
            --red:       #ef4444;
            --amber:     #f59e0b;
            --blue:      #10b981;
            --cyan:      #06b6d4;
        }
        *{box-sizing:border-box;margin:0;padding:0;}
        html,body{height:100%;background:var(--bg);color:var(--text);font-family:'Inter',sans-serif;-webkit-font-smoothing:antialiased;}
        a{text-decoration:none;color:inherit;}
        input,select,textarea,button{font-family:'Inter',sans-serif;}

        /* ── LAYOUT ── */
        .app{display:flex;flex-direction:column;height:100vh;}

        /* ── TOPBAR ── */
        .topbar{
            background:rgba(17,24,39,0.95);
            backdrop-filter:blur(12px);
            border-bottom:1px solid var(--border2);
            height:60px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 24px;
            position:sticky;top:0;z-index:100;
            flex-shrink:0;
        }
        .topbar-brand{display:flex;align-items:center;gap:10px;}
        .brand-icon{
            width:36px;height:36px;border-radius:10px;
            background:linear-gradient(135deg,#10b981,#047857);
            display:flex;align-items:center;justify-content:center;
            box-shadow:0 0 16px rgba(16,185,129,0.4);
        }
        .brand-icon svg{width:18px;height:18px;color:#fff;}
        .brand-name{font-weight:800;font-size:16px;letter-spacing:-0.3px;}
        .brand-sub{font-size:11px;color:var(--muted);margin-top:1px;}
        .topbar-right{display:flex;align-items:center;gap:16px;}
        .user-chip{
            display:flex;align-items:center;gap:10px;
            background:var(--surface2);border:1px solid var(--border2);
            padding:6px 12px;border-radius:10px;
        }
        .user-avatar{
            width:28px;height:28px;border-radius:50%;
            background:linear-gradient(135deg,#10b981,#047857);
            display:flex;align-items:center;justify-content:center;
            font-weight:700;font-size:11px;color:#fff;
        }
        .user-name{font-size:13px;font-weight:600;}
        .user-badge{font-size:10px;color:var(--green);font-weight:500;}
        .btn-logout{
            background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);
            color:#f87171;padding:7px 14px;border-radius:8px;
            font-size:12px;font-weight:600;cursor:pointer;
            transition:all 0.2s;
        }
        .btn-logout:hover{background:rgba(239,68,68,0.2);border-color:rgba(239,68,68,0.4);}

        /* ── BODY WRAPPER ── */
        .body-wrap{display:flex;flex:1;overflow:hidden;}

        /* ── SIDEBAR ── */
        .sidebar{
            width:230px;flex-shrink:0;
            background:var(--surface);
            border-right:1px solid var(--border);
            padding:20px 12px;
            display:flex;flex-direction:column;gap:4px;
            overflow-y:auto;
        }
        .sidebar-label{
            font-size:10px;font-weight:700;letter-spacing:0.1em;
            color:var(--muted);text-transform:uppercase;
            padding:8px 10px 6px;margin-top:8px;
        }
        .nav-item{
            display:flex;align-items:center;gap:10px;
            padding:10px 12px;border-radius:8px;
            font-size:13px;font-weight:500;color:var(--muted);
            cursor:pointer;transition:all 0.15s;border:none;background:transparent;
            width:100%;text-align:left;
        }
        .nav-item svg{width:16px;height:16px;flex-shrink:0;opacity:0.6;transition:opacity 0.15s;}
        .nav-item:hover{background:rgba(255,255,255,0.05);color:var(--text);}
        .nav-item:hover svg{opacity:1;}
        .nav-item.active{
            background:linear-gradient(135deg,rgba(16,185,129,0.2),rgba(139,92,246,0.1));
            color:var(--accent2);border:1px solid rgba(16,185,129,0.25);
        }
        .nav-item.active svg{opacity:1;color:var(--accent2);}
        .nav-badge{
            margin-left:auto;
            background:rgba(16,185,129,0.3);
            color:var(--accent2);
            font-size:10px;font-weight:700;
            padding:2px 7px;border-radius:999px;
            min-width:20px;text-align:center;
        }
        .nav-badge.red{background:rgba(239,68,68,0.2);color:#f87171;}

        /* ── MAIN CONTENT ── */
        .main{flex:1;overflow-y:auto;padding:28px;}

        /* ── PANELS ── */
        .panel{display:none;}
        .panel.active{display:block;}

        /* ── FLASH ALERTS ── */
        .alert{
            display:flex;align-items:center;gap:10px;
            padding:12px 16px;border-radius:10px;
            font-size:13px;font-weight:500;margin-bottom:20px;
        }
        .alert-success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.25);color:#6ee7b7;}
        .alert-error{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.25);color:#fca5a5;}

        /* ── SECTION HEADER ── */
        .section-header{margin-bottom:24px;}
        .section-title{font-size:22px;font-weight:800;letter-spacing:-0.5px;}
        .section-sub{font-size:13px;color:var(--muted);margin-top:4px;}

        /* ── STAT CARDS ── */
        .stat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:28px;}
        .stat-card{
            background:var(--surface);border:1px solid var(--border2);
            border-radius:14px;padding:20px;
            position:relative;overflow:hidden;
        }
        .stat-card::before{
            content:'';position:absolute;top:0;left:0;right:0;height:3px;
            background:linear-gradient(90deg,var(--accent),var(--cyan));
        }
        .stat-card.green::before{background:linear-gradient(90deg,var(--green),#34d399);}
        .stat-card.amber::before{background:linear-gradient(90deg,var(--amber),#fbbf24);}
        .stat-card.red::before{background:linear-gradient(90deg,var(--red),#f87171);}
        .stat-value{font-size:28px;font-weight:800;letter-spacing:-1px;}
        .stat-label{font-size:12px;color:var(--muted);margin-top:4px;font-weight:500;}
        .stat-icon{
            position:absolute;top:18px;right:18px;
            width:36px;height:36px;border-radius:9px;
            display:flex;align-items:center;justify-content:center;
        }
        .stat-icon svg{width:18px;height:18px;}

        /* ── CARD ── */
        .card{
            background:var(--surface);border:1px solid var(--border2);
            border-radius:16px;overflow:hidden;margin-bottom:24px;
        }
        .card-header{
            padding:18px 24px;border-bottom:1px solid var(--border);
            display:flex;align-items:center;justify-content:space-between;
        }
        .card-title{font-size:14px;font-weight:700;}
        .card-sub{font-size:12px;color:var(--muted);margin-top:2px;}
        .card-body{padding:24px;}

        /* ── FORMS ── */
        .form-group{margin-bottom:18px;}
        .form-label{display:block;font-size:12px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;}
        .form-control{
            width:100%;padding:11px 14px;
            background:rgba(255,255,255,0.04);
            border:1px solid var(--border2);
            border-radius:9px;color:var(--text);font-size:14px;
            transition:all 0.2s;outline:none;
        }
        .form-control:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(16,185,129,0.15);}
        .form-control::placeholder{color:rgba(148,163,184,0.5);}

        .btn{
            display:inline-flex;align-items:center;gap:6px;
            padding:9px 18px;border-radius:9px;font-size:13px;font-weight:600;
            cursor:pointer;border:none;transition:all 0.2s;
        }
        .btn svg{width:14px;height:14px;}
        .btn-primary{background:var(--accent);color:#fff;}
        .btn-primary:hover{background:#4f46e5;box-shadow:0 0 16px rgba(16,185,129,0.35);}
        .btn-success{background:rgba(16,185,129,0.15);color:#6ee7b7;border:1px solid rgba(16,185,129,0.25);}
        .btn-success:hover{background:rgba(16,185,129,0.25);}
        .btn-danger{background:rgba(239,68,68,0.12);color:#f87171;border:1px solid rgba(239,68,68,0.2);}
        .btn-danger:hover{background:rgba(239,68,68,0.22);}
        .btn-warning{background:rgba(245,158,11,0.12);color:#fbbf24;border:1px solid rgba(245,158,11,0.2);}
        .btn-warning:hover{background:rgba(245,158,11,0.22);}
        .btn-ghost{background:rgba(255,255,255,0.05);color:var(--muted);border:1px solid var(--border2);}
        .btn-ghost:hover{background:rgba(255,255,255,0.08);color:var(--text);}
        .btn-sm{padding:5px 11px;font-size:11px;border-radius:6px;}

        /* ── TABLE ── */
        .table-wrap{overflow-x:auto;}
        table{width:100%;border-collapse:collapse;}
        thead th{
            padding:11px 16px;
            font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;
            color:var(--muted);background:rgba(255,255,255,0.02);
            border-bottom:1px solid var(--border);text-align:left;
        }
        tbody tr{border-bottom:1px solid var(--border);transition:background 0.15s;}
        tbody tr:hover{background:rgba(255,255,255,0.02);}
        tbody tr:last-child{border-bottom:none;}
        tbody td{padding:13px 16px;font-size:13px;vertical-align:middle;}
        .td-actions{display:flex;gap:6px;flex-wrap:wrap;}

        /* ── BADGES ── */
        .badge{display:inline-flex;align-items:center;padding:3px 9px;border-radius:999px;font-size:11px;font-weight:600;}
        .badge-green{background:rgba(16,185,129,0.15);color:#6ee7b7;border:1px solid rgba(16,185,129,0.2);}
        .badge-red{background:rgba(239,68,68,0.12);color:#f87171;border:1px solid rgba(239,68,68,0.2);}
        .badge-amber{background:rgba(245,158,11,0.12);color:#fbbf24;border:1px solid rgba(245,158,11,0.2);}
        .badge-blue{background:rgba(59,130,246,0.12);color:#93c5fd;border:1px solid rgba(59,130,246,0.2);}
        .badge-purple{background:rgba(16,185,129,0.15);color:#a5b4fc;border:1px solid rgba(16,185,129,0.2);}
        .badge-gray{background:rgba(148,163,184,0.1);color:var(--muted);border:1px solid var(--border2);}

        /* ── WORKSPACE CARDS ── */
        .workspace-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;}
        .workspace-card{
            background:var(--surface2);border:1px solid var(--border2);
            border-radius:14px;padding:20px;transition:border-color 0.2s;
        }
        .workspace-card:hover{border-color:rgba(16,185,129,0.35);}
        .wc-head{display:flex;align-items:center;gap:12px;margin-bottom:16px;}
        .wc-avatar{
            width:40px;height:40px;border-radius:12px;
            background:linear-gradient(135deg,#10b981,#047857);
            display:flex;align-items:center;justify-content:center;
            font-weight:800;font-size:14px;color:#fff;
        }
        .wc-name{font-size:14px;font-weight:700;}
        .wc-email{font-size:11px;color:var(--muted);}
        .progress-row{margin-bottom:10px;}
        .progress-label{display:flex;justify-content:space-between;font-size:11px;color:var(--muted);margin-bottom:4px;}
        .progress-bar{height:6px;border-radius:999px;background:rgba(255,255,255,0.07);}
        .progress-fill{height:100%;border-radius:999px;transition:width 0.6s ease;}

        /* ── WORKFLOW CONFIG ── */
        .workflow-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
        @media(max-width:700px){.workflow-grid{grid-template-columns:1fr;}}
        .toggle-row{
            display:flex;align-items:center;justify-content:space-between;
            padding:14px 0;border-bottom:1px solid var(--border);
        }
        .toggle-row:last-child{border-bottom:none;}
        .toggle-info .toggle-label{font-size:13px;font-weight:600;}
        .toggle-info .toggle-desc{font-size:11px;color:var(--muted);margin-top:2px;}
        .toggle-switch{position:relative;width:44px;height:24px;cursor:pointer;}
        .toggle-switch input{opacity:0;width:0;height:0;}
        .toggle-track{
            position:absolute;inset:0;border-radius:999px;
            background:rgba(255,255,255,0.1);
            transition:background 0.25s;border:1px solid var(--border2);
        }
        .toggle-track::after{
            content:'';position:absolute;left:4px;top:4px;
            width:16px;height:16px;border-radius:50%;
            background:var(--muted);transition:all 0.25s;
        }
        .toggle-switch input:checked + .toggle-track{background:var(--accent);border-color:var(--accent);}
        .toggle-switch input:checked + .toggle-track::after{left:24px;background:#fff;}

        /* ── AUTH INFO ── */
        .session-item{
            display:flex;align-items:center;gap:14px;
            padding:14px;background:var(--surface2);border:1px solid var(--border);
            border-radius:12px;margin-bottom:10px;
        }
        .session-dot{width:10px;height:10px;border-radius:50%;background:var(--green);flex-shrink:0;box-shadow:0 0 6px var(--green);}
        .session-dot.inactive{background:var(--muted);box-shadow:none;}

        /* ── PENDING WIDGET ── */
        .pending-list{display:flex;flex-direction:column;gap:10px;}
        .pending-item{
            background:var(--surface2);border:1px solid var(--border2);
            border-radius:12px;padding:14px 16px;
            display:flex;align-items:center;gap:12px;
        }
        .pending-avatar{
            width:36px;height:36px;border-radius:10px;flex-shrink:0;
            background:linear-gradient(135deg,#f59e0b,#f97316);
            display:flex;align-items:center;justify-content:center;
            font-weight:700;font-size:13px;color:#fff;
        }
        .pending-info{flex:1;min-width:0;}
        .pending-name{font-size:13px;font-weight:600;}
        .pending-email{font-size:11px;color:var(--muted);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
        .pending-actions{display:flex;gap:6px;}

        /* ── TASK DEPLOY FORM ── */
        .deploy-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
        @media(max-width:600px){.deploy-grid{grid-template-columns:1fr;}}

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar{width:6px;}
        ::-webkit-scrollbar-track{background:transparent;}
        ::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.1);border-radius:999px;}
        ::-webkit-scrollbar-thumb:hover{background:rgba(255,255,255,0.15);}

        /* ── EMPTY STATE ── */
        .empty-state{
            padding:48px 24px;text-align:center;color:var(--muted);
        }
        .empty-state svg{width:40px;height:40px;margin-bottom:12px;opacity:0.3;}
        .empty-state p{font-size:13px;}

        /* ── WORD COUNT ── */
        #word_counter{font-size:11px;color:var(--muted);}
        #word_counter.over{color:var(--red);font-weight:700;}
    </style>
</head>
<body>
<div class="app">

    <!-- ── TOPBAR ── -->
    <header class="topbar">
        <div class="topbar-brand">
            <div class="brand-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
            </div>
            <div>
                <div class="brand-name">System Workspace Hub</div>
                <div class="brand-sub">Administrative Control Panel</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="user-chip">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-badge">● Administrator</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="btn-logout">Sign Out</button>
            </form>
        </div>
    </header>

    <div class="body-wrap">

        <!-- ── SIDEBAR ── -->
        <nav class="sidebar">
            <div class="sidebar-label">Overview</div>
            <button class="nav-item active" id="nav-dashboard" onclick="switchTab('dashboard')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard Home
            </button>

            <div class="sidebar-label">Management</div>
            <button class="nav-item" id="nav-userrole" onclick="switchTab('userrole')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                User & Role Control
                @if($pendingUsers->count() > 0)
                    <span class="nav-badge red">{{ $pendingUsers->count() }}</span>
                @endif
            </button>
            <button class="nav-item" id="nav-workspace" onclick="switchTab('workspace')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Workspace Manager
            </button>
            <button class="nav-item" id="nav-workflow" onclick="switchTab('workflow')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Global Workflow
            </button>
            <button class="nav-item" id="nav-auth" onclick="switchTab('auth')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                System Authentication
            </button>
        </nav>

        <!-- ── MAIN ── -->
        <main class="main">

            <!-- Flash alerts -->
            @if(session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @foreach($errors->all() as $e) {{ $e }} @endforeach
            </div>
            @endif

            <!-- ══════════════════════════════════════════════════════
                 TAB 1: DASHBOARD HOME
            ══════════════════════════════════════════════════════ -->
            <div class="panel active" id="panel-dashboard">
                <div class="section-header">
                    <div class="section-title">Dashboard Overview</div>
                    <div class="section-sub">Welcome back, {{ Auth::user()->name }}. Here's your system at a glance.</div>
                </div>

                <!-- Stat cards -->
                <div class="stat-grid">
                    <div class="stat-card">
                        <div class="stat-value">{{ $allUsers->count() }}</div>
                        <div class="stat-label">Total Users</div>
                        <div class="stat-icon" style="background:rgba(16,185,129,0.1);">
                            <svg fill="none" stroke="#34d399" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
                        </div>
                    </div>
                    <div class="stat-card green">
                        <div class="stat-value">{{ $employees->count() }}</div>
                        <div class="stat-label">Active Employees</div>
                        <div class="stat-icon" style="background:rgba(16,185,129,0.1);">
                            <svg fill="none" stroke="#10b981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="stat-card amber">
                        <div class="stat-value">{{ $pendingUsers->count() }}</div>
                        <div class="stat-label">Pending Approvals</div>
                        <div class="stat-icon" style="background:rgba(245,158,11,0.1);">
                            <svg fill="none" stroke="#f59e0b" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $workspaceStats->sum('total') }}</div>
                        <div class="stat-label">Tasks Deployed</div>
                        <div class="stat-icon" style="background:rgba(6,182,212,0.1);">
                            <svg fill="none" stroke="#06b6d4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;" class="dashboard-cols">

                    <!-- Task Deployment -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Deploy Task</div>
                                <div class="card-sub">Assign work to an employee</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('tasks.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Task Title</label>
                                    <input type="text" name="title" class="form-control" required placeholder="Describe task objective...">
                                </div>
                                <div class="deploy-grid">
                                    <div class="form-group">
                                        <label class="form-label">Assign To</label>
                                        <select name="user_id" class="form-control" required>
                                            <option value="" disabled selected>Choose employee...</option>
                                            @forelse($employees as $emp)
                                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                            @empty
                                                <option disabled>No active employees</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Priority</label>
                                        <select name="priority" class="form-control" required>
                                            <option value="Low">Low</option>
                                            <option value="Medium" selected>Medium</option>
                                            <option value="High">High</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Task guidelines, deliverables, dependencies..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                    Deploy Task
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Pending Approvals quick widget -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Pending Registrations</div>
                                <div class="card-sub">Authorize new accounts</div>
                            </div>
                            <span class="badge badge-amber">{{ $pendingUsers->count() }}</span>
                        </div>
                        <div class="card-body" style="padding:16px;">
                            @if($pendingUsers->count() > 0)
                            <div class="pending-list">
                                @foreach($pendingUsers as $pUser)
                                <div class="pending-item">
                                    <div class="pending-avatar">{{ strtoupper(substr($pUser->name,0,1)) }}</div>
                                    <div class="pending-info">
                                        <div class="pending-name">{{ $pUser->name }}</div>
                                        <div class="pending-email">{{ $pUser->email }}</div>
                                    </div>
                                    <div class="pending-actions">
                                        <form action="{{ route('admin.users.approve', $pUser->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">✓</button>
                                        </form>
                                        <form action="{{ route('admin.users.reject', $pUser->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">✕</button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
                                <p>All caught up — no pending registrations.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Project Brief -->
                <div class="card" style="margin-top:20px;">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Project Brief & Guidelines</div>
                            <div class="card-sub">Broadcast to all employee dashboards</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.project.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Brief Title</label>
                                <input type="text" name="title" class="form-control" required value="{{ $project->title }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Project Specifications</label>
                                <textarea name="description" class="form-control" rows="8" id="project_desc" oninput="countWords()" required>{{ $project->description }}</textarea>
                                <div style="display:flex;justify-content:flex-end;margin-top:6px;">
                                    <span id="word_counter">0 / 2000 words</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                Publish Brief
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Admin Notes Broadcast (DB-backed) -->
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Admin Notes Broadcast</div>
                            <div class="card-sub">Visible to all employees on their dashboards</div>
                        </div>
                        <span class="badge badge-green">Live</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.notes.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="content" class="form-control" rows="5"
                                    placeholder="Announcements, reminders, updates for all employees..."
                                    id="adminNotesTA">{{ \App\Models\AdminNote::find(1)?->content ?? '' }}</textarea>
                            </div>
                            <div style="display:flex;gap:10px;align-items:center;">
                                <button type="submit" class="btn btn-primary">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                    Broadcast Notes
                                </button>
                                <form action="{{ route('admin.notes.destroy') }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost" onclick="return confirm('Clear admin notes?')">Clear</button>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /dashboard panel -->


            <!-- ══════════════════════════════════════════════════════
                 TAB 2: USER & ROLE CONTROL
            ══════════════════════════════════════════════════════ -->
            <div class="panel" id="panel-userrole">
                <div class="section-header">
                    <div class="section-title">User & Role Control</div>
                    <div class="section-sub">Manage accounts, roles, and approval status for all registered users.</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">All Users</div>
                            <div class="card-sub">{{ $allUsers->count() }} total registered users</div>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Age</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allUsers as $u)
                                <tr>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:10px;">
                                            <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,#10b981,#047857);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;color:#fff;flex-shrink:0;">
                                                {{ strtoupper(substr($u->name,0,1)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight:600;font-size:13px;">{{ $u->name }}
                                                    @if($u->id === Auth::id())<span style="font-size:10px;color:var(--muted);"> (you)</span>@endif
                                                </div>
                                                <div style="font-size:11px;color:var(--muted);">{{ $u->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($u->role === 'admin')
                                            <span class="badge badge-purple">Admin</span>
                                        @else
                                            <span class="badge badge-blue">Employee</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($u->status === 'approved')
                                            <span class="badge badge-green">Approved</span>
                                        @elseif($u->status === 'pending')
                                            <span class="badge badge-amber">Pending</span>
                                        @elseif($u->status === 'rejected')
                                            <span class="badge badge-red">Rejected</span>
                                        @else
                                            <span class="badge badge-gray">{{ ucfirst($u->status) }}</span>
                                        @endif
                                    </td>
                                    <td style="color:var(--muted);">{{ $u->age ?? '—' }}</td>
                                    <td style="color:var(--muted);font-size:12px;">{{ $u->created_at->format('M j, Y') }}</td>
                                    <td>
                                        @if($u->id !== Auth::id() && (Auth::user()->role === 'super_admin' || !in_array($u->role, ['admin', 'super_admin'])))
                                        <div class="td-actions">
                                            <!-- Approve/Reject for pending -->
                                            @if($u->status === 'pending')
                                            <form action="{{ route('admin.users.approve', $u->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.users.reject', $u->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                            @endif

                                            <!-- Deactivate/Reactivate -->
                                            @if($u->status === 'approved')
                                            <form action="{{ route('admin.users.deactivate', $u->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Deactivate {{ $u->name }}?')">Deactivate</button>
                                            </form>
                                            @elseif($u->status === 'deactivated' || $u->status === 'rejected')
                                            <form action="{{ route('admin.users.reactivate', $u->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Reactivate</button>
                                            </form>
                                            @endif

                                            <!-- Change Role -->
                                            <form action="{{ route('admin.users.role', $u->id) }}" method="POST" style="display:flex;gap:4px;align-items:center;">
                                                @csrf
                                                <select name="role" class="form-control" style="padding:4px 8px;font-size:11px;width:auto;">
                                                    <option value="employee" {{ $u->role === 'employee' ? 'selected' : '' }}>Employee</option>
                                                    <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                    @if(Auth::user()->role === 'super_admin')
                                                    <option value="super_admin" {{ $u->role === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                                    @endif
                                                </select>
                                                <button type="submit" class="btn btn-ghost btn-sm">Set</button>
                                            </form>
                                        </div>
                                        @else
                                            <span style="font-size:12px;color:var(--muted);">—</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /userrole panel -->


            <!-- ══════════════════════════════════════════════════════
                 TAB 3: WORKSPACE MANAGER
            ══════════════════════════════════════════════════════ -->
            <div class="panel" id="panel-workspace">
                <div class="section-header">
                    <div class="section-title">Workspace Manager</div>
                    <div class="section-sub">Real-time task completion stats per employee workspace.</div>
                </div>

                @if($workspaceStats->count() > 0)
                <div class="workspace-grid">
                    @foreach($workspaceStats as $stat)
                    @php
                        $pct = $stat['total'] > 0 ? round(($stat['completed'] / $stat['total']) * 100) : 0;
                    @endphp
                    <div class="workspace-card">
                        <div class="wc-head">
                            <div class="wc-avatar">{{ strtoupper(substr($stat['name'],0,1)) }}</div>
                            <div>
                                <div class="wc-name">{{ $stat['name'] }}</div>
                                <div class="wc-email">{{ $stat['email'] }}</div>
                            </div>
                        </div>

                        <!-- Completion progress -->
                        <div class="progress-row">
                            <div class="progress-label">
                                <span>Overall Completion</span>
                                <span style="color:var(--text);font-weight:700;">{{ $pct }}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width:{{ $pct }}%;background:linear-gradient(90deg,#10b981,#06b6d4);"></div>
                            </div>
                        </div>

                        <!-- Stats row -->
                        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-top:12px;">
                            <div style="background:rgba(16,185,129,0.1);border-radius:8px;padding:8px;text-align:center;">
                                <div style="font-size:18px;font-weight:800;color:var(--accent2);">{{ $stat['todo'] }}</div>
                                <div style="font-size:10px;color:var(--muted);">To Do</div>
                            </div>
                            <div style="background:rgba(6,182,212,0.1);border-radius:8px;padding:8px;text-align:center;">
                                <div style="font-size:18px;font-weight:800;color:var(--cyan);">{{ $stat['inprogress'] }}</div>
                                <div style="font-size:10px;color:var(--muted);">In Progress</div>
                            </div>
                            <div style="background:rgba(16,185,129,0.1);border-radius:8px;padding:8px;text-align:center;">
                                <div style="font-size:18px;font-weight:800;color:var(--green);">{{ $stat['completed'] }}</div>
                                <div style="font-size:10px;color:var(--muted);">Done</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="card">
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
                        <p>No approved employees yet. Approve registrations in User & Role Control.</p>
                    </div>
                </div>
                @endif
            </div><!-- /workspace panel -->


            <!-- ══════════════════════════════════════════════════════
                 TAB 4: GLOBAL WORKFLOW
            ══════════════════════════════════════════════════════ -->
            <div class="panel" id="panel-workflow">
                <div class="section-header">
                    <div class="section-title">Global Workflow</div>
                    <div class="section-sub">Configure system-wide workflow settings, defaults, and policies.</div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;" class="workflow-grid">
                    <!-- Task Pipeline Config -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Task Pipeline Settings</div>
                                <div class="card-sub">Control task flow behaviour</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <div class="toggle-label">Require task descriptions</div>
                                    <div class="toggle-desc">Tasks must include a description to be deployed</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="wf-desc" onchange="saveWorkflowSetting('requireDesc', this.checked)">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <div class="toggle-label">Auto-notify on task assignment</div>
                                    <div class="toggle-desc">Show dashboard notification when new task arrives</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="wf-notify" checked onchange="saveWorkflowSetting('autoNotify', this.checked)">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <div class="toggle-label">Allow employees to self-complete</div>
                                    <div class="toggle-desc">Employees can mark tasks as Completed</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="wf-selfcomplete" checked onchange="saveWorkflowSetting('selfComplete', this.checked)">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Policy -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Registration & Access Policy</div>
                                <div class="card-sub">Control how users join the system</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <div class="toggle-label">Require admin approval</div>
                                    <div class="toggle-desc">New employee accounts need admin sign-off</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="wf-approval" checked onchange="saveWorkflowSetting('requireApproval', this.checked)">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <div class="toggle-label">Allow public registration</div>
                                    <div class="toggle-desc">Anyone can register from the public page</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="wf-public" checked onchange="saveWorkflowSetting('publicReg', this.checked)">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <div class="toggle-label">Allow admin self-registration</div>
                                    <div class="toggle-desc">Admins skip the approval queue on register</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="wf-adminreg" checked onchange="saveWorkflowSetting('adminSelfReg', this.checked)">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Default Priority -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Default Task Priority</div>
                                <div class="card-sub">Applied when no priority is set</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Default Priority Level</label>
                                <select id="wf-priority" class="form-control" onchange="saveWorkflowSetting('defaultPriority', this.value)">
                                    <option value="Low">Low Priority</option>
                                    <option value="Medium" selected>Medium Priority</option>
                                    <option value="High">High Priority</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Max Tasks Per Employee</label>
                                <input type="number" id="wf-maxtasks" class="form-control" value="20" min="1" max="100"
                                    onchange="saveWorkflowSetting('maxTasks', this.value)">
                            </div>
                            <div id="wf-saved" style="font-size:12px;color:var(--green);display:none;">✓ Settings saved</div>
                        </div>
                    </div>

                    <!-- Sprint Policy -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Sprint & Backlog Policy</div>
                                <div class="card-sub">Agile workflow configuration</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <div class="toggle-label">Auto-complete sprint</div>
                                    <div class="toggle-desc">Sprint closes when all issues are Done</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="wf-autosprint" checked onchange="saveWorkflowSetting('autoSprint', this.checked)">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <div class="toggle-label">Enforce single active sprint</div>
                                    <div class="toggle-desc">Only one sprint can be active at a time</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="wf-singlesprint" checked onchange="saveWorkflowSetting('singleSprint', this.checked)">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /workflow panel -->


            <!-- ══════════════════════════════════════════════════════
                 TAB 5: SYSTEM AUTHENTICATION
            ══════════════════════════════════════════════════════ -->
            <div class="panel" id="panel-auth">
                <div class="section-header">
                    <div class="section-title">System Authentication</div>
                    <div class="section-sub">Monitor active sessions, user statuses, and security information.</div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;" class="workflow-grid">
                    <!-- Your Session -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Current Session</div>
                                <div class="card-sub">Your active authentication details</div>
                            </div>
                            <span class="badge badge-green">● Active</span>
                        </div>
                        <div class="card-body">
                            <div class="session-item">
                                <div class="session-dot"></div>
                                <div>
                                    <div style="font-size:13px;font-weight:600;">{{ Auth::user()->name }}</div>
                                    <div style="font-size:11px;color:var(--muted);">{{ Auth::user()->email }}</div>
                                </div>
                                <div style="margin-left:auto;text-align:right;">
                                    <div class="badge badge-purple" style="margin-bottom:4px;">{{ ucfirst(Auth::user()->role) }}</div>
                                    <div style="font-size:11px;color:var(--green);">Authenticated</div>
                                </div>
                            </div>
                            <div style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:16px;margin-top:12px;">
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                                    <div>
                                        <div style="font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;">User ID</div>
                                        <div style="font-size:13px;font-weight:700;margin-top:2px;">#{{ Auth::id() }}</div>
                                    </div>
                                    <div>
                                        <div style="font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;">Account Status</div>
                                        <div style="font-size:13px;font-weight:700;margin-top:2px;color:var(--green);">{{ ucfirst(Auth::user()->status) }}</div>
                                    </div>
                                    <div>
                                        <div style="font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;">Joined</div>
                                        <div style="font-size:13px;font-weight:700;margin-top:2px;">{{ Auth::user()->created_at->format('M j, Y') }}</div>
                                    </div>
                                    <div>
                                        <div style="font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;">Session</div>
                                        <div style="font-size:13px;font-weight:700;margin-top:2px;color:var(--green);">Valid</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Status Overview -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Account Status Overview</div>
                                <div class="card-sub">All users by status</div>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $approvedCount    = $allUsers->where('status','approved')->count();
                                $pendingCount     = $allUsers->where('status','pending')->count();
                                $rejectedCount    = $allUsers->where('status','rejected')->count();
                                $deactivatedCount = $allUsers->where('status','deactivated')->count();
                                $total            = $allUsers->count() ?: 1;
                            @endphp
                            <div style="display:flex;flex-direction:column;gap:14px;">
                                <div>
                                    <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:6px;">
                                        <span style="color:var(--green);font-weight:600;">Approved</span>
                                        <span>{{ $approvedCount }} / {{ $total }}</span>
                                    </div>
                                    <div class="progress-bar"><div class="progress-fill" style="width:{{ round(($approvedCount/$total)*100) }}%;background:var(--green);"></div></div>
                                </div>
                                <div>
                                    <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:6px;">
                                        <span style="color:var(--amber);font-weight:600;">Pending</span>
                                        <span>{{ $pendingCount }} / {{ $total }}</span>
                                    </div>
                                    <div class="progress-bar"><div class="progress-fill" style="width:{{ round(($pendingCount/$total)*100) }}%;background:var(--amber);"></div></div>
                                </div>
                                <div>
                                    <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:6px;">
                                        <span style="color:var(--red);font-weight:600;">Rejected</span>
                                        <span>{{ $rejectedCount }} / {{ $total }}</span>
                                    </div>
                                    <div class="progress-bar"><div class="progress-fill" style="width:{{ round(($rejectedCount/$total)*100) }}%;background:var(--red);"></div></div>
                                </div>
                                <div>
                                    <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:6px;">
                                        <span style="color:var(--muted);font-weight:600;">Deactivated</span>
                                        <span>{{ $deactivatedCount }} / {{ $total }}</span>
                                    </div>
                                    <div class="progress-bar"><div class="progress-fill" style="width:{{ round(($deactivatedCount/$total)*100) }}%;background:var(--muted);"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- All Sessions / Admin Accounts -->
                    <div class="card" style="grid-column:span 2;">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Registered Administrators</div>
                                <div class="card-sub">Accounts with admin access</div>
                            </div>
                        </div>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Administrator</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Registered</th>
                                        <th>Current User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allUsers->whereIn('role', ['admin', 'super_admin']) as $admin)
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px;">
                                                <div style="width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#10b981,#047857);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:11px;color:#fff;">
                                                    {{ strtoupper(substr($admin->name,0,1)) }}
                                                </div>
                                                <div style="display:flex;flex-direction:column;">
                                                    <span style="font-weight:600;font-size:13px;">{{ $admin->name }}</span>
                                                    @if($admin->role === 'super_admin')
                                                        <span style="font-size:10px;color:var(--indigo);font-weight:bold;">Super Admin</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td style="font-size:12px;color:var(--muted);">{{ $admin->email }}</td>
                                        <td>
                                            @if($admin->status === 'approved')
                                                <span class="badge badge-green">Active</span>
                                            @else
                                                <span class="badge badge-gray">{{ ucfirst($admin->status) }}</span>
                                            @endif
                                        </td>
                                        <td style="font-size:12px;color:var(--muted);">{{ $admin->created_at->format('M j, Y') }}</td>
                                        <td>
                                            @if($admin->id === Auth::id())
                                                <span class="badge badge-purple">You</span>
                                            @else
                                                <span style="color:var(--muted);font-size:12px;">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /auth panel -->

        </main>
    </div>
</div>

<script>
    // ── TAB SWITCHING ──────────────────────────────────────────
    function switchTab(tab) {
        document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        document.getElementById('panel-' + tab).classList.add('active');
        document.getElementById('nav-' + tab).classList.add('active');
    }

    // Check URL hash on load to auto-switch tabs
    (function() {
        const hash = window.location.hash.replace('#', '');
        const valid = ['dashboard','userrole','workspace','workflow','auth'];
        if (valid.includes(hash)) switchTab(hash);
    })();

    // Update hash when switching
    const origSwitch = switchTab;
    window.switchTab = function(tab) {
        origSwitch(tab);
        history.replaceState(null, null, '#' + tab);
    };

    // ── WORD COUNTER ───────────────────────────────────────────
    function countWords() {
        const text = document.getElementById('project_desc').value.trim();
        const words = text ? text.split(/\s+/).length : 0;
        const el = document.getElementById('word_counter');
        el.textContent = words + ' / 2000 words';
        el.className = words > 2000 ? 'over' : '';
    }
    window.addEventListener('DOMContentLoaded', countWords);

    // ── WORKFLOW SETTINGS (localStorage) ─────────────────────
    function saveWorkflowSetting(key, val) {
        const settings = JSON.parse(localStorage.getItem('wf_settings') || '{}');
        settings[key] = val;
        localStorage.setItem('wf_settings', JSON.stringify(settings));
        const msg = document.getElementById('wf-saved');
        if (msg) { msg.style.display = 'block'; setTimeout(() => msg.style.display = 'none', 2000); }
    }

    function loadWorkflowSettings() {
        const settings = JSON.parse(localStorage.getItem('wf_settings') || '{}');
        const map = {
            'requireDesc': 'wf-desc', 'autoNotify': 'wf-notify', 'selfComplete': 'wf-selfcomplete',
            'requireApproval': 'wf-approval', 'publicReg': 'wf-public', 'adminSelfReg': 'wf-adminreg',
            'autoSprint': 'wf-autosprint', 'singleSprint': 'wf-singlesprint',
        };
        Object.entries(settings).forEach(([key, val]) => {
            if (map[key]) {
                const el = document.getElementById(map[key]);
                if (el && el.type === 'checkbox') el.checked = val;
            }
        });
        if (settings.defaultPriority) document.getElementById('wf-priority').value = settings.defaultPriority;
        if (settings.maxTasks) document.getElementById('wf-maxtasks').value = settings.maxTasks;
    }

    window.addEventListener('DOMContentLoaded', loadWorkflowSettings);
</script>
</body>
</html>