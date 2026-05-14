<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message - Abeltech</title>
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; background: #0a0a0f; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #111318; border-radius: 24px; overflow: hidden; border: 1px solid rgba(0,212,255,0.2); box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
        
        {{-- Header --}}
        <div style="background: linear-gradient(135deg, #0a0a0f, #111318); padding: 30px; text-align: center; border-bottom: 1px solid rgba(0,212,255,0.15);">
            <h1 style="font-family: 'Orbitron', monospace; font-size: 28px; margin: 0;">
                <span style="color: #fff;">ABEL</span><span style="color: #00d4ff;">TECH</span>
            </h1>
            <p style="color: #00d4ff; font-size: 12px; margin-top: 10px; letter-spacing: 2px;">NOUVEAU MESSAGE</p>
        </div>

        {{-- Body --}}
        <div style="padding: 30px;">
            <div style="margin-bottom: 25px; background: #1a1c24; border-radius: 16px; padding: 20px;">
                <h3 style="color: #00d4ff; margin-bottom: 20px; font-size: 16px;">📋 INFORMATIONS DU CLIENT</h3>
                
                <div style="margin-bottom: 15px;">
                    <div style="color: #666; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">👤 Nom complet</div>
                    <div style="color: #fff; font-size: 15px; font-weight: 500; margin-top: 5px;">{{ $name }}</div>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <div style="color: #666; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">📧 Email</div>
                    <div style="color: #fff; font-size: 15px; margin-top: 5px;">
                        <a href="mailto:{{ $email }}" style="color: #00d4ff; text-decoration: none;">{{ $email }}</a>
                    </div>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <div style="color: #666; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">📞 Téléphone</div>
                    <div style="color: #fff; font-size: 15px; margin-top: 5px;">
                        <a href="tel:{{ $phone }}" style="color: #22c55e; text-decoration: none;">{{ $phone }}</a>
                    </div>
                </div>
            </div>

            <div style="background: #1a1c24; border-radius: 16px; padding: 20px;">
                <h3 style="color: #00d4ff; margin-bottom: 15px; font-size: 16px;">💬 MESSAGE</h3>
                <div style="background: #0f1117; padding: 16px; border-radius: 12px; margin-top: 5px;">
                    <p style="color: #ccc; line-height: 1.6; margin: 0; white-space: pre-wrap;">{{ nl2br(e($user_message)) }}</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div style="background: #0d0f13; padding: 20px; text-align: center; border-top: 1px solid rgba(0,212,255,0.1);">
            <p style="color: #555; font-size: 11px; margin: 0;">
                <i class="fas fa-envelope"></i> Ce message a été envoyé depuis le formulaire de contact d'Abeltech
            </p>
            <p style="color: #444; font-size: 10px; margin-top: 10px;">
                © 2026 Abeltech - Votre boutique tech au Maroc
            </p>
        </div>
    </div>
</body>
</html>
