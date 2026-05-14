<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items')->latest();

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(15);

        $counts = [
            'all'        => Order::count(),
            'pending'    => Order::where('status','pending')->count(),
            'confirmed'  => Order::where('status','confirmed')->count(),
            'processing' => Order::where('status','processing')->count(),
            'shipped'    => Order::where('status','shipped')->count(),
            'delivered'  => Order::where('status','delivered')->count(),
            'cancelled'  => Order::where('status','cancelled')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'counts'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', "Statut mis à jour : {$order->status_label}");
    }
}