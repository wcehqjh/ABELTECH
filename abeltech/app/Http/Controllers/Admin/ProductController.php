<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'category'         => 'required|in:laptop,desktop,gaming,console,tv,accessory,component',
            'price'            => 'required|numeric|min:0',
            'old_price'        => 'nullable|numeric|min:0',
            'description'      => 'nullable|string',
            'full_description' => 'nullable|string',
            'stock'            => 'required|integer|min:0',
            'brand'            => 'nullable|string|max:100',
            'image'            => 'nullable|image|max:5120',
            'is_new'           => 'boolean',
            'is_promo'         => 'boolean',
            'is_active'        => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['slug']     = Str::slug($data['name']);
        $data['is_new']   = $request->boolean('is_new');
        $data['is_promo'] = $request->boolean('is_promo');
        $data['is_active']= $request->boolean('is_active', true);

        // Upload galerie
        $product = Product::create($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $i => $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create(['path' => $path, 'order' => $i]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit créé !');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'category'         => 'required|in:laptop,desktop,gaming,console,tv,accessory,component',
            'price'            => 'required|numeric|min:0',
            'old_price'        => 'nullable|numeric|min:0',
            'description'      => 'nullable|string',
            'full_description' => 'nullable|string',
            'stock'            => 'required|integer|min:0',
            'brand'            => 'nullable|string|max:100',
            'image'            => 'nullable|image|max:5120',
            'is_new'           => 'boolean',
            'is_promo'         => 'boolean',
            'is_active'        => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['slug']     = Str::slug($data['name']);
        $data['is_new']   = $request->boolean('is_new');
        $data['is_promo'] = $request->boolean('is_promo');
        $data['is_active']= $request->boolean('is_active', true);

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour !');
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->images->each(fn($img) => Storage::disk('public')->delete($img->path));
        $product->delete();

        return back()->with('success', 'Produit supprimé.');
    }
}