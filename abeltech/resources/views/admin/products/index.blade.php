@extends('layouts.admin')

@section('title', 'Produits')
@section('header_title', 'Gestion des produits')
@section('header_desc', 'Ajoutez, modifiez ou supprimez des produits')

@section('content')

<div class="admin-table-container">
    <div class="admin-table-header">
        <h3 class="admin-table-title">Liste des produits</h3>
        <div class="admin-table-actions">
            <a href="{{ route('admin.products.create') }}" class="btn-primary" style="padding: 8px 16px; font-size: 13px;">
                <i class="fas fa-plus"></i> Nouveau produit
            </a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                    @else
                        <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.05); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </td>
                <td><strong>{{ $product->name }}</strong><br><small style="color: rgba(255,255,255,0.5);">{{ $product->brand }}</small></td>
                <td>{{ number_format($product->price, 0, ',', ' ') }} MAD</td>
                <td>
                    @if($product->stock > 0)
                        <span style="color: #22c55e;">{{ $product->stock }} en stock</span>
                    @else
                        <span style="color: #ef4444;">Rupture</span>
                    @endif
                </td>
                <td>
                    @if($product->is_active)
                        <span class="status-badge status-completed">Actif</span>
                    @else
                        <span class="status-badge status-cancelled">Inactif</span>
                    @endif
                </td>
                <td class="table-actions">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn-edit" style="padding: 6px 12px; border-radius: 8px;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" style="padding: 6px 12px; border-radius: 8px;" onclick="return confirm('Supprimer ce produit ?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px;">
                        <i class="fas fa-box-open" style="font-size: 48px; color: rgba(255,255,255,0.2);"></i>
                        <p style="margin-top: 12px;">Aucun produit pour le moment</p>
                        <a href="{{ route('admin.products.create') }}" class="btn-primary">Créer le premier produit</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>

<style>
.alert-success {
    background: rgba(34,197,94,0.15);
    border: 1px solid rgba(34,197,94,0.3);
    border-radius: 12px;
    padding: 12px 16px;
    margin: 16px 20px;
    color: #22c55e;
    display: flex;
    align-items: center;
    gap: 10px;
}
.btn-edit {
    background: rgba(0,212,255,0.15);
    color: #00d4ff;
    border: none;
}
.btn-delete {
    background: rgba(239,68,68,0.15);
    color: #ef4444;
    border: none;
    cursor: pointer;
}
.btn-edit:hover, .btn-delete:hover {
    transform: translateY(-2px);
}
</style>
@endsection
