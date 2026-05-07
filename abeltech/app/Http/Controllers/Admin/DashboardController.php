<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'       => Product::count(),
            'active'      => Product::where('is_active', true)->count(),
            'out_of_stock'=> Product::where('stock', 0)->count(),
            'promos'      => Product::where('is_promo', true)->count(),
        ];

        $by_category = Product::selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        $latest = Product::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'by_category', 'latest'));
    }
}