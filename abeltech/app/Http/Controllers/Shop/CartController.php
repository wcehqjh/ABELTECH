<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Afficher le panier
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        // Vérifier et corriger la structure du panier
        foreach ($cart as $id => &$item) {
            // Si l'item n'a pas de 'quantity', utiliser 'qty' ou initialiser à 1
            if (!isset($item['quantity'])) {
                if (isset($item['qty'])) {
                    $item['quantity'] = $item['qty'];
                    unset($item['qty']);
                } else {
                    $item['quantity'] = 1;
                }
            }
            
            // S'assurer que le prix existe
            if (!isset($item['price'])) {
                $item['price'] = 0;
            }
            
            $total += $item['price'] * $item['quantity'];
        }
        
        // Sauvegarder la structure corrigée
        session()->put('cart', $cart);
        
        return view('cart.index', compact('cart', 'total'));
    }
    
    /**
     * Ajouter un produit au panier
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'nullable|integer|min:1'
        ]);
        
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('qty', 1);
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'stock' => $product->stock,
                'slug' => $product->slug ?? \Illuminate\Support\Str::slug($product->name),
                'image' => $product->image ? asset('storage/' . $product->image) : null
            ];
        }
        
        session()->put('cart', $cart);
        
        // Redirection vers la page du panier
        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier');
    }
    
    /**
     * Mettre à jour la quantité
     */
    public function updateQty(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|integer|min:1'
        ]);
        
        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        $quantity = $request->input('qty', 1);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour');
    }
    
    /**
     * Supprimer un produit du panier
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier');
    }
    
    /**
     * Vider complètement le panier
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Panier vidé');
    }
    
    /**
     * Obtenir le nombre d'articles dans le panier (API)
     */
    public function count()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        
        foreach ($cart as $item) {
            $count += isset($item['quantity']) ? $item['quantity'] : (isset($item['qty']) ? $item['qty'] : 1);
        }
        
        return response()->json(['count' => $count]);
    }
}
