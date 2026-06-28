<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us — Product Hub</title>
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

  /* HERO / CONTACT SPLIT */
  .contact-hero{ display:grid; grid-template-columns:1fr 1.18fr; gap:50px; align-items:start; padding:48px 0 70px; }
  .eyebrow{
    display:inline-flex; align-items:center; gap:7px; font-size:12px; font-weight:700;
    color:var(--brand-dark); background:var(--brand-light); padding:5px 12px; border-radius:20px;
    margin-bottom:18px; letter-spacing:.02em;
  }
  .contact-hero h1{ font-size:46px; line-height:1.08; font-weight:600; letter-spacing:-.5px; margin-bottom:18px; }
  .contact-hero p.lead{ font-size:16.5px; color:var(--ink-soft); line-height:1.55; max-width:430px; margin-bottom:36px; }

  /* QUICK CHAT CHIPS */
  .info-channels{ display:flex; flex-direction:column; gap:16px; max-width:430px; }
  .channel-card{ display:flex; align-items:center; gap:14px; background:var(--paper-deep); padding:16px; border-radius:12px; }
  .channel-icon{ width:36px; height:36px; border-radius:8px; background:#fff; display:flex; align-items:center; justify-content:center; color:var(--brand-dark); }
  .channel-icon svg{ width:18px; height:18px; }
  .channel-details h3{ font-size:14px; font-weight:700; color:var(--ink); }
  .channel-details p{ font-size:13px; color:var(--ink-soft); margin:2px 0 0; }

  /* CONTACT FORM CARD */
  .form-card{
    background:#fff; border-radius:22px; padding:32px;
    box-shadow:0 15px 30px rgba(0,0,0,0.05);
    border:1px solid var(--paper-deep);
  }
  .form-group{ margin-bottom:20px; }
  .form-group label{ display:block; font-size:13px; font-weight:700; color:var(--ink); margin-bottom:8px; }
  .form-control{
    width:100%; border:1px solid var(--paper-deep); background:var(--paper);
    border-radius:8px; padding:12px 16px; font-family:'Inter', sans-serif; font-size:14px;
    color:var(--ink); outline:none; transition: border-color 0.2s;
  }
  .form-control:focus { border-color:var(--brand); }
  textarea.form-control{ resize:vertical; min-height:110px; }
  
  .btn-submit{
    width:100%; background:var(--brand); color:#fff; font-weight:700; font-size:14.5px;
    padding:14px; border-radius:9px; border:none; cursor:pointer; display:inline-flex;
    align-items:center; justify-content:center; gap:8px;
  }
  .btn-submit:hover{ background:var(--brand-dark); }

  footer{ border-top:1px solid var(--paper-deep); padding:26px 0 40px; display:flex; justify-content:space-between;
    align-items:center; font-size:12.5px; color:var(--ink-soft); }

  @media (max-width:880px){
    .contact-hero{ grid-template-columns:1fr; gap:40px; }
  }
</style>
</head>
<body>

<div class="wrap">
  <nav>
    <div class="logo"><div class="logo-mark"></div>Product Hub</div>
    <div class="nav-links">
      <a href="/">Features</a>
      <a href="/contact">Contact Us</a>
    </div>
    <a class="nav-cta" href="#">Register</a>
  </nav>

  <section class="contact-hero">
    <div>
      <div class="eyebrow"> Get in touch</div>
      <h1>We're here to help you drop paper.</h1>
      <p class="lead">Have questions about setting up your digital product catalog? Drop us a note and our team will get back to you within a few business hours.</p>
      
      <div class="info-channels">
        <div class="channel-card">
          <div class="channel-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div class="channel-details">
            <h3>Email Support</h3>
            <p>support@producthub.com</p>
          </div>
        </div>
        <div class="channel-card">
          <div class="channel-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </div>
          <div class="channel-details">
            <h3>Live Workspace Chat</h3>
            <p>Available directly inside your dashboard</p>
          </div>
        </div>
      </div>
    </div>

    <div class="form-card">
      <form action="#" method="POST">
        <div class="form-group">
          <label for="name">Your Name</label>
          <input type="text" id="name" name="name" class="form-control" placeholder="Sarah Jenkins" required>
        </div>
        <div class="form-group">
          <label for="email">Work Email</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="sarah@company.com" required>
        </div>
        <div class="form-group">
          <label for="message">How can we help your team?</label>
          <textarea id="message" name="message" class="form-control" placeholder="Tell us about your current workflow..." required></textarea>
        </div>
        <button type="submit" class="btn-submit">
          Send Message
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" width="14" height="14"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>
      </form>
    </div>
  </section>

  <footer>
    <div>© 2026 Product Hub</div>
    <div>Made for teams who lost a notebook once</div>
  </footer>
</div>

</body>
</html>