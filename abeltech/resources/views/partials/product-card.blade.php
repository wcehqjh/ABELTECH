<div class="product-card reveal">
  {{-- Badges --}}
  <div class="product-badges">
    @if($product->is_new)
      <span class="badge-product badge-new">Nouveau</span>
    @endif
    @if($product->is_promo && $product->discount_percent > 0)
      <span class="badge-product badge-promo">-{{ $product->discount_percent }}%</span>
    @endif
    @if(!$product->is_in_stock)
      <span class="badge-product badge-out">Épuisé</span>
    @endif
  </div>

  {{-- Image --}}
  <a href="{{ route('shop.show', $product->slug) }}" class="product-img-wrap">
    <img
      src="{{ $product->image_url }}"
      alt="{{ $product->name }}"
      class="product-img"
      loading="lazy"
    >
    <div class="product-img-overlay">
      <span><i class="fas fa-eye me-1"></i> Voir détails</span>
    </div>
  </a>

  {{-- Infos --}}
  <div class="product-body">
    <div class="product-category-tag">{{ ucfirst($product->category) }}</div>
    <h3 class="product-name">
      <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
    </h3>
    @if($product->brand)
      <div class="product-brand">{{ $product->brand }}</div>
    @endif
    <p class="product-desc">{{ Str::limit($product->description, 70) }}</p>

    {{-- Prix --}}
    <div class="product-price-wrap">
      <span class="product-price">{{ number_format($product->price, 0, ',', ' ') }} MAD</span>
      @if($product->old_price)
        <span class="product-old-price">{{ number_format($product->old_price, 0, ',', ' ') }} MAD</span>
      @endif
    </div>

    {{-- Stock --}}
    <div class="product-stock {{ $product->is_in_stock ? 'in-stock' : 'out-stock' }}">
      <i class="fas fa-circle" style="font-size:6px"></i>
      {{ $product->is_in_stock ? "En stock ({$product->stock})" : 'Rupture de stock' }}
    </div>

    {{-- Actions --}}
    <div class="product-actions">
      <a href="{{ route('shop.show', $product->slug) }}" class="btn-outline-glow">
        <i class="fas fa-eye"></i> Détails
      </a>
      @if($product->is_in_stock)
        <form method="POST" action="{{ route('cart.add') }}" class="flex-1">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <input type="hidden" name="qty" value="1">
          <button type="submit" class="btn-glow w-100">
            <i class="fas fa-cart-plus"></i> Ajouter
          </button>
        </form>
      @else
        <button class="btn-glow w-100 disabled" disabled>
          <i class="fas fa-times"></i> Indisponible
        </button>
      @endif
    </div>
  </div>
</div>