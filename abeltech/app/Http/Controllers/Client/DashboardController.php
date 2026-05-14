<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->orWhere('customer_email', $user->email)
            ->latest()
            ->paginate(10);
        
        return view('client.dashboard', compact('user', 'orders'));
    }
}
