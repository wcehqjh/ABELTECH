<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Liste des produits avec filtres + recherche
     */
    public function index(Request $request)
    {
        $query = Product::active()->latest();

        // Filtre catégorie
        if ($category = $request->get('categorie', 'all')) {
            $query->byCategory($category);
        }

        // Recherche
        if ($search = $request->get('q')) {
            $query->search($search);
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = [
            'all'       => ['label' => 'Tous',            'icon' => '🛍️'],
            'laptop'    => ['label' => 'PC Portables',    'icon' => '💻'],
            'desktop'   => ['label' => 'PC Bureau',       'icon' => '🖥️'],
            'gaming'    => ['label' => 'Gaming',          'icon' => '🎮'],
            'console'   => ['label' => 'Consoles',        'icon' => '🕹️'],
            'tv'        => ['label' => 'Télévisions',     'icon' => '📺'],
            'accessory' => ['label' => 'Accessoires',     'icon' => '🖱️'],
            'component' => ['label' => 'Pièces PC',       'icon' => '⚡'],
        ];

        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Détail produit
     */
    public function show(string $slug)
    {
        $product = Product::active()
            ->with('images')
            ->where('slug', $slug)
            ->firstOrFail();

        // Produits similaires (même catégorie)
        $related = Product::active()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('shop.show', compact('product', 'related'));
    }
}