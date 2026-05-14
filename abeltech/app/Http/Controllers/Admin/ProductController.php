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
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:100',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_new' => 'nullable',
            'is_promo' => 'nullable',
            'is_active' => 'nullable',
        ]);

        $product = new Product();
        $product->name = $validated['name'];
        $product->slug = Str::slug($validated['name']) . '-' . uniqid();
        $product->brand = $validated['brand'] ?? null;
        $product->category = $validated['category'];
        $product->price = $validated['price'];
        $product->old_price = $validated['old_price'] ?? null;
        $product->stock = $validated['stock'];
        $product->description = $validated['description'] ?? null;
        $product->full_description = $validated['full_description'] ?? null;
        $product->is_new = $request->has('is_new');
        $product->is_promo = $request->has('is_promo');
        $product->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit créé avec succès !');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:100',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_new' => 'nullable',
            'is_promo' => 'nullable',
            'is_active' => 'nullable',
        ]);

        $product->name = $validated['name'];
        $product->brand = $validated['brand'] ?? null;
        $product->category = $validated['category'];
        $product->price = $validated['price'];
        $product->old_price = $validated['old_price'] ?? null;
        $product->stock = $validated['stock'];
        $product->description = $validated['description'] ?? null;
        $product->full_description = $validated['full_description'] ?? null;
        $product->is_new = $request->has('is_new');
        $product->is_promo = $request->has('is_promo');
        $product->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit modifié avec succès !');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès !');
    }
}
