<?php

use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;  // هادا هو الجديد
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| SHOP (public)
|--------------------------------------------------------------------------
*/
Route::prefix('boutique')->name('shop.')->group(function () {
    Route::get('/',               [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}',         [ProductController::class, 'show'])->name('show');
});

// Redirection accueil → boutique
Route::get('/', fn() => redirect()->route('shop.index'));

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/
Route::prefix('panier')->name('cart.')->group(function () {
    Route::get('/',               [CartController::class, 'index'])->name('index');
    Route::post('/ajouter',       [CartController::class, 'add'])->name('add');
    Route::patch('/quantite',     [CartController::class, 'updateQty'])->name('updateQty');
    Route::delete('/supprimer/{id}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/vider',       [CartController::class, 'clear'])->name('clear');
});

/*
|--------------------------------------------------------------------------
| AUTH (publique)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login',  [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
/*
|--------------------------------------------------------------------------
| ADMIN (protégé)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
});