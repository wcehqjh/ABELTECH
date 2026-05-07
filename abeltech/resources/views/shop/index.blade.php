@extends('layouts.app')

@section('title', 'Boutique')
@section('meta_description', 'Achetez PC portables, gaming, TV et accessoires tech chez Abeltech Maroc.')

@section('content')

{{-- HERO --}}
<div class="page-hero">
  <div class="container position-relative" style="z-index:1">
    <div class="section-tag">Notre catalogue</div>
    <h1>Notre <span class="text-gradient">Boutique</span></h1>
    <p class="mt-3" style="max-width:520px;margin:auto">
      PC portables, gaming, TV, consoles et accessoires — tout pour votre setup parfait.
    </p>
  </div>
</div>

<section style="padding:60px 0 100px">
  <div class="container">

    {{-- BARRE RECHERCHE + FILTRES --}}
    <div class="shop-toolbar">
      {{-- Recherche --}}
      <form method="GET" action="{{ route('shop.index') }}" class="search-form">
        <input type="hidden" name="categorie" value="{{ request('categorie', 'all') }}">
        <div class="search-wrap">
          <i class="fas fa-search search-icon"></i>
          <input type="text" name="q" placeholder="Rechercher un produit, une marque…" value="{{ request('q') }}" class="search-input" autocomplete="off">
          @if(request('q'))
            <a href="{{ route('shop.index', ['categorie' => request('categorie', 'all')]) }}" class="search-clear">
              <i class="fas fa-times"></i>
            </a>
          @endif
        </div>
        <button type="submit" class="btn-glow" style="padding:12px 24px">
          <i class="fas fa-search"></i> Rechercher
        </button>
      </form>

      {{-- Filtres catégories --}}
      <div class="filter-tabs">
  @foreach($categories as $slug => $cat)
    <a href="{{ route('shop.index', ['categorie' => $slug, 'q' => request('q')]) }}" class="filter-tab {{ request('categorie', 'all') === $slug ? 'active' : '' }}">
      <span>{{ $cat['icon'] }}</span> {{ $cat['label'] }}
    </a>
  @endforeach
</div>

    {{-- RÉSULTATS --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <p class="text-gray-400 mb-0">
        <span class="text-white fw-semibold">{{ $products->total() }}</span> produit(s) trouvé(s)
        @if(request('q'))
          pour <span class="text-gradient">"{{ request('q') }}"</span>
        @endif
      </p>
    </div>

    {{-- GRILLE PRODUITS --}}
    @if($products->count())
      <div class="products-grid">
        @foreach($products as $product)
          @include('partials.product-card', compact('product'))
        @endforeach
      </div>

      {{-- PAGINATION --}}
      <div class="mt-5 d-flex justify-content-center">
        {{ $products->links('partials.pagination') }}
      </div>

    @else
      <div class="empty-state">
        <div style="font-size:4rem">🔍</div>
        <h3>Aucun produit trouvé</h3>
        <p>Essayez une autre recherche ou explorez toutes les catégories.</p>
        <a href="{{ route('shop.index') }}" class="btn-glow mt-3">
          <i class="fas fa-store"></i> Voir tous les produits
        </a>
      </div>
    @endif

  </div>
</section>

@endsection
