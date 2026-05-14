<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BoutiqueController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);
        
        // Recherche
        if ($search = $request->get('q')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Filtre catégorie
        if ($category = $request->get('category')) {
            $query->where('category', $category);
        }
        
        // Tri
        $sort = $request->get('sort', 'default');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }
        
        // Récupérer les produits (Objects, pas Array)
        $products = $query->paginate(12);
        
        $categories = [
            'laptop' => '💻 PC Portables',
            'desktop' => '🖥️ PC Bureau',
            'gaming' => '🎮 Gaming',
            'console' => '🕹️ Consoles',
            'tv' => '📺 Télévisions',
            'accessory' => '🖱️ Accessoires',
            'component' => '⚡ Pièces PC',
        ];
        
        return view('boutique', [
            'products' => $products,  // C'est un objet Paginator avec des objets Product
            'categories' => $categories,
            'total' => $products->total(),
            'currentSearch' => $request->get('q', ''),
            'currentCat' => $request->get('category', ''),
            'currentSort' => $sort,
        ]);
    }
    
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $related = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();
        
        return view('shop.show', compact('product', 'related'));
    }
}
