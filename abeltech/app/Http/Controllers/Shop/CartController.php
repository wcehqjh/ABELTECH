<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Afficher le panier
     */
    public function index()
    {
        $cart  = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id', 'qty' => 'integer|min:1']);

        $product = Product::findOrFail($request->product_id);
        $cart    = session('cart', []);
        $key     = $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $request->qty ?? 1;
        } else {
            $cart[$key] = [
                'id'    => $product->id,
                'name'  => $product->name,
                'price' => $product->price,
                'image' => $product->image_url,
                'slug'  => $product->slug,
                'qty'   => $request->qty ?? 1,
                'stock' => $product->stock,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', "«{$product->name}» ajouté au panier !");
    }

    /**
     * Modifier quantité
     */
    public function updateQty(Request $request)
    {
        $request->validate(['product_id' => 'required', 'qty' => 'required|integer|min:1']);

        $cart = session('cart', []);
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['qty'] = $request->qty;
            session(['cart' => $cart]);
        }

        return back();
    }

    /**
     * Supprimer un produit
     */
    public function remove(int $id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Produit retiré du panier.');
    }

    /**
     * Vider le panier
     */
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Panier vidé.');
    }
}