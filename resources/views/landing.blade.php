<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Product Hub — Drop the paperwork.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --paper:#F2EAD9;
    --paper-deep:#E5DAC0;
    --desk:#C9B790;
    --desk-dark:#A88F61;
    --ink:#2B2520;
    --ink-soft:#766A57;
    --brand:#7B68EE;
    --brand-dark:#5E4ED8;
    --brand-light:#ECE8FF;
    --red:#B6432F;
    --tan:#CDA868;
  }
  *{ box-sizing:border-box; }
  html,body{ margin:0; }
  body{
    font-family:'Inter',sans-serif;
    background:var(--paper);
    color:var(--ink);
    -webkit-font-smoothing:antialiased;
  }
  h1,h2,h3{ font-family:'Fraunces',serif; margin:0; }
  a{ text-decoration:none; color:inherit; }

  .wrap{ max-width:1180px; margin:0 auto; padding:0 28px; }

  /* NAV */
  nav{ display:flex; align-items:center; justify-content:space-between; padding:22px 0; }
  .logo{ display:flex; align-items:center; gap:9px; font-weight:800; font-size:17px; letter-spacing:-.2px; }
  .logo-mark{ width:26px;height:26px;border-radius:7px; background:linear-gradient(135deg,var(--brand),#9C8CFF); flex-shrink:0; }
  .nav-links{ display:flex; gap:30px; font-size:14px; font-weight:600; color:var(--ink-soft); }
  .nav-links a:hover{ color:var(--ink); }
  .nav-cta{ background:var(--ink); color:var(--paper); padding:9px 18px; border-radius:8px; font-size:13.5px; font-weight:700; }
  .nav-cta:hover{ background:var(--brand-dark); }

  /* HERO */
  .hero{ display:grid; grid-template-columns:1fr 1.18fr; gap:50px; align-items:center; padding:48px 0 30px; }
  .eyebrow{
    display:inline-flex; align-items:center; gap:7px; font-size:12px; font-weight:700;
    color:var(--brand-dark); background:var(--brand-light); padding:5px 12px; border-radius:20px;
    margin-bottom:18px; letter-spacing:.02em;
  }
  .hero h1{ font-size:46px; line-height:1.08; font-weight:600; letter-spacing:-.5px; margin-bottom:18px; }
  .hero h1 em{ font-style:italic; color:var(--brand-dark); }
  .hero p.lead{ font-size:16.5px; color:var(--ink-soft); line-height:1.55; max-width:430px; margin-bottom:26px; }
  .hero-actions{ display:flex; align-items:center; gap:18px; }
  .btn-primary{
    background:var(--brand); color:#fff; font-weight:700; font-size:14.5px;
    padding:13px 22px; border-radius:9px; display:inline-flex; align-items:center; gap:8px;
  }
  .btn-primary:hover{ background:var(--brand-dark); }

  /* STAGE SIMPLIFIED */
  .stage-card{
    background:linear-gradient(180deg,var(--desk) 0%, var(--desk-dark) 100%);
    border-radius:22px; padding:14px;
  }
  .reveal{
    background:#fff; border-radius:14px; padding:24px;
    box-shadow:0 15px 30px rgba(0,0,0,0.1);
  }
  .reveal-top{ display:flex; align-items:center; gap:8px; margin-bottom:12px; }
  .reveal-dot{ width:9px;height:9px;border-radius:50%; }
  .reveal-bars{ display:flex; flex-direction:column; gap:7px; margin-bottom:14px; }
  .reveal-bar{ height:9px; border-radius:5px; background:var(--brand-light); }
  .reveal-bar span{ display:block; height:100%; border-radius:5px; background:var(--brand); }
  .reveal h3{ font-size:18px; font-weight:700; margin-bottom:8px; color:var(--ink); }
  .reveal p{ font-size:14px; color:var(--ink-soft); margin:0 0 16px; line-height:1.4; }
  .reveal-btn{
    display:inline-flex; align-items:center; gap:6px; background:var(--ink); color:#fff;
    font-size:13.5px; font-weight:700; padding:10px 16px; border-radius:7px;
  }
  .reveal-btn:hover{ background:var(--brand); }

  /* FEATURES */
  .features{ padding:78px 0 70px; border-top:1px solid var(--paper-deep); margin-top:30px; }
  .features-head{ max-width:480px; margin-bottom:40px; }
  .features-head .eyebrow{ margin-bottom:14px; }
  .features-head h2{ font-size:30px; font-weight:600; letter-spacing:-.4px; line-height:1.18; }
  .feature-grid{ display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
  .feature-card{ background:#fff; border:1px solid var(--paper-deep); border-radius:14px; padding:24px; }
  .feature-icon{ width:38px;height:38px; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:16px; }
  .feature-icon svg{ width:18px;height:18px; }
  .feature-card h3{ font-size:16px; font-weight:700; margin-bottom:8px; color:var(--ink); }
  .feature-card p{ font-size:13.5px; color:var(--ink-soft); line-height:1.5; margin:0; }

  footer{ border-top:1px solid var(--paper-deep); padding:26px 0 40px; display:flex; justify-content:space-between;
    align-items:center; font-size:12.5px; color:var(--ink-soft); }

  @media (max-width:880px){
    .hero{ grid-template-columns:1fr; }
    .feature-grid{ grid-template-columns:1fr; }
    .hero h1{ font-size:34px; }
  }
</style>
</head>
<body>

<div class="wrap">
  <nav>
    <a href="/" class="logo"><div class="logo-mark"></div>Product Hub</a>
    <div class="nav-links">
      <a href="#features">Features</a>
      <a href="/contact">Contact Us</a>
    </div>
    <a class="nav-cta" href="/register">Register</a>
  </nav>

  <section class="hero">
    <div>
      <div class="eyebrow"> Built for product teams</div>
      <h1>Stop running your<br>catalog on a <em>desk</em>.</h1>
      <p class="lead">Notebooks, sticky notes, a diary full of SKUs you can't read anymore. Move away from the mess—that's what switching to Product Hub feels like.</p>
      <div class="hero-actions">
        <a class="btn-primary" href="/register">Try it free
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" width="14" height="14"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>
    </div>

    <div class="stage-card">
      <div class="reveal">
        <div class="reveal-top">
          <div class="reveal-dot" style="background:#FF5F57;"></div>
          <div class="reveal-dot" style="background:#FEBC2E;"></div>
          <div class="reveal-dot" style="background:#28C840;"></div>
        </div>
        <div class="reveal-bars">
          <div class="reveal-bar"><span style="width:78%;"></span></div>
          <div class="reveal-bar"><span style="width:46%;"></span></div>
          <div class="reveal-bar"><span style="width:62%;"></span></div>
        </div>
        <h3>One dashboard. Zero paper.</h3>
        <p>One workspace for every product, stock level, and price update. No paperwork required.</p>
        <a class="reveal-btn" href="/dashboard">Open Product Hub →</a>
      </div>
    </div>
  </section>

  <section class="features" id="features">
    <div class="features-head">
      <div class="eyebrow"> Why teams switch</div>
      <h2>Everything that used to live on paper, now lives in one place.</h2>
    </div>
    <div class="feature-grid">
      <div class="feature-card">
        <div class="feature-icon" style="background:var(--brand-light);color:var(--brand-dark);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        </div>
        <h3>One catalog, not three notebooks</h3>
        <p>Every SKU, price, and variant lives in a single searchable place — not scattered across whatever was closest when you wrote it down.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon" style="background:#FDEFE9;color:#B6432F;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <h3>Stock alerts that don't rely on memory</h3>
        <p>Get notified the moment something runs low — instead of finding out when a sticky note falls behind the desk.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon" style="background:#EAF6EE;color:#1F9D55;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg>
        </div>
        <h3>Reports you can actually hand someone</h3>
        <p>Skip the photo of a diary page. Export clean, shareable reports straight from your live product data.</p>
      </div>
    </div>
  </section>

  <footer>
    <div>© 2026 Product Hub</div>
    <div>Made for teams who lost a notebook once</div>
  </footer>
</div>

</body>
</html>