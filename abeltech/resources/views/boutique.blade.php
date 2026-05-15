@extends('layouts.app')

@section('title', 'Boutique')
@section('meta_desc', 'Achetez PC portables, gaming, TV et accessoires tech chez Abeltech Maroc.')

@section('content')

{{-- HERO BOUTIQUE --}}
<div class="page-hero">
  <div class="container" style="position:relative;z-index:1;">
    <div class="breadcrumb-abeltech justify-content-center mb-3">
      <a href="{{ route('home') }}">Accueil</a>
      <span class="sep"><i class="fas fa-chevron-right"></i></span>
      <span style="color: var(--cyan);">Boutique</span>
    </div>

    <div class="section-eyebrow" style="justify-content:center;">
      <span class="eyebrow-dot"></span> Notre catalogue
    </div>

    <h1>Notre <span class="text-gradient">Boutique</span></h1>


    {{-- BARRE DE RECHERCHE --}}
    <form method="GET" action="{{ route('boutique') }}" class="search-bar-wrap mx-auto mt-4">
      <input type="hidden" name="category" value="{{ $currentCat }}">
      <input type="hidden" name="sort" value="{{ $currentSort }}">

      <div class="search-bar-inner">
        <i class="fas fa-search search-bar-icon"></i>
        <input type="text" name="q" class="search-bar-input" 
               placeholder="Rechercher un produit, une marque…"
               value="{{ $currentSearch }}" autocomplete="off">
        @if($currentSearch)
          <a href="{{ route('boutique', ['category' => $currentCat, 'sort' => $currentSort]) }}"
             class="search-bar-clear" title="Effacer">
            <i class="fas fa-times"></i>
          </a>
        @endif
      </div>
      <button type="submit" class="btn-search">
        <i class="fas fa-search"></i> Rechercher
      </button>
    </form>
  </div>
</div>

{{-- FILTRES + PRODUITS --}}
<section style="padding: 48px 0 90px;">
  <div class="container">

    {{-- FILTRES CATÉGORIE + TRI --}}
    <form method="GET" action="{{ route('boutique') }}" id="filterForm">
      <input type="hidden" name="q" value="{{ $currentSearch }}">

      <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div class="filter-pills mb-0">
          <button type="submit" name="category" value=""
                  class="filter-pill {{ $currentCat === '' ? 'active' : '' }}">
            <span class="pill-icon">🛍️</span> Tous
          </button>
          @foreach($categories as $slug => $label)
            <button type="submit" name="category" value="{{ $slug }}"
                    class="filter-pill {{ $currentCat === $slug ? 'active' : '' }}">
              {{ $label }}
            </button>
          @endforeach
        </div>

        <div style="display:flex;align-items:center;gap:10px;flex-shrink:0;">
          <label style="font-size:12px;color:rgba(255,255,255,0.4);white-space:nowrap;">
            Trier par :
          </label>
          <select name="sort" onchange="this.form.submit()" class="sort-select">
            <option value="default" {{ $currentSort === 'default' ? 'selected' : '' }}>Par défaut</option>
            <option value="price_asc" {{ $currentSort === 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
            <option value="price_desc" {{ $currentSort === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
          </select>
        </div>
      </div>
    </form>

    {{-- RÉSULTATS --}}
    <div class="results-bar">
      <p class="results-count mb-0">
        <strong>{{ $total }}</strong> produit(s) trouvé(s)
        @if($currentSearch)
          pour <span class="keyword">"{{ $currentSearch }}"</span>
        @endif
        @if($currentCat && isset($categories[$currentCat]))
          dans <span class="keyword">{{ $categories[$currentCat] }}</span>
        @endif
      </p>
      @if($currentSearch || $currentCat)
        <a href="{{ route('boutique') }}" class="btn-ghost" style="font-size:12px;padding:8px 16px;">
          <i class="fas fa-times me-1"></i> Réinitialiser
        </a>
      @endif
    </div>

    {{-- GRILLE PRODUITS --}}
    @if($products->isNotEmpty())
      <div class="products-grid">
        @foreach($products as $i => $product)
          <div class="product-card" style="animation-delay: {{ $i * 60 }}ms;">
            <div class="card-img-wrap">
              <div class="card-badges">
                @if($product->is_new)
                  <span class="badge badge-new">Nouveau</span>
                @endif
                @if($product->is_promo && $product->old_price)
                  <span class="badge badge-promo">Promo</span>
                @endif
                @if($product->stock == 0)
                  <span class="badge badge-out">Épuisé</span>
                @endif
              </div>

              <button class="card-wishlist" title="Ajouter aux favoris">
                <i class="fas fa-heart"></i>
              </button>

              @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;">
              @else
                @php
                  $emojis = ['laptop'=>'💻','desktop'=>'🖥️','gaming'=>'🎮','console'=>'🕹️','tv'=>'📺','accessory'=>'🖱️','component'=>'⚡'];
                @endphp
                <div class="card-img-placeholder">{{ $emojis[$product->category] ?? '📦' }}</div>
              @endif
            </div>

            <div class="card-body">
              <div class="card-category">{{ $product->category }}</div>
              <a href="{{ route('product.show', $product->slug) }}" class="card-title">{{ $product->name }}</a>
              <div class="card-brand">{{ $product->brand }}</div>
              <p class="card-desc">{{ Str::limit($product->description ?? '', 80) }}</p>

              <div class="card-stock {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                <span class="stock-dot"></span>
                {{ $product->stock > 0 ? "En stock ({$product->stock})" : 'Rupture de stock' }}
              </div>

              <div class="card-footer">
                <div class="price-wrap">
                  <span class="price">{{ number_format($product->price, 0, ',', ' ') }} MAD</span>
                  @if($product->old_price)
                    <span class="price-old">{{ number_format($product->old_price, 0, ',', ' ') }} MAD</span>
                  @endif
                </div>

                @if($product->stock > 0)
                  <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="1">
                    <button type="submit" class="btn-add-cart">
                      <i class="fas fa-cart-plus"></i> Ajouter
                    </button>
                  </form>
                @else
                  <button class="btn-add-cart" disabled>
                    <i class="fas fa-times"></i> Indisponible
                  </button>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>


    @else
      <div class="empty-state">
        <div class="empty-icon">🔍</div>
        <h3>Aucun produit trouvé</h3>
        <p>Essayez une autre recherche ou explorez toutes les catégories.</p>
        <a href="{{ route('boutique') }}" class="btn-primary">
          <i class="fas fa-store me-2"></i> Voir tous les produits
        </a>
      </div>
    @endif

  </div>
</section>

<style>
.sort-select {
    background: rgba(255,255,255,0.04);
    border: 1.5px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    color: #fff;
    font-size: 13px;
    padding: 9px 14px;
    outline: none;
    cursor: pointer;
}
.sort-select option {
    background: #0a0a0f;
}
.pagination-wrapper nav {
    display: flex;
    justify-content: center;
}
.pagination-wrapper .pagination {
    display: flex;
    gap: 6px;
    list-style: none;
    padding: 0;
}
.pagination-wrapper .page-item .page-link {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 8px;
    padding: 8px 14px;
    color: rgba(255,255,255,0.7);
    text-decoration: none;
}
.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #00d4ff, #7c3aed);
    color: #fff;
}
</style>
@endsection

{{-- إضافة زر الملف الشخصي في أعلى الصفحة --}}
<div class="container mt-4">
  <div class="d-flex justify-content-end">
    @auth
      <a href="{{ route('client.dashboard') }}" class="btn-profile">
        <i class="fas fa-user-circle"></i> Mon profil
      </a>
    @else
      <a href="{{ route('client.login') }}" class="btn-profile">
        <i class="fas fa-sign-in-alt"></i> Espace client
      </a>
    @endauth
  </div>
</div>

<style>
.btn-profile {
  background: linear-gradient(135deg, #00d4ff, #7c3aed);
  border: none;
  padding: 10px 20px;
  border-radius: 40px;
  color: #fff;
  font-weight: 600;
  font-size: 14px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s ease;
  margin-bottom: 20px;
}

.btn-profile:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,212,255,0.3);
  color: #fff;
}
</style>
