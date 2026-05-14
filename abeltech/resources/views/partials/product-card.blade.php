<div class="product-card card reveal">
  {{-- Badges --}}
  <div class="product-badges">
    @if($product->is_new)
      <span class="card-badge badge-new">Nouveau</span>
    @endif
    @if($product->is_promo && $product->discount_percent > 0)
      <span class="card-badge badge-sale">-{{ $product->discount_percent }}%</span>
    @endif
    @if(!$product->is_in_stock)
      <span class="card-badge badge-sold-out">Épuisé</span>
    @endif
  </div>

  {{-- Wishlist button (zidha b7al CSS) --}}
  <button class="card-wishlist" onclick="toggleWishlist({{ $product->id }})">
    <i class="far fa-heart"></i>
  </button>

  {{-- Image --}}
  <a href="{{ route('shop.show', $product->slug) }}" class="card-image">
    <img
      src="{{ $product->image_url }}"
      alt="{{ $product->name }}"
      class="card-img"
      loading="lazy"
    >
    <div class="card-image-glow"></div>
  </a>

  {{-- Infos --}}
  <div class="card-body">
    <div class="card-category">{{ ucfirst($product->category) }}</div>
    <h3 class="card-title">
      <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
    </h3>
    @if($product->brand)
      <div class="card-brand">{{ $product->brand }}</div>
    @endif
    <p class="card-desc">{{ Str::limit($product->description, 70) }}</p>

    {{-- Prix --}}
    <div class="price-wrap">
      <span class="price">{{ number_format($product->price, 0, ',', ' ') }} MAD</span>
      @if($product->old_price)
        <span class="price-old">{{ number_format($product->old_price, 0, ',', ' ') }} MAD</span>
      @endif
    </div>

    {{-- Stock --}}
    <div class="stock-badge {{ $product->is_in_stock ? 'in-stock' : 'out-stock' }}">
      <span class="stock-dot"></span>
      {{ $product->is_in_stock ? "En stock ({$product->stock})" : 'Rupture de stock' }}
    </div>

    {{-- Actions --}}
    <div class="card-footer" style="margin-top:12px;">
      <a href="{{ route('shop.show', $product->slug) }}" class="btn btn-outline" style="padding:8px 14px; font-size:12px;">
        <i class="fas fa-eye"></i> Détails
      </a>
      @if($product->is_in_stock)
        <form method="POST" action="{{ route('cart.add') }}" style="display:inline;">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <input type="hidden" name="qty" value="1">
          <button type="submit" class="btn btn-add-cart">
            <i class="fas fa-cart-plus"></i> Ajouter
          </button>
        </form>
      @else
        <button class="btn btn-ghost" disabled style="opacity:0.5; cursor:not-allowed;">
          <i class="fas fa-times"></i> Indisponible
        </button>
      @endif
    </div>
  </div>
</div>