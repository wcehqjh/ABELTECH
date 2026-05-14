@extends('layouts.admin')

@section('title', 'Message de ' . $message->name)

@section('content')
<style>
.message-card {
    background: rgba(18, 20, 27, 0.9);
    border-radius: 20px;
    border: 1px solid rgba(0, 212, 255, 0.1);
    overflow: hidden;
}

.message-header {
    padding: 20px 24px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.message-header h1 {
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.message-header h1 i {
    color: #00d4ff;
}

.message-body {
    padding: 24px;
}

.info-group {
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    padding-bottom: 15px;
}

.info-label {
    width: 120px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #00d4ff;
}

.info-value {
    flex: 1;
    font-size: 14px;
    color: #fff;
}

.info-value a {
    color: #00d4ff;
    text-decoration: none;
}

.info-value a:hover {
    text-decoration: underline;
}

.message-content {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 16px;
    padding: 20px;
    margin-top: 20px;
}

.message-content-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    color: #00d4ff;
    margin-bottom: 12px;
}

.message-text {
    color: #e0e0e0;
    line-height: 1.6;
    white-space: pre-wrap;
}

.actions-group {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.btn-reply-email {
    background: linear-gradient(135deg, #00d4ff, #7c3aed);
    border: none;
    padding: 12px 24px;
    border-radius: 12px;
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s;
}

.btn-reply-email:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
    color: #fff;
}

.btn-reply-whatsapp {
    background: transparent;
    border: 1.5px solid #25D366;
    padding: 12px 24px;
    border-radius: 12px;
    color: #25D366;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s;
}

.btn-reply-whatsapp:hover {
    background: #25D366;
    color: #fff;
}

.btn-back {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 12px 24px;
    border-radius: 12px;
    color: #ccc;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s;
}

.btn-back:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
}
</style>

<div class="message-card">
    <div class="message-header">
        <h1>
            <i class="fas fa-envelope"></i>
            Message de {{ $message->name }}
        </h1>
        <a href="{{ route('admin.messages.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="message-body">
        <div class="info-group">
            <div class="info-label">Nom complet</div>
            <div class="info-value">{{ $message->name }}</div>
        </div>
        
        <div class="info-group">
            <div class="info-label">Email</div>
            <div class="info-value">
                <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
            </div>
        </div>
        
        <div class="info-group">
            <div class="info-label">Téléphone</div>
            <div class="info-value">
                <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>
            </div>
        </div>
        
        <div class="info-group">
            <div class="info-label">Date d'envoi</div>
            <div class="info-value">{{ $message->created_at->format('d/m/Y à H:i:s') }}</div>
        </div>
        
        <div class="message-content">
            <div class="message-content-label">
                <i class="fas fa-comment-dots me-2"></i> Message
            </div>
            <div class="message-text">
                {{ nl2br(e($message->message)) }}
            </div>
        </div>
        
        <div class="actions-group">
            <a href="mailto:{{ $message->email }}?subject=Réponse à votre message - Abeltech" class="btn-reply-email">
                <i class="fas fa-reply"></i> Répondre par email
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank" class="btn-reply-whatsapp">
                <i class="fab fa-whatsapp"></i> Répondre sur WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
