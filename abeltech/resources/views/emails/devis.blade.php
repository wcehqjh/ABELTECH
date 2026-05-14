<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle demande de devis - Abeltech</title>
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; background: #0a0a0f; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #111318; border-radius: 24px; overflow: hidden; border: 1px solid rgba(0,212,255,0.2);">
        
        <div style="background: linear-gradient(135deg, #0a0a0f, #111318); padding: 30px; text-align: center; border-bottom: 1px solid rgba(0,212,255,0.15);">
            <h1 style="font-family: 'Orbitron', monospace; font-size: 28px; margin: 0;">
                <span style="color: #fff;">ABEL</span><span style="color: #00d4ff;">TECH</span>
            </h1>
            <p style="color: #00d4ff; font-size: 12px; margin-top: 10px;">NOUVELLE DEMANDE DE DEVIS</p>
        </div>

        <div style="padding: 30px;">
            <div style="margin-bottom: 25px; background: #1a1c24; border-radius: 16px; padding: 20px;">
                <h3 style="color: #00d4ff; margin-bottom: 20px;">📋 INFORMATIONS CLIENT</h3>
                
                <div style="margin-bottom: 15px;">
                    <div style="color: #666; font-size: 11px; text-transform: uppercase;">👤 Nom complet</div>
                    <div style="color: #fff; font-size: 15px;">{{ $name }}</div>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <div style="color: #666; font-size: 11px; text-transform: uppercase;">📧 Email</div>
                    <div style="color: #fff; font-size: 15px;">{{ $email }}</div>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <div style="color: #666; font-size: 11px; text-transform: uppercase;">📞 Téléphone</div>
                    <div style="color: #fff; font-size: 15px;">{{ $phone }}</div>
                </div>
            </div>

            <div style="background: #1a1c24; border-radius: 16px; padding: 20px; margin-bottom: 25px;">
                <h3 style="color: #00d4ff; margin-bottom: 20px;">📝 DÉTAILS DE LA DEMANDE</h3>
                
                <div style="margin-bottom: 15px;">
                    <div style="color: #666; font-size: 11px; text-transform: uppercase;">🛠️ Service demandé</div>
                    <div style="color: #fff; font-size: 15px;">{{ $service }}</div>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <div style="color: #666; font-size: 11px; text-transform: uppercase;">💰 Budget estimé</div>
                    <div style="color: #fff; font-size: 15px;">{{ $budget }}</div>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <div style="color: #666; font-size: 11px; text-transform: uppercase;">⏰ Délai souhaité</div>
                    <div style="color: #fff; font-size: 15px;">{{ $deadline }}</div>
                </div>
            </div>

            <div style="background: #1a1c24; border-radius: 16px; padding: 20px;">
                <h3 style="color: #00d4ff; margin-bottom: 15px;">💬 Description du projet</h3>
                <div style="background: #0f1117; padding: 16px; border-radius: 12px;">
                    <p style="color: #ccc; line-height: 1.6; margin: 0; white-space: pre-wrap;">{{ nl2br(e($description)) }}</p>
                </div>
            </div>
        </div>

        <div style="background: #0d0f13; padding: 20px; text-align: center; border-top: 1px solid rgba(0,212,255,0.1);">
            <p style="color: #555; font-size: 11px;">Cette demande a été envoyée depuis le formulaire de devis d'Abeltech</p>
        </div>
    </div>
</body>
</html>
