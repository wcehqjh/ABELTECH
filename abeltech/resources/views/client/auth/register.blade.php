<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créer un compte - Abeltech</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { background: linear-gradient(135deg, #0a0a0f 0%, #0d0d14 50%, #0a0a0f 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; }
    .register-container { max-width: 520px; width: 100%; margin: 20px; animation: fadeInUp 0.6s ease; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .register-card { background: rgba(17, 19, 24, 0.95); backdrop-filter: blur(20px); border-radius: 32px; border: 1px solid rgba(0,212,255,0.15); padding: 48px 40px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); }
    .logo { text-align: center; margin-bottom: 32px; }
    .logo span { font-family: 'Orbitron', monospace; font-size: 2rem; font-weight: 900; }
    .logo .abel { background: linear-gradient(135deg, #fff, #00d4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .logo .tech { color: #00d4ff; }
    .register-title { text-align: center; margin-bottom: 32px; }
    .register-title h2 { font-size: 24px; font-weight: 700; color: #fff; margin-bottom: 8px; }
    .register-title p { font-size: 13px; color: rgba(255,255,255,0.5); }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.6); margin-bottom: 8px; }
    .form-control { width: 100%; background: rgba(0,0,0,0.4); border: 1.5px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 14px 18px; color: #fff; font-size: 14px; transition: all 0.3s; }
    .form-control:focus { outline: none; border-color: #00d4ff; box-shadow: 0 0 0 4px rgba(0,212,255,0.1); }
    .form-control.is-invalid { border-color: #ef4444; }
    .invalid-feedback { color: #ef4444; font-size: 12px; margin-top: 5px; display: block; }
    .btn-register { width: 100%; background: linear-gradient(135deg, #00d4ff, #7c3aed); border: none; padding: 14px; border-radius: 40px; color: #fff; font-weight: 700; font-size: 14px; transition: all 0.3s; margin-top: 10px; cursor: pointer; }
    .btn-register:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,212,255,0.3); }
    .login-link { text-align: center; margin-top: 24px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.05); }
    .login-link a { color: #00d4ff; text-decoration: none; font-weight: 600; }
    .error-message { background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); border-radius: 14px; padding: 12px 16px; margin-bottom: 20px; color: #ef4444; font-size: 13px; }
    .success-message { background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); border-radius: 14px; padding: 12px 16px; margin-bottom: 20px; color: #22c55e; font-size: 13px; }
    .phone-hint { font-size: 11px; color: rgba(255,255,255,0.3); margin-top: 5px; display: block; }
  </style>
</head>
<body>
  <div class="register-container">
    <div class="register-card">
      <div class="logo"><span class="abel">ABEL</span><span class="tech">TECH</span></div>
      <div class="register-title"><h2>Créer un compte</h2><p>Rejoignez la communauté Abeltech</p></div>
      
      @if(session('success'))
        <div class="success-message"><i class="fas fa-check-circle me-2"></i> {{ session('success') }}</div>
      @endif
      
      @if($errors->any())
        <div class="error-message">
          @foreach($errors->all() as $error)
            <i class="fas fa-exclamation-triangle me-2"></i> {{ $error }}<br>
          @endforeach
        </div>
      @endif
      
      <form method="POST" action="{{ route('client.register.post') }}" id="registerForm">
        @csrf
        
        <div class="form-group">
          <label class="form-label">Nom complet</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Téléphone</label>
          <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="+212 6 00 00 00 00" required>
          <small class="phone-hint"><i class="fas fa-info-circle"></i> Format: +212 6XXXXXXX ou 06XXXXXXXX</small>
          @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Mot de passe</label>
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Confirmer le mot de passe</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        
        <button type="submit" class="btn-register"><i class="fas fa-user-plus me-2"></i> Créer mon compte</button>
      </form>
      
      <div class="login-link">
        <p>Déjà inscrit ? <a href="{{ route('client.login') }}">Se connecter</a></p>
        <small style="color: rgba(255,255,255,0.3);">Espace client Abeltech</small>
      </div>
    </div>
  </div>
  
  <script>
    // تنسيق رقم الهاتف تلقائياً
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
      phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^0-9+]/g, '');
        if (value.length > 15) {
          value = value.substring(0, 15);
        }
        e.target.value = value;
      });
    }
  </script>
</body>
</html>
