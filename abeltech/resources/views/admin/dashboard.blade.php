@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<!-- STATS CARDS -->
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(0,212,255,.1);color:#00d4ff">
      <i class="fas fa-box"></i>
    </div>
    <div>
      <div class="stat-value">{{ $stats['total'] }}</div>
      <div class="stat-label">Total produits</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(34,197,94,.1);color:#22c55e">
      <i class="fas fa-check-circle"></i>
    </div>
    <div>
      <div class="stat-value">{{ $stats['active'] }}</div>
      <div class="stat-label">Produits actifs</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(255,87,87,.1);color:#ff5757">
      <i class="fas fa-exclamation-triangle"></i>
    </div>
    <div>
      <div class="stat-value">{{ $stats['out_of_stock'] }}</div>
      <div class="stat-label">Rupture de stock</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(251,191,36,.1);color:#fbbf24">
      <i class="fas fa-tag"></i>
    </div>
    <div>
      <div class="stat-value">{{ $stats['promos'] }}</div>
      <div class="stat-label">En promotion</div>
    </div>
  </div>
</div>

<div class="row g-4 mt-1">
  <!-- Répartition catégories -->
  <div class="col-lg-5">
    <div class="admin-card">
      <div class="admin-card-header">
        <h5><i class="fas fa-chart-pie me-2" style="color:#00d4ff"></i>Répartition par catégorie</h5>
      </div>
      <div class="admin-card-body">
        @php
          $catLabels = [
            'laptop'=>'PC Portables','desktop'=>'PC Bureau','gaming'=>'Gaming',
            'console'=>'Consoles','tv'=>'Télévisions','accessory'=>'Accessoires','component'=>'Pièces PC'
          ];
          $total = $by_category->sum();
        @endphp
        @foreach($by_category as $cat => $count)
          <div class="category-bar-wrap">
            <div class="d-flex justify-content-between mb-1">
              <span style="font-size:.85rem;color:#b0b8c8">{{ $catLabels[$cat] ?? $cat }}</span>
              <span style="font-size:.85rem;color:#fff;font-weight:600">{{ $count }}</span>
            </div>
            <div class="category-bar-track">
              <div class="category-bar-fill"
                style="width:{{ $total ? round($count/$total*100) : 0 }}%"></div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Derniers produits -->
  <div class="col-lg-7">
    <div class="admin-card">
      <div class="admin-card-header">
        <h5><i class="fas fa-clock me-2" style="color:#00d4ff"></i>Derniers produits ajoutés</h5>
        <a href="{{ route('admin.products.index') }}" class="btn-outline-glow" style="padding:6px 14px;font-size:.8rem">
          Voir tout
        </a>
      </div>
      <div class="admin-card-body p-0">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Produit</th><th>Catégorie</th><th>Prix</th><th>Stock</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latest as $p)
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ $p->image_url }}" alt="{{ $p->name }}"
                      style="width:40px;height:40px;object-fit:cover;border-radius:8px">
                    <span style="font-size:.88rem">{{ Str::limit($p->name, 28) }}</span>
                  </div>
                </td>
                <td><span class="badge-product badge-new">{{ $p->category }}</span></td>
                <td style="color:#00d4ff;font-weight:600">{{ number_format($p->price,0,',',' ') }} MAD</td>
                <td class="{{ $p->is_in_stock ? 'in-stock' : 'out-stock' }}">{{ $p->stock }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection