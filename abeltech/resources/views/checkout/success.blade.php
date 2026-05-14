@extends('layouts.app')

@section('title', 'Commande confirmée')
@section('meta_desc', 'Votre commande a été confirmée avec succès')

@section('content')
<style>
  .success-container {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 0;
  }
  
  .success-card {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border-radius: 48px;
    border: 1px solid rgba(0,212,255,0.2);
    padding: 50px 40px;
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
    animation: fadeInUp 0.6s ease;
  }
  
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .success-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #22c55e, #15803d);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    animation: pulse 0.5s ease;
  }
  
  @keyframes pulse {
    0% { transform: scale(0); opacity: 0; }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); opacity: 1; }
  }
  
  .success-icon i {
    font-size: 50px;
    color: #fff;
  }
  
  .success-title {
    font-family: 'Orbitron', monospace;
    font-size: 32px;
    font-weight: 800;
    background: linear-gradient(135deg, #fff, var(--cyan));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 15px;
  }
  
  .order-number {
    background: rgba(0,212,255,0.1);
    border: 1px solid rgba(0,212,255,0.3);
    border-radius: 50px;
    padding: 10px 25px;
    display: inline-block;
    margin: 20px 0;
  }
  
  .order-number span {
    font-size: 13px;
    color: rgba(255,255,255,0.5);
  }
  
  .order-number strong {
    font-size: 18px;
    color: var(--cyan);
    letter-spacing: 1px;
  }
  
  .order-details {
    background: rgba(0,0,0,0.3);
    border-radius: 24px;
    padding: 20px;
    margin: 25px 0;
    text-align: left;
  }
  
  .detail-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
  }
  
  .detail-row:last-child {
    border-bottom: none;
  }
  
  .detail-label {
    color: rgba(255,255,255,0.5);
    font-size: 13px;
  }
  
  .detail-value {
    font-weight: 600;
    color: #fff;
  }
  
  .total-amount {
    font-size: 24px;
    font-weight: 800;
    background: linear-gradient(135deg, var(--cyan), var(--purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  
  .btn-group-success {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
  }
  
  .btn-primary-cyan {
    background: linear-gradient(135deg, var(--cyan), var(--purple));
    border: none;
    padding: 14px 28px;
    border-radius: 40px;
    color: #fff;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }
  
  .btn-primary-cyan:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,212,255,0.3);
    color: #fff;
  }
  
  .btn-outline-cyan {
    background: transparent;
    border: 1.5px solid var(--cyan);
    padding: 14px 28px;
    border-radius: 40px;
    color: var(--cyan);
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }
  
  .btn-outline-cyan:hover {
    background: rgba(0,212,255,0.1);
    color: var(--cyan);
  }
  
  @media (max-width: 768px) {
    .success-card {
      padding: 30px 20px;
    }
    .btn-group-success {
      flex-direction: column;
    }
    .success-title {
      font-size: 24px;
    }
  }
</style>

<div class="success-container">
  <div class="success-card">
    <div class="success-icon">
      <i class="fas fa-check"></i>
    </div>
    
    <h1 class="success-title">Commande confirmée !</h1>
    
    <p style="color: rgba(255,255,255,0.6);">
      Merci pour votre confiance. Votre commande a été enregistrée avec succès.
    </p>
    
    <div class="order-number">
      <span>N° de commande</span><br>
      <strong>{{ $order->order_number }}</strong>
    </div>
    
    <div class="order-details">
      <div class="detail-row">
        <span class="detail-label"><i class="fas fa-calendar me-1"></i> Date</span>
        <span class="detail-value">{{ $order->created_at->format('d/m/Y à H:i') }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label"><i class="fas fa-user me-1"></i> Client</span>
        <span class="detail-value">{{ $order->customer_name }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label"><i class="fas fa-credit-card me-1"></i> Mode de paiement</span>
        <span class="detail-value">
          @if($order->payment_method == 'cash')
            💰 Paiement à la livraison
          @elseif($order->payment_method == 'card')
            💳 Carte bancaire
          @else
            🏦 Virement bancaire
          @endif
        </span>
      </div>
      <div class="detail-row">
        <span class="detail-label"><i class="fas fa-money-bill-wave me-1"></i> Total</span>
        <span class="detail-value total-amount">{{ number_format($order->total, 0, ',', ' ') }} MAD</span>
      </div>
    </div>
    
    <p style="font-size: 13px; color: rgba(255,255,255,0.4);">
      <i class="fas fa-envelope me-1"></i>
      Un email de confirmation vous a été envoyé.
    </p>
    
    <div class="btn-group-success">
      <a href="{{ route('boutique') }}" class="btn-primary-cyan">
        <i class="fas fa-store"></i> Continuer mes achats
      </a>
      <a href="{{ route('home') }}" class="btn-outline-cyan">
        <i class="fas fa-home"></i> Retour à l'accueil
      </a>
    </div>
  </div>
</div>
@endsection
