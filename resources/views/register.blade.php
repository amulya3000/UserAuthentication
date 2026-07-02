<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register — Product Hub</title>
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

  .btn-primary{
    background:var(--brand); color:#fff; font-weight:700; font-size:14.5px;
    padding:13px 22px; border-radius:9px; display:inline-flex; align-items:center; gap:8px;
    border: none; cursor: pointer; transition: background 0.2s;
  }
  .btn-primary:hover{ background:var(--brand-dark); }
  
  /* AUTH FORMS */
  .auth-container {
    max-width: 440px;
    margin: 60px auto 100px;
  }
  .auth-card {
    background: #fff;
    border: 1px solid var(--paper-deep);
    border-radius: 14px;
    padding: 40px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.05);
  }
  .auth-header {
    margin-bottom: 30px;
    text-align: center;
  }
  .auth-header h2 {
    font-size: 28px;
    color: var(--ink);
    margin-bottom: 8px;
  }
  .auth-header p {
    color: var(--ink-soft);
    font-size: 15px;
    margin: 0;
  }
  .form-group {
    margin-bottom: 20px;
  }
  .form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 8px;
  }
  .form-control {
    width: 100%;
    padding: 12px 16px;
    font-size: 15px;
    border: 1px solid var(--paper-deep);
    border-radius: 8px;
    background: var(--paper);
    color: var(--ink);
    font-family: inherit;
    transition: all 0.2s;
  }
  .form-control:focus {
    outline: none;
    border-color: var(--brand);
    background: #fff;
    box-shadow: 0 0 0 3px var(--brand-light);
  }
  .btn-block {
    width: 100%;
    justify-content: center;
    margin-top: 10px;
  }
  .auth-footer {
    margin-top: 24px;
    text-align: center;
    font-size: 14px;
    color: var(--ink-soft);
  }
  .auth-footer a {
    color: var(--brand);
    font-weight: 600;
  }
  .auth-footer a:hover {
    color: var(--brand-dark);
  }
  .alert-danger {
    background: #FDEFE9;
    color: var(--red);
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 24px;
    font-size: 14px;
    border: 1px solid rgba(182, 67, 47, 0.2);
  }
  .alert-danger ul {
    margin: 0;
    padding-left: 20px;
  }
</style>
</head>
<body>

<div class="wrap">
  <nav>
    <a href="/" class="logo"><div class="logo-mark"></div>Product Hub</a>
  </nav>

  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h2>Create an account</h2>
        <p>Start organizing your product catalog.</p>
      </div>

      @if ($errors->any())
        <div class="alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('registerSave') }}" method="POST">
        @csrf 

        <div class="form-group">
          <label for="username" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="username" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
          <label for="userage" class="form-label">Age</label>
          <input type="number" name="age" class="form-control" id="userage" value="{{ old('age') }}" required>
        </div>

        <div class="form-group">
          <label for="role" class="form-label">Select Role</label>
          <select name="role" id="role" class="form-control" required>
              <option value="employee">Employee</option>
              <option value="admin">Admin</option>
          </select>
        </div>

        <div class="form-group">
          <label for="useremail" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="useremail" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
          <label for="userpassword" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="userpassword" required>
        </div>

        <div class="form-group">
          <label for="userpassword-confirm" class="form-label">Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-control" id="userpassword-confirm" required>
        </div>

        <button type="submit" class="btn-primary btn-block">Register</button>
      </form>
      <div class="auth-footer">
        Already have an account? <a href="/login">Log in</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>