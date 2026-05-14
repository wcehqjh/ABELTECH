<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réinitialiser mot de passe – Abeltech</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      background: #0a0a0f;
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      width: 100%;
      max-width: 460px;
      margin: 20px;
      animation: fadeInUp 0.6s ease;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-card {
      background: rgba(17, 19, 24, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 32px;
      border: 1px solid rgba(0,212,255,0.15);
      padding: 48px 40px;
    }

    .brand-abel {
      font-family: 'Orbitron', monospace;
      font-size: 2.2rem;
      font-weight: 900;
      background: linear-gradient(135deg, #fff, #00d4ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .brand-tech {
      font-family: 'Orbitron', monospace;
      font-size: 2.2rem;
      font-weight: 900;
      color: #00d4ff;
    }

    .form-label-dark {
      display: block;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: rgba(255,255,255,0.6);
      margin-bottom: 8px;
    }

    .input-dark {
      width: 100%;
      background: rgba(0,0,0,0.4);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 16px;
      padding: 14px 18px;
      color: #fff;
      font-size: 14px;
      transition: all 0.3s;
    }

    .input-dark:focus {
      outline: none;
      border-color: #00d4ff;
      box-shadow: 0 0 0 4px rgba(0,212,255,0.15);
    }

    .btn-login {
      width: 100%;
      background: linear-gradient(135deg, #00d4ff, #7c3aed);
      border: none;
      padding: 16px;
      border-radius: 40px;
      color: #fff;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0,212,255,0.3);
    }

    .error-message {
      background: rgba(239,68,68,0.1);
      border: 1px solid rgba(239,68,68,0.3);
      border-radius: 14px;
      padding: 14px 18px;
      margin-bottom: 24px;
      color: #ef4444;
      font-size: 13px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="text-center mb-4">
        <span class="brand-abel">ABEL</span><span class="brand-tech">TECH</span>
        <div class="mt-2">
          <span style="font-size: 12px; color: rgba(255,255,255,0.4);">
            <i class="fas fa-lock me-1"></i> Nouveau mot de passe
          </span>
        </div>
      </div>

      @if($errors->any())
        <div class="error-message">
          <i class="fas fa-exclamation-triangle me-2"></i> {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('admin.reset.post') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="form-group mb-4">
          <label class="form-label-dark">Adresse email</label>
          <input type="email" name="email" class="input-dark" required>
        </div>

        <div class="form-group mb-4">
          <label class="form-label-dark">Nouveau mot de passe</label>
          <input type="password" name="password" class="input-dark" required>
        </div>

        <div class="form-group mb-4">
          <label class="form-label-dark">Confirmer le mot de passe</label>
          <input type="password" name="password_confirmation" class="input-dark" required>
        </div>

        <button type="submit" class="btn-login">
          <i class="fas fa-save me-2"></i> Réinitialiser
        </button>
      </form>
    </div>
  </div>
</body>
</html>
