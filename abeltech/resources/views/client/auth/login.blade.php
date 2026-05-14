<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion Client - Abeltech</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    body {
      background: linear-gradient(135deg, #0a0a0f 0%, #0d0d14 50%, #0a0a0f 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Inter', sans-serif;
    }
    .login-container { max-width: 480px; width: 100%; margin: 20px; animation: fadeInUp 0.6s ease; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .login-card {
      background: rgba(17, 19, 24, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 32px;
      border: 1px solid rgba(0,212,255,0.15);
      padding: 48px 40px;
      box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
    }
    .logo { text-align: center; margin-bottom: 32px; }
    .logo span { font-family: 'Orbitron', monospace; font-size: 2rem; font-weight: 900; }
    .logo .abel { background: linear-gradient(135deg, #fff, #00d4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .logo .tech { color: #00d4ff; }
    .login-title { text-align: center; margin-bottom: 32px; }
    .login-title h2 { font-size: 24px; font-weight: 700; color: #fff; margin-bottom: 8px; }
    .login-title p { font-size: 13px; color: rgba(255,255,255,0.5); }
    .form-group { margin-bottom: 24px; }
    .form-label { display: block; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.6); margin-bottom: 8px; }
    .form-control {
      width: 100%;
      background: rgba(0,0,0,0.4);
      border: 1.5px solid rgba(255,255,255,0.08);
      border-radius: 16px;
      padding: 14px 18px;
      color: #fff;
      font-size: 14px;
      transition: all 0.3s;
    }
    .form-control:focus { outline: none; border-color: #00d4ff; box-shadow: 0 0 0 4px rgba(0,212,255,0.1); }
    .btn-login {
      width: 100%;
      background: linear-gradient(135deg, #00d4ff, #7c3aed);
      border: none;
      padding: 14px;
      border-radius: 40px;
      color: #fff;
      font-weight: 700;
      font-size: 14px;
      transition: all 0.3s;
    }
    .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,212,255,0.3); }
    .register-link { text-align: center; margin-top: 24px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.05); }
    .register-link a { color: #00d4ff; text-decoration: none; font-weight: 600; }
    .error-message { background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); border-radius: 14px; padding: 12px 16px; margin-bottom: 20px; color: #ef4444; font-size: 13px; }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="logo"><span class="abel">ABEL</span><span class="tech">TECH</span></div>
      <div class="login-title"><h2>Connexion Client</h2><p>Accédez à votre espace personnel</p></div>
      @if($errors->any())
        <div class="error-message"><i class="fas fa-exclamation-triangle me-2"></i> {{ $errors->first() }}</div>
      @endif
      <form method="POST" action="{{ route('client.login.post') }}">
        @csrf
        <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus></div>
        <div class="form-group"><label class="form-label">Mot de passe</label><input type="password" name="password" class="form-control" required></div>
        <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt me-2"></i> Se connecter</button>
      </form>
      <div class="register-link"><p>Pas encore de compte ? <a href="{{ route('client.register') }}">Créer un compte</a></p><small style="color: rgba(255,255,255,0.3);">Espace client Abeltech</small></div>
    </div>
  </div>
</body>
</html>
