@extends('layouts.app')
@section('title', 'Mon Panier')

@section('content')
<section style="padding:80px 0">
  <div class="container">
    <div class="section-tag mb-2">Récapitulatif</div>
    <h1 class="mb-5">Mon <span class="text-gradient">Panier</span></h1>

    @if(count($cart))
      <div class="row g-4">
        {{-- Articles --}}
        <div class="col-lg-8">
          <div class="cart-items">
            @foreach($cart as $item)
              <div class="cart-item">
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="cart-item-img">
                <div class="cart-item-info flex-1">
                  <h5>
                    <a href="{{ route('shop.show', $item['slug']) }}">{{ $item['name'] }}</a>
                  </h5>
                  <div class="text-gradient fw-bold">
                    {{ number_format($item['price'], 0, ',', ' ') }} MAD
                  </div>
                </div>

                {{-- Quantité --}}
                <form method="POST" action="{{ route('cart.updateQty') }}" class="qty-control-sm">
                  @csrf @method('PATCH')
                  <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                  <button type="button" onclick="this.closest('form').qty.stepDown();this.closest('form').submit()">−</button>
                  <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="{{ $item['stock'] }}"
                    onchange="this.closest('form').submit()">
                  <button type="button" onclick="this.closest('form').qty.stepUp();this.closest('form').submit()">+</button>
                </form>

                {{-- Sous-total --}}
                <div class="cart-subtotal">
                  {{ number_format($item['price'] * $item['qty'], 0, ',', ' ') }} MAD
                </div>

                {{-- Supprimer --}}
                <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                  @csrf @method('DELETE')
                  <button type="submit" class="cart-remove" title="Supprimer">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            @endforeach
          </div>

          {{-- Vider panier --}}
          <form method="POST" action="{{ route('cart.clear') }}" class="mt-3">
            @csrf @method('DELETE')
            <button type="submit" class="btn-outline-glow text-danger border-danger">
              <i class="fas fa-trash-alt me-1"></i> Vider le panier
            </button>
          </form>
        </div>

        {{-- Résumé --}}
        <div class="col-lg-4">
          <div class="cart-summary">
            <h4 class="mb-4">Résumé de commande</h4>
            <div class="summary-row">
              <span>Sous-total</span>
              <span>{{ number_format($total, 0, ',', ' ') }} MAD</span>
            </div>
            <div class="summary-row">
              <span>Livraison</span>
              <span class="text-gradient">Gratuite</span>
            </div>
            <div class="summary-divider"></div>
            <div class="summary-row total-row">
              <span>Total</span>
              <span class="text-gradient fs-4 fw-bold">{{ number_format($total, 0, ',', ' ') }} MAD</span>
            </div>
            <button class="btn-glow w-100 mt-4">
              <i class="fas fa-lock me-2"></i> Commander
            </button>
            <a href="{{ route('shop.index') }}" class="btn-outline-glow w-100 mt-3 text-center">
              <i class="fas fa-arrow-left me-1"></i> Continuer mes achats
            </a>
          </div>
        </div>
      </div>

    @else
      <div class="empty-state">
        <div style="font-size:5rem">🛒</div>
        <h3>Votre panier est vide</h3>
        <p>Ajoutez des produits depuis notre boutique pour commencer.</p>
        <a href="{{ route('shop.index') }}" class="btn-glow mt-3">
          <i class="fas fa-store me-2"></i> Découvrir la boutique
        </a>
      </div>
    @endif
  </div>
</section>
@endsection