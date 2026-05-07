@extends('layouts.app')

@section('title', $product->name)
@section('meta_description', $product->description)

@section('content')
<section style="padding:80px 0">
  <div class="container">

    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom mb-5">
      <a href="{{ route('shop.index') }}">Boutique</a>
      <i class="fas fa-chevron-right" style="font-size:.65rem"></i>
      <a href="{{ route('shop.index', ['categorie' => $product->category]) }}">
        {{ ucfirst($product->category) }}
      </a>
      <i class="fas fa-chevron-right" style="font-size:.65rem"></i>
      <span>{{ $product->name }}</span>
    </div>

    <div class="row g-5">

      {{-- GALERIE --}}
      <div class="col-lg-6">
        <div class="product-gallery">
          <div class="main-img-wrap">
            <img
              id="mainImg"
              src="{{ $product->image_url }}"
              alt="{{ $product->name }}"
              class="main-img"
            >
            {{-- Badges --}}
            <div class="product-badges position-absolute top-0 start-0 p-3">
              @if($product->is_new)  <span class="badge-product badge-new">Nouveau</span> @endif
              @if($product->is_promo) <span class="badge-product badge-promo">-{{ $product->discount_percent }}%</span> @endif
            </div>
          </div>

          {{-- Miniatures galerie --}}
          @if($product->images->count())
            <div class="thumb-row mt-3">
              <img
                src="{{ $product->image_url }}"
                class="thumb-img active"
                onclick="setMainImg(this)"
                alt="Principal"
              >
              @foreach($product->images as $img)
                <img
                  src="{{ $img->url }}"
                  class="thumb-img"
                  onclick="setMainImg(this)"
                  alt="Image galerie"
                >
              @endforeach
            </div>
          @endif
        </div>
      </div>

      {{-- INFOS PRODUIT --}}
      <div class="col-lg-6">
        <div class="product-detail-body">

          <div class="product-category-tag mb-2">{{ ucfirst($product->category) }}</div>
          <h1 class="product-detail-name">{{ $product->name }}</h1>

          @if($product->brand)
            <p class="product-brand mb-3">
              <i class="fas fa-tag me-1"></i> {{ $product->brand }}
            </p>
          @endif

          {{-- Prix --}}
          <div class="detail-price-wrap">
            <span class="detail-price">{{ number_format($product->price, 0, ',', ' ') }} MAD</span>
            @if($product->old_price)
              <span class="detail-old-price">{{ number_format($product->old_price, 0, ',', ' ') }} MAD</span>
              <span class="badge-promo ms-2">-{{ $product->discount_percent }}%</span>
            @endif
          </div>

          {{-- Stock --}}
          <div class="product-stock {{ $product->is_in_stock ? 'in-stock' : 'out-stock' }} mb-4">
            <i class="fas fa-circle" style="font-size:6px"></i>
            {{ $product->is_in_stock ? "En stock — {$product->stock} disponible(s)" : 'Rupture de stock' }}
          </div>

          <p class="product-desc mb-4">{{ $product->description }}</p>

          {{-- Specs --}}
          @if($product->specs)
            <div class="specs-table mb-4">
              <div class="specs-title"><i class="fas fa-list-ul me-2"></i>Caractéristiques</div>
              @foreach($product->specs as $key => $val)
                <div class="spec-row">
                  <span class="spec-key">{{ $key }}</span>
                  <span class="spec-val">{{ $val }}</span>
                </div>
              @endforeach
            </div>
          @endif

          {{-- Ajout panier --}}
          @if($product->is_in_stock)
            <form method="POST" action="{{ route('cart.add') }}" class="add-to-cart-form">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <div class="qty-control">
                <button type="button" onclick="changeQty(-1)">−</button>
                <input type="number" name="qty" id="qtyInput" value="1" min="1" max="{{ $product->stock }}">
                <button type="button" onclick="changeQty(1)">+</button>
              </div>
              <button type="submit" class="btn-glow flex-1">
                <i class="fas fa-cart-plus"></i> Ajouter au panier
              </button>
            </form>
          @else
            <button class="btn-glow w-100 disabled" disabled>
              <i class="fas fa-times"></i> Produit indisponible
            </button>
          @endif

          {{-- Description complète --}}
          @if($product->full_description)
            <div class="full-desc mt-5">
              <h4 class="mb-3">Description complète</h4>
              {!! nl2br(e($product->full_description)) !!}
            </div>
          @endif

        </div>
      </div>
    </div>

    {{-- PRODUITS SIMILAIRES --}}
    @if($related->count())
      <div class="mt-6">
        <div class="section-tag mb-2">Vous aimerez aussi</div>
        <h2 class="mb-4">Produits <span class="text-gradient">similaires</span></h2>
        <div class="products-grid">
          @foreach($related as $product)
            @include('partials.product-card', compact('product'))
          @endforeach
        </div>
      </div>
    @endif

  </div>
</section>
@endsection

@push('scripts')
<script>
function setMainImg(thumb) {
  document.getElementById('mainImg').src = thumb.src;
  document.querySelectorAll('.thumb-img').forEach(t => t.classList.remove('active'));
  thumb.classList.add('active');
}
function changeQty(delta) {
  const input = document.getElementById('qtyInput');
  const max   = parseInt(input.max);
  let val = parseInt(input.value) + delta;
  input.value = Math.min(Math.max(1, val), max);
}
</script>
@endpush