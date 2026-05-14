@extends('layouts.admin')

@section('title', isset($product) ? 'Modifier ' . $product->name : 'Nouveau produit')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
<div class="admin-header">
    <h1>{{ isset($product) ? 'Modifier : ' . $product->name : 'Nouveau produit' }}</h1>
    <a href="{{ route('admin.products.index') }}" class="btn-outline-glow">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
</div>

<div class="admin-form-card">
    <form method="POST" 
          action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" 
          enctype="multipart/form-data">
        @csrf
        @isset($product)
            @method('PUT')
        @endisset

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            <!-- Nom -->
            <div class="col-md-8">
                <div class="form-group">
                    <label class="form-label-dark">Nom du produit *</label>
                    <input type="text" name="name" class="input-dark @error('name') is-invalid @enderror" 
                           value="{{ old('name', $product->name ?? '') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Marque -->
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label-dark">Marque</label>
                    <input type="text" name="brand" class="input-dark" 
                           value="{{ old('brand', $product->brand ?? '') }}">
                </div>
            </div>

            <!-- Catégorie -->
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label-dark">Catégorie *</label>
                    <select name="category" class="input-dark" required>
                        <option value="">Sélectionner une catégorie</option>
                        <option value="laptop" {{ old('category', $product->category ?? '') == 'laptop' ? 'selected' : '' }}>💻 PC Portable</option>
                        <option value="desktop" {{ old('category', $product->category ?? '') == 'desktop' ? 'selected' : '' }}>🖥️ PC Bureau</option>
                        <option value="gaming" {{ old('category', $product->category ?? '') == 'gaming' ? 'selected' : '' }}>🎮 Gaming</option>
                        <option value="console" {{ old('category', $product->category ?? '') == 'console' ? 'selected' : '' }}>🕹️ Console</option>
                        <option value="tv" {{ old('category', $product->category ?? '') == 'tv' ? 'selected' : '' }}>📺 Télévision</option>
                        <option value="accessory" {{ old('category', $product->category ?? '') == 'accessory' ? 'selected' : '' }}>🖱️ Accessoire</option>
                        <option value="component" {{ old('category', $product->category ?? '') == 'component' ? 'selected' : '' }}>⚡ Pièce PC</option>
                    </select>
                </div>
            </div>

            <!-- Prix -->
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label-dark">Prix (MAD) *</label>
                    <input type="number" name="price" class="input-dark" step="0.01" 
                           value="{{ old('price', $product->price ?? '') }}" required>
                </div>
            </div>

            <!-- Ancien prix -->
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label-dark">Ancien prix (MAD) <small>(Pour promo)</small></label>
                    <input type="number" name="old_price" class="input-dark" step="0.01" 
                           value="{{ old('old_price', $product->old_price ?? '') }}">
                </div>
            </div>

            <!-- Stock -->
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label-dark">Stock *</label>
                    <input type="number" name="stock" class="input-dark" min="0" 
                           value="{{ old('stock', $product->stock ?? 0) }}" required>
                </div>
            </div>

            <!-- Description courte -->
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label-dark">Description courte</label>
                    <textarea name="description" class="input-dark" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
            </div>

            <!-- Description complète -->
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label-dark">Description complète</label>
                    <textarea name="full_description" class="input-dark" rows="6">{{ old('full_description', $product->full_description ?? '') }}</textarea>
                </div>
            </div>

            <!-- Image principale -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-dark">Image principale</label>
                    <input type="file" name="image" class="input-dark" accept="image/*" id="mainImage">
                    <div id="imagePreview" style="margin-top: 12px;">
                        @if(isset($product) && $product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px;">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Galerie -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-dark">Galerie d'images (Plusieurs)</label>
                    <input type="file" name="gallery[]" class="input-dark" accept="image/*" multiple>
                </div>
            </div>

            <!-- Options -->
            <div class="col-12">
                <div class="d-flex gap-4 flex-wrap">
                    <label class="switch-label">
                        <input type="checkbox" name="is_new" value="1" 
                               {{ old('is_new', $product->is_new ?? false) ? 'checked' : '' }}>
                        <span class="switch-track"></span>
                        Badge "Nouveau"
                    </label>
                    <label class="switch-label">
                        <input type="checkbox" name="is_promo" value="1" 
                               {{ old('is_promo', $product->is_promo ?? false) ? 'checked' : '' }}>
                        <span class="switch-track"></span>
                        Badge "Promo"
                    </label>
                    <label class="switch-label">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                        <span class="switch-track"></span>
                        Produit actif
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-5 d-flex gap-3">
            <button type="submit" class="btn-glow">
                <i class="fas fa-save"></i> 
                {{ isset($product) ? 'Enregistrer les modifications' : 'Créer le produit' }}
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-outline-glow">Annuler</a>
        </div>
    </form>
</div>

<script>
document.getElementById('mainImage')?.addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.innerHTML = `<img src="${event.target.result}" style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px;">`;
        }
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>

<style>
.alert-danger {
    background: rgba(239,68,68,0.15);
    border: 1px solid rgba(239,68,68,0.3);
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
    color: #ef4444;
}
.alert-danger ul {
    margin: 0;
    padding-left: 20px;
}
</style>
@endsection
