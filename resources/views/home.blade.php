<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Product Hub — Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --purple:#7B68EE;
    --purple-dark:#5E4ED8;
    --purple-light:#EFEBFF;
    --blue:#0C66E4;
    --blue-light:#E9F2FF;
    --green:#1F9D55;
    --green-light:#E3F8EC;
    --amber:#B76E00;
    --amber-light:#FFF3DE;
    --red:#D43F3F;
    --red-light:#FCE8E8;
    --sidebar:#1B1A28;
    --sidebar-hover:#2A2940;
    --sidebar-text:#A9A7BD;
    --bg:#F6F6FA;
    --card:#FFFFFF;
    --border:#E7E6EF;
    --ink:#1F1E2B;
    --ink-soft:#6F6E81;
    --radius:10px;
  }
  *{box-sizing:border-box;}
  body{
    margin:0;
    font-family:'Inter',sans-serif;
    background:var(--bg);
    color:var(--ink);
    font-size:14px;
    -webkit-font-smoothing:antialiased;
  }
  .app{ display:flex; min-height:100vh; }

  /* SIDEBAR */
  .sidebar{
    width:236px;
    background:var(--sidebar);
    color:var(--sidebar-text);
    display:flex;
    flex-direction:column;
    flex-shrink:0;
    padding:18px 14px;
  }
  .brand{
    display:flex;
    align-items:center;
    gap:10px;
    padding:6px 8px 22px 8px;
  }
  .brand-mark{
    width:30px;height:30px;border-radius:8px;
    background:linear-gradient(135deg,var(--purple),#9C8CFF);
    display:flex;align-items:center;justify-content:center;
    font-weight:800;color:#fff;font-size:15px;
  }
  .brand-name{ color:#fff; font-weight:700; font-size:15px; letter-spacing:.2px;}

  .nav-section{ margin-bottom:18px; }
  .nav-label{
    font-size:11px; text-transform:uppercase; letter-spacing:.06em;
    color:#6E6C85; padding:6px 10px; font-weight:600;
  }
  .nav-item{
    display:flex; align-items:center; gap:10px;
    padding:8px 10px; border-radius:8px; cursor:pointer;
    font-size:13.5px; font-weight:500; color:var(--sidebar-text);
    transition:background .15s, color .15s;
  }
  .nav-item:hover{ background:var(--sidebar-hover); color:#fff; }
  .nav-item.active{ background:var(--purple); color:#fff; }
  .nav-item svg{ width:16px;height:16px; flex-shrink:0; opacity:.9; }
  .nav-item .count{
    margin-left:auto; background:rgba(255,255,255,.12);
    color:#D9D7EA; font-size:11px; font-weight:600;
    padding:1px 7px; border-radius:10px;
  }
  .nav-item.active .count{ background:rgba(255,255,255,.25); color:#fff; }

  .sidebar-foot{
    margin-top:auto; padding-top:14px; border-top:1px solid #2C2B40;
    display:flex; align-items:center; gap:10px; padding:12px 10px 4px;
  }
  .avatar{
    width:30px;height:30px;border-radius:50%;
    background:linear-gradient(135deg,#FF8A65,#FF5E62);
    display:flex;align-items:center;justify-content:center;
    color:#fff;font-weight:700;font-size:12px;flex-shrink:0;
  }
  .sidebar-foot .who{ font-size:12.5px; color:#fff; font-weight:600; line-height:1.2;}
  .sidebar-foot .role{ font-size:11px; color:#8C8AA0;}

  /* MAIN */
  .main{ flex:1; display:flex; flex-direction:column; min-width:0; }

  .topbar{
    height:60px; background:var(--card); border-bottom:1px solid var(--border);
    display:flex; align-items:center; justify-content:space-between;
    padding:0 24px; gap:16px; flex-shrink:0;
  }
  .search{
    flex:1; max-width:380px; display:flex; align-items:center; gap:8px;
    background:var(--bg); border:1px solid var(--border); border-radius:8px;
    padding:7px 12px; color:var(--ink-soft);
  }
  .search svg{ width:15px;height:15px; opacity:.6; flex-shrink:0;}
  .search input{ border:none; background:transparent; outline:none; font-size:13.5px; width:100%; font-family:inherit; color:var(--ink);}
  .topbar-actions{ display:flex; align-items:center; gap:10px; }
  .btn{
    border:none; cursor:pointer; font-family:inherit; font-weight:600; font-size:13px;
    border-radius:8px; padding:8px 14px; display:flex; align-items:center; gap:6px;
  }
  .btn-primary{ background:var(--purple); color:#fff; }
  .btn-primary:hover{ background:var(--purple-dark); }
  .btn-icon{
    width:34px;height:34px; border-radius:8px; background:var(--bg);
    border:1px solid var(--border); display:flex; align-items:center; justify-content:center;
    color:var(--ink-soft); cursor:pointer; position:relative;
  }
  .btn-icon svg{ width:16px;height:16px;}
  .dot-badge{
    position:absolute; top:6px; right:6px; width:7px; height:7px;
    background:var(--red); border-radius:50%; border:1.5px solid var(--card);
  }

  .content{ padding:26px 28px 40px; overflow-y:auto; }

  .page-head{ display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:22px; flex-wrap:wrap; gap:12px;}
  .page-head h1{ font-size:22px; font-weight:800; margin:0 0 4px; letter-spacing:-.2px;}
  .page-head p{ margin:0; color:var(--ink-soft); font-size:13.5px;}
  .breadcrumb{ font-size:12px; color:var(--ink-soft); margin-bottom:6px; display:flex; gap:6px; align-items:center;}
  .breadcrumb .sep{opacity:.5;}

  /* STAT CARDS */
  .stats{ display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:26px;}
  .stat-card{
    background:var(--card); border:1px solid var(--border); border-radius:var(--radius);
    padding:16px 18px; display:flex; flex-direction:column; gap:8px;
  }
  .stat-top{ display:flex; align-items:center; justify-content:space-between;}
  .stat-icon{ width:32px;height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center;}
  .stat-icon svg{ width:16px;height:16px;}
  .stat-icon.purple{ background:var(--purple-light); color:var(--purple-dark);}
  .stat-icon.blue{ background:var(--blue-light); color:var(--blue);}
  .stat-icon.green{ background:var(--green-light); color:var(--green);}
  .stat-icon.red{ background:var(--red-light); color:var(--red);}
  .stat-trend{ font-size:11.5px; font-weight:700; padding:2px 7px; border-radius:6px;}
  .stat-trend.up{ background:var(--green-light); color:var(--green);}
  .stat-trend.down{ background:var(--red-light); color:var(--red);}
  .stat-value{ font-size:24px; font-weight:800; letter-spacing:-.3px;}
  .stat-label{ font-size:12.5px; color:var(--ink-soft); font-weight:500;}

  /* BOARD */
  .section-title{ display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;}
  .section-title h2{ font-size:15px; font-weight:700; margin:0;}
  .link-btn{ background:none;border:none;color:var(--purple-dark); font-weight:600; font-size:12.5px; cursor:pointer; font-family:inherit;}

  .layout-grid{ display:grid; grid-template-columns:1.55fr 1fr; gap:18px; margin-bottom:26px;}

  .board{ display:grid; grid-template-columns:repeat(4,1fr); gap:14px;}
  .board-col{ background:#EFEFF5; border-radius:var(--radius); padding:12px; min-height:260px;}
  .board-col-head{ display:flex; align-items:center; gap:8px; margin-bottom:10px; padding:0 2px;}
  .board-col-dot{ width:8px;height:8px;border-radius:50%;}
  .board-col-head span.title{ font-size:12.5px; font-weight:700; }
  .board-col-head span.cnt{ margin-left:auto; font-size:11.5px; color:var(--ink-soft); background:#fff; border-radius:10px; padding:1px 7px;}

  .ticket{
    background:var(--card); border-radius:8px; padding:10px 12px; margin-bottom:8px;
    border:1px solid var(--border); cursor:pointer;
  }
  .ticket:hover{ border-color:var(--purple);}
  .ticket-id{ font-size:10.5px; color:var(--ink-soft); font-weight:700; letter-spacing:.03em; margin-bottom:5px;}
  .ticket-title{ font-size:12.5px; font-weight:600; line-height:1.35; margin-bottom:9px;}
  .ticket-foot{ display:flex; align-items:center; justify-content:space-between;}
  .tag{ font-size:10px; font-weight:700; padding:2px 7px; border-radius:5px; text-transform:uppercase; letter-spacing:.02em;}
  .tag.low{ background:var(--green-light); color:var(--green);}
  .tag.med{ background:var(--amber-light); color:var(--amber);}
  .tag.high{ background:var(--red-light); color:var(--red);}
  .mini-avatar{ width:20px;height:20px;border-radius:50%; background:var(--purple-light); color:var(--purple-dark);
    font-size:9.5px; font-weight:800; display:flex; align-items:center; justify-content:center;}

  /* ACTIVITY */
  .activity-card{ background:var(--card); border:1px solid var(--border); border-radius:var(--radius); padding:16px 18px;}
  .activity-item{ display:flex; gap:10px; padding:10px 0; border-bottom:1px solid var(--border);}
  .activity-item:last-child{ border-bottom:none; padding-bottom:0;}
  .activity-item:first-child{ padding-top:0;}
  .activity-dot{ width:30px;height:30px; border-radius:50%; flex-shrink:0; display:flex; align-items:center; justify-content:center;}
  .activity-text{ font-size:13px; line-height:1.4;}
  .activity-text b{ font-weight:700;}
  .activity-time{ font-size:11.5px; color:var(--ink-soft); margin-top:2px;}

  /* TABLE */
  .table-card{ background:var(--card); border:1px solid var(--border); border-radius:var(--radius); overflow:hidden;}
  table{ width:100%; border-collapse:collapse;}
  thead th{
    text-align:left; font-size:11.5px; text-transform:uppercase; letter-spacing:.05em;
    color:var(--ink-soft); font-weight:700; padding:11px 18px; background:#FAFAFD;
    border-bottom:1px solid var(--border);
  }
  tbody td{ padding:12px 18px; font-size:13px; border-bottom:1px solid var(--border); vertical-align:middle;}
  tbody tr:last-child td{ border-bottom:none;}
  tbody tr:hover{ background:#FAFAFD;}
  .prod-name{ font-weight:600; }
  .prod-sku{ color:var(--ink-soft); font-size:11.5px;}
  .status-chip{ font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; display:inline-block;}
  .status-chip.active{ background:var(--green-light); color:var(--green);}
  .status-chip.low{ background:var(--amber-light); color:var(--amber);}
  .status-chip.out{ background:var(--red-light); color:var(--red);}
  .status-chip.draft{ background:#EFEFF5; color:var(--ink-soft);}
  .qty-bar-wrap{ display:flex; align-items:center; gap:8px;}
  .qty-bar{ width:60px; height:6px; background:#EDEDF3; border-radius:4px; overflow:hidden;}
  .qty-bar-fill{ height:100%; border-radius:4px;}

  @media (max-width:980px){
    .stats{ grid-template-columns:repeat(2,1fr);}
    .layout-grid{ grid-template-columns:1fr;}
    .board{ grid-template-columns:repeat(2,1fr);}
    .sidebar{ display:none;}
  }
</style>
</head>
<body>
<div class="app">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="brand">
      <div class="brand-mark">P</div>
      <div class="brand-name">Product Hub</div>
    </div>

    <div class="nav-section">
      <div class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/></svg>
        Home
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        Products
        <span class="count">128</span>
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
        Boards
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        Tasks
        <span class="count">14</span>
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg>
        Reports
      </div>
    </div>

    <div class="nav-section">
      <div class="nav-label">Workspace</div>
      <div class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
        Settings
      </div>
    </div>

    <div class="sidebar-foot">
      <div class="avatar">AM</div>
      <div>
        <div class="who">Amulya</div>
        <div class="role">Product Manager</div>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <div class="topbar">
      <div class="search">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Search products, SKUs, tasks...">
      </div>
      <div class="topbar-actions">
        <button class="btn btn-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 1 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <span class="dot-badge"></span>
        </button>
        <button class="btn btn-primary">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" width="14" height="14"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          New Product
        </button>
        <div class="avatar" style="width:34px;height:34px;font-size:13px;">AM</div>
      </div>
    </div>

    <div class="content">
      <div class="breadcrumb">Workspace <span class="sep">/</span> Home</div>
      <div class="page-head">
        <div>
          <h1>Good morning, Amulya 👋</h1>
          <p>Here's what's happening across your product catalog today.</p>
        </div>
        <button class="btn" style="background:#fff;border:1px solid var(--border);color:var(--ink);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
          Refresh
        </button>
      </div>

      <!-- STATS -->
      <div class="stats">
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon purple">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
            </div>
            <div class="stat-trend up">+4.2%</div>
          </div>
          <div class="stat-value">128</div>
          <div class="stat-label">Total Products</div>
        </div>
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon green">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
            </div>
            <div class="stat-trend up">+1.8%</div>
          </div>
          <div class="stat-value">104</div>
          <div class="stat-label">Active Listings</div>
        </div>
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon red">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div class="stat-trend down">-2 today</div>
          </div>
          <div class="stat-value">9</div>
          <div class="stat-label">Low Stock Alerts</div>
        </div>
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon blue">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3z"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
            </div>
            <div class="stat-trend up">+1</div>
          </div>
          <div class="stat-value">12</div>
          <div class="stat-label">Categories</div>
        </div>
      </div>

      <!-- BOARD + ACTIVITY -->
      <div class="layout-grid">
        <div>
          <div class="section-title">
            <h2>Product Pipeline</h2>
            <button class="link-btn">View full board →</button>
          </div>
          <div class="board">
            <div class="board-col">
              <div class="board-col-head">
                <div class="board-col-dot" style="background:#9A98AB;"></div>
                <span class="title">Draft</span>
                <span class="cnt">5</span>
              </div>
              <div class="ticket">
                <div class="ticket-id">PRD-241</div>
                <div class="ticket-title">Wireless ANC Headphones — Gen 3</div>
                <div class="ticket-foot"><span class="tag med">Pending</span><span class="mini-avatar">RS</span></div>
              </div>
              <div class="ticket">
                <div class="ticket-id">PRD-238</div>
                <div class="ticket-title">Insulated Travel Mug 16oz</div>
                <div class="ticket-foot"><span class="tag low">Low</span><span class="mini-avatar">AM</span></div>
              </div>
            </div>
            <div class="board-col">
              <div class="board-col-head">
                <div class="board-col-dot" style="background:var(--blue);"></div>
                <span class="title">In Review</span>
                <span class="cnt">3</span>
              </div>
              <div class="ticket">
                <div class="ticket-id">PRD-233</div>
                <div class="ticket-title">Ergonomic Office Chair — Mesh Back</div>
                <div class="ticket-foot"><span class="tag high">Urgent</span><span class="mini-avatar">JT</span></div>
              </div>
              <div class="ticket">
                <div class="ticket-id">PRD-229</div>
                <div class="ticket-title">Stainless Cookware Set, 10-piece</div>
                <div class="ticket-foot"><span class="tag med">Pending</span><span class="mini-avatar">RS</span></div>
              </div>
            </div>
            <div class="board-col">
              <div class="board-col-head">
                <div class="board-col-dot" style="background:var(--amber);"></div>
                <span class="title">Low Stock</span>
                <span class="cnt">9</span>
              </div>
              <div class="ticket">
                <div class="ticket-id">PRD-204</div>
                <div class="ticket-title">Organic Cotton Bath Towel Set</div>
                <div class="ticket-foot"><span class="tag high">Restock</span><span class="mini-avatar">AM</span></div>
              </div>
              <div class="ticket">
                <div class="ticket-id">PRD-198</div>
                <div class="ticket-title">USB-C Fast Charger 65W</div>
                <div class="ticket-foot"><span class="tag med">Pending</span><span class="mini-avatar">JT</span></div>
              </div>
            </div>
            <div class="board-col">
              <div class="board-col-head">
                <div class="board-col-dot" style="background:var(--green);"></div>
                <span class="title">Published</span>
                <span class="cnt">104</span>
              </div>
              <div class="ticket">
                <div class="ticket-id">PRD-112</div>
                <div class="ticket-title">Bluetooth Mechanical Keyboard</div>
                <div class="ticket-foot"><span class="tag low">Live</span><span class="mini-avatar">RS</span></div>
              </div>
              <div class="ticket">
                <div class="ticket-id">PRD-097</div>
                <div class="ticket-title">Ceramic Plant Pot — Medium</div>
                <div class="ticket-foot"><span class="tag low">Live</span><span class="mini-avatar">AM</span></div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="section-title">
            <h2>Recent Activity</h2>
            <button class="link-btn">View all</button>
          </div>
          <div class="activity-card">
            <div class="activity-item">
              <div class="activity-dot" style="background:var(--green-light);color:var(--green);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M20 6L9 17l-5-5"/></svg>
              </div>
              <div>
                <div class="activity-text"><b>Rohit S.</b> marked <b>PRD-097</b> as Published</div>
                <div class="activity-time">12 minutes ago</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot" style="background:var(--amber-light);color:var(--amber);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg>
              </div>
              <div>
                <div class="activity-text"><b>PRD-204</b> dropped below reorder threshold</div>
                <div class="activity-time">48 minutes ago</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot" style="background:var(--purple-light);color:var(--purple-dark);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              </div>
              <div>
                <div class="activity-text"><b>Amulya</b> created product <b>PRD-241</b></div>
                <div class="activity-time">1 hour ago</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot" style="background:var(--blue-light);color:var(--blue);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              </div>
              <div>
                <div class="activity-text"><b>Jenny T.</b> updated price on <b>PRD-233</b></div>
                <div class="activity-time">2 hours ago</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot" style="background:var(--red-light);color:var(--red);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              </div>
              <div>
                <div class="activity-text"><b>PRD-198</b> went out of stock</div>
                <div class="activity-time">5 hours ago</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- TABLE -->
      <div class="section-title">
        <h2>Products Needing Attention</h2>
        <button class="link-btn">Open Products →</button>
      </div>
      <div class="table-card">
        <table>
          <thead>
            <tr>
              <th>Product</th>
              <th>Category</th>
              <th>Stock</th>
              <th>Price</th>
              <th>Status</th>
              <th>Updated</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="prod-name">Organic Cotton Bath Towel Set</div>
                <div class="prod-sku">SKU-10422 · PRD-204</div>
              </td>
              <td>Home & Bath</td>
              <td>
                <div class="qty-bar-wrap">
                  <div class="qty-bar"><div class="qty-bar-fill" style="width:14%;background:var(--red);"></div></div>
                  <span>3</span>
                </div>
              </td>
              <td>$24.99</td>
              <td><span class="status-chip out">Restock</span></td>
              <td>48m ago</td>
            </tr>
            <tr>
              <td>
                <div class="prod-name">USB-C Fast Charger 65W</div>
                <div class="prod-sku">SKU-22871 · PRD-198</div>
              </td>
              <td>Electronics</td>
              <td>
                <div class="qty-bar-wrap">
                  <div class="qty-bar"><div class="qty-bar-fill" style="width:8%;background:var(--red);"></div></div>
                  <span>0</span>
                </div>
              </td>
              <td>$19.49</td>
              <td><span class="status-chip out">Out of stock</span></td>
              <td>5h ago</td>
            </tr>
            <tr>
              <td>
                <div class="prod-name">Ergonomic Office Chair — Mesh Back</div>
                <div class="prod-sku">SKU-30911 · PRD-233</div>
              </td>
              <td>Furniture</td>
              <td>
                <div class="qty-bar-wrap">
                  <div class="qty-bar"><div class="qty-bar-fill" style="width:38%;background:var(--amber);"></div></div>
                  <span>12</span>
                </div>
              </td>
              <td>$189.00</td>
              <td><span class="status-chip low">Low stock</span></td>
              <td>2h ago</td>
            </tr>
            <tr>
              <td>
                <div class="prod-name">Wireless ANC Headphones — Gen 3</div>
                <div class="prod-sku">SKU-44120 · PRD-241</div>
              </td>
              <td>Electronics</td>
              <td>
                <div class="qty-bar-wrap">
                  <div class="qty-bar"><div class="qty-bar-fill" style="width:0%;background:var(--ink-soft);"></div></div>
                  <span>—</span>
                </div>
              </td>
              <td>$129.00</td>
              <td><span class="status-chip draft">Draft</span></td>
              <td>1h ago</td>
            </tr>
            <tr>
              <td>
                <div class="prod-name">Stainless Cookware Set, 10-piece</div>
                <div class="prod-sku">SKU-50032 · PRD-229</div>
              </td>
              <td>Kitchen</td>
              <td>
                <div class="qty-bar-wrap">
                  <div class="qty-bar"><div class="qty-bar-fill" style="width:62%;background:var(--green);"></div></div>
                  <span>34</span>
                </div>
              </td>
              <td>$149.99</td>
              <td><span class="status-chip active">In review</span></td>
              <td>3h ago</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
</body>
</html>