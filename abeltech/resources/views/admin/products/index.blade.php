@extends('layouts.admin')
@section('title', 'Gestion Produits')

@section('content')
<div class="admin-header">
  <div>
    <h1>Produits</h1>
    <p class="text-muted">{{ $products->total() }} produit(s) au total</p>
  </div>
  <a href="{{ route('admin.products.create') }}" class="btn-glow">
    <i class="fas fa-plus"></i> Nouveau produit
  </a>
</div>

<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Image</th><th>Nom</th><th>Catégorie</th>
        <th>Prix</th><th>Stock</th><th>Statut</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $p)
        <tr>
          <td>
            <img src="{{ $p->image_url }}" alt="{{ $p->name }}"
              style="width:56px;height:56px;object-fit:cover;border-radius:8px">
          </td>
          <td>
            <div class="fw-semibold">{{ $p->name }}</div>
            @if($p->brand) <small class="text-muted">{{ $p->brand }}</small> @endif
          </td>
          <td><span class="badge-product badge-new">{{ $p->category }}</span></td>
          <td>{{ number_format($p->price, 0, ',', ' ') }} MAD</td>
          <td>
            <span class="{{ $p->is_in_stock ? 'in-stock' : 'out-stock' }}">
              {{ $p->stock }}
            </span>
          </td>
          <td>
            @if($p->is_active)
              <span class="badge-product badge-new">Actif</span>
            @else
              <span class="badge-product badge-out">Inactif</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.products.edit', $p) }}" class="admin-btn-edit">
                <i class="fas fa-edit"></i>
              </a>
              <form method="POST" action="{{ route('admin.products.destroy', $p) }}"
                onsubmit="return confirm('Supprimer ce produit ?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-btn-delete"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="p-4">{{ $products->links() }}</div>
</div>
@endsection