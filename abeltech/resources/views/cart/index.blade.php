@extends('layouts.app')
@section('title', 'Mon Panier')

@section('content')
<section style="padding:80px 0">
  <div class="container">
    <div class="section-tag mb-2">Récapitulatif</div>
    <h1 class="mb-5">Mon <span class="text-gradient">Panier</span></h1>

    @if(count($cart) > 0)
      <div class="row g-4">
        <div class="col-lg-8">
          <div class="cart-items">
            @foreach($cart as $id => $item)
              @php
                $quantity = isset($item['quantity']) ? $item['quantity'] : (isset($item['qty']) ? $item['qty'] : 1);
              @endphp
              <div class="cart-item">
                {{-- Image du produit avec taille fixe --}}
                <div class="cart-item-img-wrapper">
                  @if(isset($item['image']) && $item['image'])
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="cart-item-img">
                  @else
                    <div class="cart-item-placeholder">
                      <i class="fas fa-box"></i>
                    </div>
                  @endif
                </div>
                
                <div class="cart-item-info">
                  <h5>
                    <a href="{{ route('product.show', $item['slug']) }}">{{ $item['name'] }}</a>
                  </h5>
                  <div class="cart-item-price">
                    {{ number_format($item['price'], 0, ',', ' ') }} MAD
                  </div>
                </div>

                {{-- Quantité --}}
                <div class="cart-item-qty">
                  <form method="POST" action="{{ route('cart.updateQty') }}" class="qty-form">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="product_id" value="{{ $id }}">
                    <button type="button" class="qty-btn minus" onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.dispatchEvent(new Event('change'));">−</button>
                    <input type="number" name="qty" value="{{ $quantity }}" min="1" max="{{ $item['stock'] ?? 99 }}" class="qty-input" onchange="this.form.submit()">
                    <button type="button" class="qty-btn plus" onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.dispatchEvent(new Event('change'));">+</button>
                  </form>
                </div>

                {{-- Sous-total --}}
                <div class="cart-item-subtotal">
                  {{ number_format($item['price'] * $quantity, 0, ',', ' ') }} MAD
                </div>

                {{-- Supprimer --}}
                <form method="POST" action="{{ route('cart.remove', $id) }}" class="remove-form">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="cart-remove" title="Supprimer">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
              </div>
            @endforeach
          </div>

          {{-- Vider panier --}}
          <form method="POST" action="{{ route('cart.clear') }}" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-clear-cart" onclick="return confirm('Vider votre panier ?')">
              <i class="fas fa-trash-alt me-2"></i> Vider le panier
            </button>
          </form>
        </div>

        {{-- Résumé --}}
        <div class="col-lg-4">
          <div class="cart-summary">
            <h4>Résumé de commande</h4>
            <div class="summary-row">
              <span>Sous-total</span>
              <span>{{ number_format($total, 0, ',', ' ') }} MAD</span>
            </div>
            <div class="summary-row">
              <span>Livraison</span>
              <span class="free-shipping">Gratuite</span>
            </div>
            <div class="summary-divider"></div>
            <div class="summary-row total-row">
              <span>Total</span>
              <span class="total-amount">{{ number_format($total, 0, ',', ' ') }} MAD</span>
            </div>
            <a href="{{ route('checkout.index') }}" class="btn-checkout">
              <i class="fas fa-lock me-2"></i> Commander
            </a>
            <a href="{{ route('boutique') }}" class="btn-continue">
              <i class="fas fa-arrow-left me-2"></i> Continuer mes achats
            </a>
          </div>
        </div>
      </div>
    @else
      <div class="empty-cart">
        <div class="empty-cart-icon">🛒</div>
        <h3>Votre panier est vide</h3>
        <p>Ajoutez des produits depuis notre boutique pour commencer.</p>
        <a href="{{ route('boutique') }}" class="btn-shop">
          <i class="fas fa-store me-2"></i> Découvrir la boutique
        </a>
      </div>
    @endif
  </div>
</section>

<style>
/* ============================================
   STYLE PANIER - AVEC IMAGES CORRECTES
   ============================================ */

.cart-items {
  background: rgba(18, 20, 27, 0.6);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.07);
  border-radius: 20px;
  overflow: hidden;
}

.cart-item {
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 20px;
  border-bottom: 1px solid rgba(255,255,255,0.07);
  flex-wrap: wrap;
}

.cart-item:last-child {
  border-bottom: none;
}

/* ========== IMAGE PRODUIT - TAILLE CORRECTE ========== */
.cart-item-img-wrapper {
  width: 80px;
  height: 80px;
  flex-shrink: 0;
}

.cart-item-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 12px;
  background: rgba(0,0,0,0.3);
}

.cart-item-placeholder {
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.05);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(255,255,255,0.3);
  font-size: 24px;
}

/* ========== INFO PRODUIT ========== */
.cart-item-info {
  flex: 2;
  min-width: 150px;
}

.cart-item-info h5 {
  margin: 0 0 5px 0;
  font-size: 15px;
  font-weight: 600;
}

.cart-item-info h5 a {
  color: #fff;
  text-decoration: none;
  transition: color 0.2s;
}

.cart-item-info h5 a:hover {
  color: #00d4ff;
}

.cart-item-price {
  font-size: 13px;
  color: #00d4ff;
  font-weight: 500;
}

/* ========== QUANTITÉ ========== */
.cart-item-qty {
  min-width: 120px;
}

.qty-form {
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,0.05);
  border-radius: 30px;
  padding: 4px;
  width: fit-content;
}

.qty-btn {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: none;
  background: rgba(255,255,255,0.1);
  color: #fff;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
}

.qty-btn:hover {
  background: linear-gradient(135deg, #00d4ff, #7c3aed);
}

.qty-input {
  width: 50px;
  text-align: center;
  background: transparent;
  border: none;
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  outline: none;
}

/* ========== SOUS-TOTAL ========== */
.cart-item-subtotal {
  min-width: 100px;
  font-weight: 700;
  font-size: 15px;
  color: #00d4ff;
  text-align: center;
}

/* ========== SUPPRIMER ========== */
.remove-form {
  flex-shrink: 0;
}

.cart-remove {
  background: rgba(239,68,68,0.15);
  border: 1px solid rgba(239,68,68,0.3);
  width: 36px;
  height: 36px;
  border-radius: 10px;
  color: #ef4444;
  cursor: pointer;
  transition: all 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.cart-remove:hover {
  background: #ef4444;
  color: #fff;
}

/* ========== RÉSUMÉ ========== */
.cart-summary {
  background: rgba(18, 20, 27, 0.8);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.07);
  border-radius: 20px;
  padding: 24px;
  position: sticky;
  top: 100px;
}

.cart-summary h4 {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 20px;
  padding-bottom: 12px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

.summary-row {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  font-size: 14px;
  color: rgba(255,255,255,0.7);
}

.summary-divider {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(0,212,255,0.3), transparent);
  margin: 12px 0;
}

.total-row {
  margin-top: 5px;
}

.total-row span:first-child {
  font-size: 16px;
  font-weight: 700;
  color: #fff;
}

.total-amount {
  font-size: 22px;
  font-weight: 800;
  background: linear-gradient(135deg, #00d4ff, #7c3aed);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.free-shipping {
  color: #22c55e;
}

/* ========== BOUTONS ========== */
.btn-checkout {
  display: block;
  width: 100%;
  background: linear-gradient(135deg, #00d4ff, #7c3aed);
  border: none;
  padding: 14px;
  border-radius: 40px;
  color: #fff;
  font-weight: 700;
  text-align: center;
  text-decoration: none;
  transition: all 0.3s;
  margin-top: 20px;
}

.btn-checkout:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,212,255,0.4);
}

.btn-continue {
  display: block;
  width: 100%;
  background: transparent;
  border: 1.5px solid rgba(0,212,255,0.5);
  padding: 12px;
  border-radius: 40px;
  color: #00d4ff;
  font-weight: 600;
  text-align: center;
  text-decoration: none;
  transition: all 0.3s;
  margin-top: 12px;
}

.btn-continue:hover {
  background: rgba(0,212,255,0.1);
}

.btn-clear-cart {
  background: transparent;
  border: 1px solid rgba(239,68,68,0.3);
  padding: 10px 20px;
  border-radius: 30px;
  color: #ef4444;
  font-size: 13px;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-clear-cart:hover {
  background: rgba(239,68,68,0.15);
}

/* ========== PANIER VIDE ========== */
.empty-cart {
  text-align: center;
  padding: 60px 20px;
  background: rgba(18,20,27,0.6);
  border-radius: 24px;
}

.empty-cart-icon {
  font-size: 64px;
  margin-bottom: 20px;
}

.empty-cart h3 {
  font-size: 24px;
  margin-bottom: 10px;
}

.empty-cart p {
  color: rgba(255,255,255,0.5);
  margin-bottom: 24px;
}

.btn-shop {
  background: linear-gradient(135deg, #00d4ff, #7c3aed);
  border: none;
  padding: 12px 28px;
  border-radius: 40px;
  color: #fff;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
}

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
  .cart-item {
    position: relative;
    flex-direction: column;
    text-align: center;
  }
  
  .cart-item-img-wrapper {
    width: 100px;
    height: 100px;
  }
  
  .cart-item-info {
    text-align: center;
  }
  
  .cart-item-qty {
    width: 100%;
    display: flex;
    justify-content: center;
  }
  
  .cart-item-subtotal {
    text-align: center;
  }
  
  .cart-remove {
    position: absolute;
    top: 15px;
    right: 15px;
  }
}
</style>

<script>
// Auto-submit when quantity changes
document.querySelectorAll('.qty-input').forEach(input => {
  input.addEventListener('change', function() {
    this.closest('form').submit();
  });
});
</script>
@endsection
