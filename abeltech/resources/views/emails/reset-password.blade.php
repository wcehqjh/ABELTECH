<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réinitialisation mot de passe</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: #0a0a0f;">
  <div style="max-width: 600px; margin: 0 auto; background: #111318; border-radius: 20px; overflow: hidden; border: 1px solid rgba(0,212,255,0.2);">
    
    {{-- Header --}}
    <div style="background: linear-gradient(135deg, #0a0a0f, #111318); padding: 30px; text-align: center; border-bottom: 1px solid rgba(0,212,255,0.15);">
      <h1 style="font-family: 'Orbitron', monospace; font-size: 28px; margin: 0;">
        <span style="color: #fff;">ABEL</span><span style="color: #00d4ff;">TECH</span>
      </h1>
      <p style="color: #00d4ff; font-size: 12px; margin-top: 10px;">Administration sécurisée</p>
    </div>

    {{-- Body --}}
    <div style="padding: 40px 30px;">
      <h2 style="color: #fff; font-size: 22px; margin-bottom: 15px;">Réinitialisation du mot de passe</h2>
      
      <p style="color: rgba(255,255,255,0.7); line-height: 1.6; margin-bottom: 25px;">
        Vous avez demandé à réinitialiser votre mot de passe pour votre compte administrateur Abeltech. Cliquez sur le bouton ci-dessous pour créer un nouveau mot de passe.
      </p>

      <div style="text-align: center; margin: 35px 0;">
        <a href="{{ route('admin.reset', $token) }}?email={{ urlencode($email) }}" 
           style="display: inline-block; background: linear-gradient(135deg, #00d4ff, #7c3aed); color: #fff; text-decoration: none; padding: 14px 32px; border-radius: 40px; font-weight: 600;">
          <i class="fas fa-key" style="margin-right: 8px;"></i> Réinitialiser mon mot de passe
        </a>
      </div>

      <p style="color: rgba(255,255,255,0.5); font-size: 13px; line-height: 1.5;">
        Si vous n'avez pas demandé cette réinitialisation, ignorez cet email. Votre mot de passe restera inchangé.
      </p>

      <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
        <p style="color: rgba(255,255,255,0.3); font-size: 11px;">
          Ce lien expirera dans 24 heures.<br>
          &copy; 2026 Abeltech. Tous droits réservés.
        </p>
      </div>
    </div>
  </div>
</body>
</html>
