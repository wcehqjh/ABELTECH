@extends('layouts.admin')
@section('title', isset($product) ? 'Modifier produit' : 'Nouveau produit')

@section('content')
<div class="admin-header">
  <h1>{{ isset($product) ? 'Modifier : '.$product->name : 'Nouveau produit' }}</h1>
  <a href="{{ route('admin.products.index') }}" class="btn-outline-glow">
    <i class="fas fa-arrow-left"></i> Retour
  </a>
</div>

<div class="admin-form-card">
  <form
    method="POST"
    action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
    enctype="multipart/form-data"
  >
    @csrf
    @isset($product) @method('PUT') @endisset

    <div class="row g-4">

      {{-- Nom --}}
      <div class="col-md-8">
        <label class="form-label-dark">Nom du produit *</label>
        <input type="text" name="name" class="input-dark @error('name') is-invalid @enderror"
          value="{{ old('name', $product->name ?? '') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      {{-- Marque --}}
      <div class="col-md-4">
        <label class="form-label-dark">Marque</label>
        <input type="text" name="brand" class="input-dark"
          value="{{ old('brand', $product->brand ?? '') }}">
      </div>

      {{-- Catégorie --}}
      <div class="col-md-4">
        <label class="form-label-dark">Catégorie *</label>
        <select name="category" class="input-dark" required>
          @foreach(['laptop'=>'PC Portable','desktop'=>'PC Bureau','gaming'=>'Gaming',
                    'console'=>'Console','tv'=>'Télévision','accessory'=>'Accessoire',
                    'component'=>'Pièce PC'] as $val => $lbl)
            <option value="{{ $val }}"
              {{ old('category', $product->category ?? '') === $val ? 'selected' : '' }}>
              {{ $lbl }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Prix --}}
      <div class="col-md-4">
        <label class="form-label-dark">Prix (MAD) *</label>
        <input type="number" name="price" class="input-dark" step="0.01"
          value="{{ old('price', $product->price ?? '') }}" required>
      </div>

      {{-- Ancien prix --}}
      <div class="col-md-4">
        <label class="form-label-dark">Ancien prix (MAD) <small class="text-muted">— pour badge Promo</small></label>
        <input type="number" name="old_price" class="input-dark" step="0.01"
          value="{{ old('old_price', $product->old_price ?? '') }}">
      </div>

      {{-- Stock --}}
      <div class="col-md-3">
        <label class="form-label-dark">Stock *</label>
        <input type="number" name="stock" class="input-dark" min="0"
          value="{{ old('stock', $product->stock ?? 0) }}" required>
      </div>

      {{-- Description courte --}}
      <div class="col-12">
        <label class="form-label-dark">Description courte</label>
        <textarea name="description" class="input-dark" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
      </div>

      {{-- Description complète --}}
      <div class="col-12">
        <label class="form-label-dark">Description complète</label>
        <textarea name="full_description" class="input-dark" rows="6">{{ old('full_description', $product->full_description ?? '') }}</textarea>
      </div>

      {{-- Image principale --}}
      <div class="col-md-6">
        <label class="form-label-dark">Image principale</label>
        <input type="file" name="image" class="input-dark" accept="image/*" onchange="previewImg(this)">
        @isset($product)
          @if($product->image)
            <img src="{{ $product->image_url }}" id="imgPreview"
              style="margin-top:10px;width:120px;height:80px;object-fit:cover;border-radius:8px;border:1px solid rgba(255,255,255,.1)">
          @endif
        @endisset
        <img id="imgPreview" src="" style="display:none;margin-top:10px;width:120px;height:80px;object-fit:cover;border-radius:8px">
      </div>

      {{-- Galerie --}}
      <div class="col-md-6">
        <label class="form-label-dark">Galerie d'images (multiple)</label>
        <input type="file" name="gallery[]" class="input-dark" accept="image/*" multiple>
      </div>

      {{-- Switches --}}
      <div class="col-12">
        <div class="d-flex gap-4 flex-wrap">
          <label class="switch-label">
            <input type="checkbox" name="is_new" {{ old('is_new', $product->is_new ?? false) ? 'checked' : '' }}>
            <span class="switch-track"></span>
            Badge "Nouveau"
          </label>
          <label class="switch-label">
            <input type="checkbox" name="is_promo" {{ old('is_promo', $product->is_promo ?? false) ? 'checked' : '' }}>
            <span class="switch-track"></span>
            Badge "Promo"
          </label>
          <label class="switch-label">
            <input type="checkbox" name="is_active" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
            <span class="switch-track"></span>
            Produit actif
          </label>
        </div>
      </div>

    </div>

    <div class="mt-5 d-flex gap-3">
      <button type="submit" class="btn-glow">
        <i class="fas fa-save"></i> {{ isset($product) ? 'Enregistrer' : 'Créer le produit' }}
      </button>
      <a href="{{ route('admin.products.index') }}" class="btn-outline-glow">Annuler</a>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
function previewImg(input) {
  if (!input.files[0]) return;
  const preview = document.getElementById('imgPreview');
  preview.src = URL.createObjectURL(input.files[0]);
  preview.style.display = 'block';
}
</script>
@endpush