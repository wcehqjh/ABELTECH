@extends('layouts.app')

@section('title', 'Finalisation de commande')
@section('meta_desc', 'Finalisez votre commande sur Abeltech - Paiement sécurisé')

@section('content')
<style>
  /* ──────────────────────────────────────────────────────────── */
  /* DESIGN PREMIUM LUXE - ABELTECH CHECKOUT */
  /* ──────────────────────────────────────────────────────────── */
  
  :root {
    --gold: #5560f7;
    --gold-light: #3891cc;
    --gold-dark: #02cde7;
    --silver: #2ac5bd;
    --platinum: #52dbbe;
    --luxe-bg: linear-gradient(135deg, #0a0a0f 0%, #0d0d14 50%, #0a0a0f 100%);
    --card-bg: rgba(15, 15, 22, 0.9);
    --border-luxe: linear-gradient(135deg, rgba(84, 192, 211, 0.3), rgba(255, 255, 255, 0.05));
  }

  /* Effet de fond premium */
  .luxe-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--luxe-bg);
    z-index: -2;
  }
  
  .luxe-orb {
    position: fixed;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    filter: blur(120px);
    opacity: 0.15;
    z-index: -1;
  }
  
  .luxe-orb-1 {
    background: radial-gradient(circle, #3e92f1, transparent);
    top: -200px;
    right: -200px;
  }
  
  .luxe-orb-2 {
    background: radial-gradient(circle, #7c3aed, transparent);
    bottom: -200px;
    left: -200px;
  }
  
  /* Hero section */
  .checkout-hero {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
  }
  
  .luxe-badge {
    display: inline-block;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.15), rgba(212, 175, 55, 0.05));
    border: 1px solid rgba(212, 175, 55, 0.3);
    border-radius: 100px;
    padding: 5px 16px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    color: var(--gold);
    margin-bottom: 20px;
    backdrop-filter: blur(4px);
  }
  
  .luxe-title {
    font-family: 'Orbitron', monospace;
    font-size: clamp(32px, 6vw, 58px);
    font-weight: 800;
    background: linear-gradient(135deg, #fff 0%, var(--gold) 40%, #fff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -1px;
    margin-bottom: 15px;
  }
  
  .luxe-subtitle {
    color: rgba(255,255,255,0.4);
    font-size: 14px;
    letter-spacing: 1px;
  }
  
  /* Breadcrumb premium */
  .luxe-breadcrumb {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    margin-bottom: 30px;
  }
  
  .breadcrumb-step {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.3);
    font-size: 13px;
  }
  
  .breadcrumb-step.active {
    color: var(--gold);
  }
  
  .breadcrumb-step.completed {
    color: #22c55e;
  }
  
  .step-number {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
  }
  
  .breadcrumb-step.active .step-number {
    background: linear-gradient(135deg, var(--gold), var(--gold-dark));
    color: #000;
  }
  
  .breadcrumb-step.completed .step-number {
    background: #22c55e;
    color: #fff;
  }
  
  /* Cartes premium */
  .premium-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border-radius: 32px;
    border: 1px solid rgba(255,255,255,0.05);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    position: relative;
  }
  
  .premium-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
    opacity: 0;
    transition: opacity 0.4s;
  }
  
  .premium-card:hover::before {
    opacity: 1;
  }
  
  .premium-card:hover {
    transform: translateY(-5px);
    border-color: rgba(212, 175, 55, 0.3);
    box-shadow: 0 30px 50px rgba(0,0,0,0.5), 0 0 30px rgba(212,175,55,0.1);
  }
  
  .premium-card-header {
    padding: 28px 30px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    background: linear-gradient(135deg, rgba(212,175,55,0.05), transparent);
  }
  
  .premium-card-header h4 {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  
  .premium-card-header h4 i {
    color: var(--gold);
    font-size: 22px;
  }
  
  .premium-card-body {
    padding: 30px;
  }
  
  /* Champs de formulaire premium */
  .luxe-input-group {
    margin-bottom: 20px;
  }
  
  .luxe-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.5);
    margin-bottom: 8px;
  }
  
  .luxe-input {
    width: 100%;
    background: rgba(0,0,0,0.4);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 14px 18px;
    color: #fff;
    font-size: 14px;
    transition: all 0.3s;
  }
  
  .luxe-input:focus {
    outline: none;
    border-color: var(--gold);
    box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.15);
    background: rgba(0,0,0,0.6);
  }
  
  .luxe-input::placeholder {
    color: rgba(255,255,255,0.2);
  }
  
  /* Méthodes de paiement premium */
  .payment-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 10px;
  }
  
  .payment-option {
    cursor: pointer;
  }
  
  .payment-option input {
    display: none;
  }
  
  .payment-option-card {
    background: rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 20px 15px;
    text-align: center;
    transition: all 0.3s;
  }
  
  .payment-option input:checked + .payment-option-card {
    background: linear-gradient(135deg, rgba(212,175,55,0.1), rgba(0,0,0,0.3));
    border-color: var(--gold);
    box-shadow: 0 0 20px rgba(212,175,55,0.2);
  }
  
  .payment-option-card i {
    font-size: 32px;
    margin-bottom: 12px;
    display: block;
    color: rgba(255,255,255,0.5);
    transition: color 0.3s;
  }
  
  .payment-option input:checked + .payment-option-card i {
    color: var(--gold);
  }
  
  .payment-option-card span {
    font-size: 13px;
    font-weight: 500;
  }
  
  /* Formulaire carte bancaire */
  .card-form-premium {
    margin-top: 25px;
    padding: 20px;
    background: linear-gradient(135deg, rgba(212,175,55,0.05), rgba(0,0,0,0.2));
    border-radius: 24px;
    border: 1px solid rgba(212,175,55,0.15);
    animation: slideDown 0.4s ease;
  }
  
  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .card-row-premium {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
  }
  
  /* Bouton premium */
  .btn-luxe {
    width: 100%;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold), var(--gold-light));
    border: none;
    padding: 18px;
    border-radius: 40px;
    color: #000;
    font-weight: 800;
    font-size: 16px;
    letter-spacing: 2px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
  }
  
  .btn-luxe:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(71, 194, 224, 0.3);
    filter: brightness(1.05);
  }
  
  /* Résumé de commande premium */
  .order-summary-premium {
    background: linear-gradient(135deg, rgba(15,15,22,0.95), rgba(10,10,15,0.95));
    backdrop-filter: blur(20px);
    border-radius: 32px;
    border: 1px solid rgba(94, 209, 224, 0.2);
    position: sticky;
    top: 100px;
    overflow: hidden;
  }
  
  .summary-header-premium {
    padding: 25px 30px;
    background: linear-gradient(135deg, rgba(212,175,55,0.08), transparent);
    border-bottom: 1px solid rgba(212,175,55,0.15);
  }
  
  .summary-header-premium h4 {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    color: var(--gold);
  }
  
  .summary-items {
    padding: 20px 30px;
    max-height: 300px;
    overflow-y: auto;
  }
  
  .summary-item-premium {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px dashed rgba(255,255,255,0.05);
  }
  
  .summary-item-info-premium {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  
  .summary-item-icon {
    width: 40px;
    height: 40px;
    background: rgba(212,175,55,0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
  }
  
  .summary-item-name {
    font-weight: 500;
  }
  
  .summary-item-price {
    font-weight: 700;
    color: var(--gold);
  }
  
  .summary-totals {
    padding: 20px 30px 30px;
    background: linear-gradient(135deg, rgba(0,0,0,0.3), transparent);
    border-top: 1px solid rgba(212,175,55,0.15);
  }
  
  .summary-total-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
  }
  
  .summary-grand-total {
    padding-top: 15px;
    margin-top: 10px;
    border-top: 1px solid rgba(212,175,55,0.3);
  }
  
  .summary-grand-total .label {
    font-size: 18px;
    font-weight: 800;
  }
  
  .summary-grand-total .value {
    font-size: 28px;
    font-weight: 800;
    background: linear-gradient(135deg, var(--gold), #fff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .payment-grid {
      grid-template-columns: 1fr;
    }
    .card-row-premium {
      grid-template-columns: 1fr;
    }
    .premium-card-body {
      padding: 20px;
    }
    .summary-items, .summary-totals {
      padding: 20px;
    }
  }
</style>

{{-- Effets de fond --}}
<div class="luxe-bg"></div>
<div class="luxe-orb luxe-orb-1"></div>
<div class="luxe-orb luxe-orb-2"></div>

<section style="padding: 40px 0 100px; position: relative; z-index: 1;">
  <div class="container">

    {{-- Hero Section --}}
    <div class="checkout-hero">
      <span class="luxe-badge">
        <i class="fas fa-gem me-1"></i> PAIEMENT SÉCURISÉ
      </span>
      <h1 class="luxe-title">Finalisez votre <br>commande</h1>
      <p class="luxe-subtitle">Expérience de paiement premium • 100% sécurisé</p>
    </div>

    {{-- Breadcrumb premium --}}
    <div class="luxe-breadcrumb">
      <div class="breadcrumb-step completed">
        <span class="step-number"><i class="fas fa-check"></i></span>
        <span>Panier</span>
      </div>
      <i class="fas fa-arrow-right" style="font-size: 10px; color: rgba(255,255,255,0.2);"></i>
      <div class="breadcrumb-step active">
        <span class="step-number">2</span>
        <span>Commande</span>
      </div>
      <i class="fas fa-arrow-right" style="font-size: 10px; color: rgba(255,255,255,0.2);"></i>
      <div class="breadcrumb-step">
        <span class="step-number">3</span>
        <span>Confirmation</span>
      </div>
    </div>

    <div class="row g-4">
      {{-- Formulaire --}}
      <div class="col-lg-7">
        <div class="premium-card">
          <div class="premium-card-header">
            <h4>
              <i class="fas fa-user-shield"></i>
              Informations de livraison
            </h4>
          </div>
          <div class="premium-card-body">
            <form method="POST" action="{{ route('checkout.store') }}" id="checkoutForm">
              @csrf
              
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="luxe-input-group">
                    <label class="luxe-label">Prénom</label>
                    <input type="text" name="first_name" class="luxe-input" required placeholder="Mohammed">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="luxe-input-group">
                    <label class="luxe-label">Nom</label>
                    <input type="text" name="last_name" class="luxe-input" required placeholder="Alami">
                  </div>
                </div>
                <div class="col-12">
                  <div class="luxe-input-group">
                    <label class="luxe-label">Email</label>
                    <input type="email" name="email" class="luxe-input" required placeholder="client@abeltech.ma">
                  </div>
                </div>
                <div class="col-12">
                  <div class="luxe-input-group">
                    <label class="luxe-label">Téléphone</label>
                    <input type="tel" name="phone" class="luxe-input" required placeholder="+212 6 00 00 00 00">
                  </div>
                </div>
                <div class="col-12">
                  <div class="luxe-input-group">
                    <label class="luxe-label">Adresse</label>
                    <input type="text" name="address" class="luxe-input" required placeholder="Numéro, rue, quartier">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="luxe-input-group">
                    <label class="luxe-label">Ville</label>
                    <input type="text" name="city" class="luxe-input" required placeholder="Casablanca">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="luxe-input-group">
                    <label class="luxe-label">Code postal</label>
                    <input type="text" name="zip" class="luxe-input" placeholder="20000">
                  </div>
                </div>
                
                {{-- Mode de paiement premium --}}
                <div class="col-12">
                  <label class="luxe-label">Mode de paiement</label>
                  <div class="payment-grid">
                    <label class="payment-option">
                      <input type="radio" name="payment_method" value="cash" checked onchange="toggleCardForm(false)">
                      <div class="payment-option-card">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Paiement à la livraison</span>
                      </div>
                    </label>
                    <label class="payment-option">
                      <input type="radio" name="payment_method" value="card" onchange="toggleCardForm(true)">
                      <div class="payment-option-card">
                        <i class="fab fa-cc-visa"></i>
                        <span>Carte bancaire</span>
                      </div>
                    </label>
                    <label class="payment-option">
                      <input type="radio" name="payment_method" value="transfer" onchange="toggleCardForm(false)">
                      <div class="payment-option-card">
                        <i class="fas fa-university"></i>
                        <span>Virement bancaire</span>
                      </div>
                    </label>
                  </div>
                </div>
                
                {{-- Formulaire carte bancaire (caché par défaut) --}}
                <div class="col-12" id="cardForm" style="display: none;">
                  <div class="card-form-premium">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                      <i class="fab fa-cc-visa" style="font-size: 28px; color: var(--gold);"></i>
                      <i class="fab fa-cc-mastercard" style="font-size: 28px; color: #eb001b;"></i>
                      <i class="fab fa-cc-amex" style="font-size: 28px; color: #006fcf;"></i>
                      <span style="margin-left: auto; font-size: 11px; color: rgba(255,255,255,0.3);">
                        <i class="fas fa-lock"></i> 256-bit SSL
                      </span>
                    </div>
                    <div class="luxe-input-group">
                      <label class="luxe-label">Numéro de carte</label>
                      <input type="text" class="luxe-input" id="card_number" placeholder="1234 5678 9012 3456" maxlength="19">
                    </div>
                    <div class="card-row-premium">
                      <div class="luxe-input-group">
                        <label class="luxe-label">Date d'expiration</label>
                        <input type="text" class="luxe-input" id="card_expiry" placeholder="MM/AA">
                      </div>
                      <div class="luxe-input-group">
                        <label class="luxe-label">CVV / CVC</label>
                        <input type="text" class="luxe-input" id="card_cvv" placeholder="***" maxlength="4">
                      </div>
                    </div>
                    <div class="luxe-input-group">
                      <label class="luxe-label">Nom sur la carte</label>
                      <input type="text" class="luxe-input" id="card_name" placeholder="MOHAMMED ALAMI">
                    </div>
                  </div>
                </div>
              </div>
              
              <button type="submit" class="btn-luxe mt-4">
                <i class="fas fa-crown"></i>
                Confirmer et payer
                <i class="fas fa-arrow-right"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
      
      {{-- Résumé de commande premium --}}
      <div class="col-lg-5">
        <div class="order-summary-premium">
          <div class="summary-header-premium">
            <h4><i class="fas fa-receipt me-2"></i> Récapitulatif</h4>
          </div>
          
          <div class="summary-items">
            @foreach($cart as $id => $item)
              @php
                $quantity = isset($item['quantity']) ? $item['quantity'] : (isset($item['qty']) ? $item['qty'] : 1);
              @endphp
              <div class="summary-item-premium">
                <div class="summary-item-info-premium">
                  <div class="summary-item-icon">
                    <i class="fas fa-box"></i>
                  </div>
                  <div>
                    <div class="summary-item-name">{{ $item['name'] }}</div>
                    <small style="color: rgba(255,255,255,0.3);">x{{ $quantity }}</small>
                  </div>
                </div>
                <div class="summary-item-price">
                  {{ number_format($item['price'] * $quantity, 0, ',', ' ') }} MAD
                </div>
              </div>
            @endforeach
          </div>
          
          <div class="summary-totals">
            <div class="summary-total-row">
              <span>Sous-total</span>
              <span>{{ number_format($total, 0, ',', ' ') }} MAD</span>
            </div>
            <div class="summary-total-row">
              <span>Livraison</span>
              <span style="color: #22c55e;">Gratuite</span>
            </div>
            <div class="summary-total-row">
              <span>Taxes incluses</span>
              <span>-</span>
            </div>
            <div class="summary-grand-total">
              <div class="summary-total-row">
                <span class="label">Total à payer</span>
                <span class="value">{{ number_format($total, 0, ',', ' ') }} MAD</span>
              </div>
            </div>
          </div>
          
          <div style="padding: 0 30px 30px;">
            <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(212,175,55,0.05); border-radius: 16px;">
              <i class="fas fa-shield-alt" style="color: var(--gold); font-size: 20px;"></i>
              <div>
                <small style="font-weight: 600;">Paiement sécurisé Garanti</small>
                <small style="display: block; color: rgba(255,255,255,0.3);">Transactions cryptées SSL 256-bit</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function toggleCardForm(show) {
  const cardForm = document.getElementById('cardForm');
  cardForm.style.display = show ? 'block' : 'none';
}

// Auto-formatage numéro de carte
const cardNumber = document.getElementById('card_number');
if (cardNumber) {
  cardNumber.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    value = value.replace(/(\d{4})/g, '$1 ').trim();
    e.target.value = value.substring(0, 19);
  });
}

// Auto-formatage date expiration
const cardExpiry = document.getElementById('card_expiry');
if (cardExpiry) {
  cardExpiry.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
      value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    e.target.value = value.substring(0, 5);
  });
}

// Formatage CVV
const cardCvv = document.getElementById('card_cvv');
if (cardCvv) {
  cardCvv.addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
  });
}
</script>
@endsection
