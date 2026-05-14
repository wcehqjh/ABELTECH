<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Afficher la page de checkout
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $quantity = isset($item['quantity']) ? $item['quantity'] : (isset($item['qty']) ? $item['qty'] : 1);
            $total += $item['price'] * $quantity;
        }
        
        return view('checkout.index', compact('cart', 'total'));
    }
    
    /**
     * Traiter la commande
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'payment_method' => 'required|in:cash,card,transfer'
        ]);
        
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $quantity = isset($item['quantity']) ? $item['quantity'] : (isset($item['qty']) ? $item['qty'] : 1);
            $subtotal += $item['price'] * $quantity;
        }
        
        $shipping = 0;
        $total = $subtotal + $shipping;
        
        $order = null;
        
        DB::transaction(function () use ($request, $cart, $subtotal, $shipping, $total, &$order) {
            // Créer la commande
            $order = Order::create([
                'order_number' => $this->generateOrderNumber(),
                'user_id' => auth()->id(),
                'customer_name' => $request->first_name . ' ' . $request->last_name,
                'customer_email' => $request->email,
                'customer_phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending'
            ]);
            
            // Créer les lignes de commande
            foreach ($cart as $id => $item) {
                $quantity = isset($item['quantity']) ? $item['quantity'] : (isset($item['qty']) ? $item['qty'] : 1);
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $item['name'],
                    'product_price' => $item['price'],
                    'quantity' => $quantity,
                    'subtotal' => $item['price'] * $quantity
                ]);
                
                // Diminuer le stock
                Product::where('id', $id)->decrement('stock', $quantity);
            }
            
            // Vider le panier
            session()->forget('cart');
        });
        
        // Stocker l'ID de la commande dans la session pour la page de succès
        session()->flash('last_order_id', $order->id);
        
        return redirect()->route('checkout.success')->with('success', 'Commande validée avec succès !');
    }
    
    /**
     * Page de succès après commande
     */
    public function success()
    {
        $orderId = session()->get('last_order_id');
        
        if (!$orderId) {
            return redirect()->route('boutique')->with('error', 'Aucune commande trouvée.');
        }
        
        $order = Order::with('items')->findOrFail($orderId);
        
        // Effacer l'ID de la session après l'avoir utilisé
        session()->forget('last_order_id');
        
        return view('checkout.success', compact('order'));
    }
    
    /**
     * Générer un numéro de commande unique
     */
    private function generateOrderNumber()
    {
        $prefix = 'ABEL-';
        $date = date('Ymd');
        $random = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        
        return $prefix . $date . '-' . $random;
    }
}
