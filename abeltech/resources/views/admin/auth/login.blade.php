<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login – Abeltech</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <style>
    body { background:#0a0b0f; display:flex; align-items:center; justify-content:center; min-height:100vh; }
    .login-card {
      background:#111318; border:1.5px solid rgba(255,255,255,0.07);
      border-radius:20px; padding:48px 40px; width:100%; max-width:420px;
    }
    .login-logo { text-align:center; margin-bottom:32px; }
    .brand-abel { color:#fff; font-size:1.8rem; font-weight:800; }
    .brand-tech { color:#00d4ff; font-size:1.8rem; font-weight:800; }
    .login-title { text-align:center; color:#fff; font-size:1.1rem; margin-bottom:28px; color:#7a8599; }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="login-logo">
      <span class="brand-abel">Abel</span><span class="brand-tech">tech</span>
    </div>
    <p class="login-title"><i class="fas fa-shield-alt me-2" style="color:#00d4ff"></i>Espace Administration</p>

    @if($errors->any())
      <div style="background:rgba(255,87,87,.1);border:1px solid rgba(255,87,87,.3);color:#ff5757;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:.88rem">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf
      <div class="mb-4">
        <label class="form-label-dark">Email</label>
        <input type="email" name="email" class="input-dark"
          value="{{ old('email') }}" placeholder="admin@abeltech.ma" required autofocus>
      </div>
      <div class="mb-4">
        <label class="form-label-dark">Mot de passe</label>
        <div style="position:relative">
          <input type="password" name="password" id="passInput" class="input-dark"
            placeholder="••••••••" required style="padding-right:44px">
          <button type="button" onclick="togglePass()"
            style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;color:#7a8599;cursor:pointer">
            <i class="fas fa-eye" id="passIcon"></i>
          </button>
        </div>
      </div>
      <button type="submit" class="btn-glow w-100 mt-2" style="justify-content:center;padding:14px">
        <i class="fas fa-sign-in-alt me-2"></i> Se connecter
      </button>
    </form>
  </div>
  <script>
    function togglePass() {
      const input = document.getElementById('passInput');
      const icon  = document.getElementById('passIcon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
      } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
      }
    }
  </script>
</body>
</html>