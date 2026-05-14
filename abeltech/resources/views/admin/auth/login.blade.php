<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login – Abeltech</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #0a0a0f;
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow-x: hidden;
      position: relative;
    }

    /* Effets de fond dynamiques */
    .bg-animation {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      overflow: hidden;
    }

    .gradient-bg {
      position: absolute;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle at 20% 50%, rgba(0,212,255,0.15) 0%, transparent 50%),
                  radial-gradient(circle at 80% 80%, rgba(124,58,237,0.15) 0%, transparent 50%);
      animation: rotateBg 20s ease-in-out infinite;
    }

    @keyframes rotateBg {
      0%, 100% { transform: translate(-10%, -10%) rotate(0deg); }
      50% { transform: translate(10%, 10%) rotate(5deg); }
    }

    .particles {
      position: absolute;
      width: 100%;
      height: 100%;
    }

    .particle {
      position: absolute;
      width: 3px;
      height: 3px;
      background: rgba(0,212,255,0.5);
      border-radius: 50%;
      animation: floatParticle 8s infinite linear;
    }

    @keyframes floatParticle {
      0% { transform: translateY(100vh) scale(0); opacity: 0; }
      10% { opacity: 0.5; }
      90% { opacity: 0.5; }
      100% { transform: translateY(-100vh) scale(1); opacity: 0; }
    }

    /* Glass card principale */
    .login-container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 460px;
      margin: 20px;
      animation: floatCard 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }

    @keyframes floatCard {
      0% {
        opacity: 0;
        transform: scale(0.95) translateY(30px);
      }
      100% {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    .login-card {
      background: rgba(17, 19, 24, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 32px;
      border: 1px solid rgba(0,212,255,0.15);
      padding: 48px 40px;
      box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(0,212,255,0.05);
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
    }

    .login-card::before {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      background: linear-gradient(135deg, #00d4ff, #7c3aed, #00d4ff);
      border-radius: 32px;
      opacity: 0;
      transition: opacity 0.4s;
      z-index: -1;
    }

    .login-card:hover::before {
      opacity: 0.15;
    }

    .login-card:hover {
      transform: translateY(-5px);
      border-color: rgba(0,212,255,0.3);
      box-shadow: 0 35px 60px -15px rgba(0,212,255,0.2);
    }

    /* Logo */
    .login-logo {
      text-align: center;
      margin-bottom: 32px;
      position: relative;
    }

    .brand-abel {
      font-family: 'Orbitron', monospace;
      font-size: 2.2rem;
      font-weight: 900;
      background: linear-gradient(135deg, #fff, #00d4ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -1px;
    }

    .brand-tech {
      font-family: 'Orbitron', monospace;
      font-size: 2.2rem;
      font-weight: 900;
      color: #00d4ff;
      letter-spacing: -1px;
    }

    .logo-badge {
      display: inline-block;
      background: rgba(0,212,255,0.15);
      border: 1px solid rgba(0,212,255,0.3);
      border-radius: 50px;
      padding: 4px 12px;
      font-size: 10px;
      color: #00d4ff;
      margin-top: 10px;
      font-weight: 600;
    }

    /* Titre */
    .login-title {
      text-align: center;
      color: rgba(255,255,255,0.5);
      font-size: 13px;
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .login-title i {
      color: #00d4ff;
      font-size: 14px;
    }

    .login-title::before,
    .login-title::after {
      content: '';
      flex: 1;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(0,212,255,0.3), transparent);
    }

    .login-title::before {
      margin-right: 15px;
    }

    .login-title::after {
      margin-left: 15px;
    }

    /* Formulaires */
    .form-group {
      margin-bottom: 24px;
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
      background: rgba(0,0,0,0.6);
    }

    .input-dark::placeholder {
      color: rgba(255,255,255,0.2);
    }

    /* Password toggle */
    .password-wrapper {
      position: relative;
    }

    .password-wrapper input {
      padding-right: 50px;
    }

    .toggle-password {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: rgba(255,255,255,0.4);
      cursor: pointer;
      transition: color 0.2s;
    }

    .toggle-password:hover {
      color: #00d4ff;
    }

    /* Bouton */
    .btn-login {
      width: 100%;
      background: linear-gradient(135deg, #00d4ff, #7c3aed);
      border: none;
      padding: 16px;
      border-radius: 40px;
      color: #fff;
      font-weight: 700;
      font-size: 14px;
      letter-spacing: 1px;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-top: 8px;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0,212,255,0.3);
      filter: brightness(1.05);
    }

    /* Error message */
    .error-message {
      background: rgba(239,68,68,0.1);
      border: 1px solid rgba(239,68,68,0.3);
      border-radius: 14px;
      padding: 14px 18px;
      margin-bottom: 24px;
      color: #ef4444;
      font-size: 13px;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: shake 0.4s ease;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }

    /* Footer */
    .login-footer {
      text-align: center;
      margin-top: 28px;
      padding-top: 20px;
      border-top: 1px solid rgba(255,255,255,0.05);
    }

    .login-footer p {
      font-size: 11px;
      color: rgba(255,255,255,0.3);
    }

    /* Stats mini */
    .stats-mini {
      display: flex;
      justify-content: center;
      gap: 24px;
      margin-top: 20px;
    }

    .stat-item {
      text-align: center;
    }

    .stat-number {
      font-family: 'Orbitron', monospace;
      font-size: 18px;
      font-weight: 700;
      color: #00d4ff;
    }

    .stat-label {
      font-size: 9px;
      color: rgba(255,255,255,0.3);
      text-transform: uppercase;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .login-card {
        padding: 32px 24px;
      }
      .brand-abel, .brand-tech {
        font-size: 1.8rem;
      }
      .stats-mini {
        gap: 16px;
      }
    }
  </style>
</head>
<body>

  {{-- Animation de fond --}}
  <div class="bg-animation">
    <div class="gradient-bg"></div>
    <div class="particles" id="particles"></div>
  </div>

  <div class="login-container">
    <div class="login-card">
      
      {{-- Logo --}}
      <div class="login-logo">
        <span class="brand-abel">ABEL</span><span class="brand-tech">TECH</span>
        <div class="logo-badge">
          <i class="fas fa-shield-alt me-1"></i> ADMIN PANEL
        </div>
      </div>

      {{-- Titre --}}
      <div class="login-title">
        <i class="fas fa-lock"></i> Espace sécurisé
        <i class="fas fa-lock"></i>
      </div>

      {{-- Erreur --}}
      @if($errors->any())
        <div class="error-message">
          <i class="fas fa-exclamation-triangle"></i>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      {{-- Formulaire --}}
      <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        
        <div class="form-group">
          <label class="form-label-dark">
            <i class="fas fa-envelope me-1"></i> Adresse email
          </label>
          <input type="email" name="email" class="input-dark" 
                 value="{{ old('email') }}" placeholder="EMAIL" required autofocus>
        </div>

        <div class="form-group">
          <label class="form-label-dark">
            <i class="fas fa-key me-1"></i> Mot de passe
          </label>
          <div class="password-wrapper">
            <input type="password" name="password" id="passwordInput" class="input-dark" 
                   placeholder="••••••••" required>
            <button type="button" class="toggle-password" onclick="togglePassword()">
              <i class="fas fa-eye" id="toggleIcon"></i>
            </button>
          </div>
        </div>
        <div class="text-center mt-3">
    <a href="{{ route('admin.forgot') }}" class="btn-link" style="font-size: 12px;">
        <i class="fas fa-key me-1"></i> Mot de passe oublié ?
    </a>
</div>

        <button type="submit" class="btn-login">
          <i class="fas fa-sign-in-alt"></i>
          Se connecter
          <i class="fas fa-arrow-right"></i>
        </button>
      </form>

      {{-- Footer --}}
      <div class="login-footer">
        <div class="stats-mini">
          <div class="stat-item">
            <div class="stat-number">256-bit</div>
            <div class="stat-label">Chiffrement SSL</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Sécurité</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">2FA</div>
            <div class="stat-label">Protection</div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <script>
    // Toggle password visibility
    function togglePassword() {
      const input = document.getElementById('passwordInput');
      const icon = document.getElementById('toggleIcon');
      
      if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
      } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
      }
    }

    // Création des particules animées
    function createParticles() {
      const container = document.getElementById('particles');
      if (!container) return;
      
      const particleCount = 50;
      
      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 8 + 's';
        particle.style.animationDuration = 4 + Math.random() * 6 + 's';
        particle.style.width = (Math.random() * 4 + 1) + 'px';
        particle.style.height = particle.style.width;
        particle.style.background = `rgba(0, 212, 255, ${Math.random() * 0.5 + 0.2})`;
        container.appendChild(particle);
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      createParticles();
    });
  </script>
</body>
</html>
