<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;
use App\Http\Controllers\ContactController;  // <-- أضف هذا السطر

/*
|--------------------------------------------------------------------------
| Routes publiques — ABELTECH
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', fn() => view('welcome'))->name('home');

// Pages statiques
Route::get('/services', fn() => view('services'))->name('services');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');  // <-- أضف هذا السطر
Route::get('/devis', fn() => view('devis'))->name('devis');

// Boutique publique
Route::get('/boutique', [BoutiqueController::class, 'index'])->name('boutique');
Route::get('/shop', [BoutiqueController::class, 'index'])->name('shop.index');

// Détails d'un produit
Route::get('/produit/{slug}', [BoutiqueController::class, 'show'])->name('product.show');
Route::get('/shop/{slug}', [BoutiqueController::class, 'show'])->name('shop.show');

/*
|--------------------------------------------------------------------------
| PANIER (CART)
|--------------------------------------------------------------------------
*/
Route::prefix('panier')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/ajouter', [CartController::class, 'add'])->name('add');
    Route::patch('/quantite', [CartController::class, 'updateQty'])->name('updateQty');
    Route::delete('/supprimer/{id}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/vider', [CartController::class, 'clear'])->name('clear');
});

// Routes AJAX pour le panier
Route::get('/panier/count', [App\Http\Controllers\Shop\CartController::class, 'count'])->name('cart.count');
Route::delete('/panier/supprimer/{id}', [App\Http\Controllers\Shop\CartController::class, 'remove'])->name('cart.remove');
Route::delete('/panier/vider', [App\Http\Controllers\Shop\CartController::class, 'clear'])->name('cart.clear');


/*
|--------------------------------------------------------------------------
| CHECKOUT (COMMANDE)
|--------------------------------------------------------------------------
*/
Route::prefix('commande')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/valider', [CheckoutController::class, 'store'])->name('store');
    Route::get('/succes', [CheckoutController::class, 'success'])->name('success');
});

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN (protégé)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
});
  Route::get('/messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{id}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');


// Routes pour mot de passe oublié
Route::get('/admin/forgot-password', [App\Http\Controllers\Admin\AuthController::class, 'showForgotForm'])->name('admin.forgot');
Route::post('/admin/forgot-password', [App\Http\Controllers\Admin\AuthController::class, 'sendResetLink'])->name('admin.forgot.post');
Route::get('/admin/reset-password/{token}', [App\Http\Controllers\Admin\AuthController::class, 'showResetForm'])->name('admin.reset');
Route::post('/admin/reset-password', [App\Http\Controllers\Admin\AuthController::class, 'resetPassword'])->name('admin.reset.post');
// Routes pour les messages de contact
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{id}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');
});

// Routes pour les demandes de devis
Route::post('/devis', [App\Http\Controllers\DevisController::class, 'send'])->name('devis.send');

// Routes admin pour les demandes de devis
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/devis', [App\Http\Controllers\Admin\DevisController::class, 'index'])->name('devis.index');
    Route::get('/devis/{id}', [App\Http\Controllers\Admin\DevisController::class, 'show'])->name('devis.show');
    Route::delete('/devis/{id}', [App\Http\Controllers\Admin\DevisController::class, 'destroy'])->name('devis.destroy');
});

/*
|--------------------------------------------------------------------------
| CLIENT AUTHENTICATION (Espace Client)
|--------------------------------------------------------------------------
*/
Route::get('/login', [App\Http\Controllers\Client\AuthController::class, 'showLogin'])->name('client.login');
Route::post('/login', [App\Http\Controllers\Client\AuthController::class, 'login'])->name('client.login.post');
Route::get('/register', [App\Http\Controllers\Client\AuthController::class, 'showRegister'])->name('client.register');
Route::post('/register', [App\Http\Controllers\Client\AuthController::class, 'register'])->name('client.register.post');
Route::post('/client/logout', [App\Http\Controllers\Client\AuthController::class, 'logout'])->name('client.logout');
Route::get('/client/dashboard', [App\Http\Controllers\Client\DashboardController::class, 'index'])->name('client.dashboard')->middleware('auth');

// Routes pour les messages de contact (Admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{id}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');
});

// Routes pour les demandes de devis (Admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/devis', [App\Http\Controllers\Admin\DevisController::class, 'index'])->name('devis.index');
    Route::get('/devis/{id}', [App\Http\Controllers\Admin\DevisController::class, 'show'])->name('devis.show');
    Route::delete('/devis/{id}', [App\Http\Controllers\Admin\DevisController::class, 'destroy'])->name('devis.destroy');
});
