<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', function () { return redirect()->route('home'); })->name('dashboard');

// Carrito
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::get('add/{product}', [CartController::class, 'add'])->name('add');
    Route::post('update/{id}', [CartController::class, 'update'])->name('update');
    Route::post('remove/{id}', [CartController::class, 'remove'])->name('remove');
});

// Checkout & User Orders
Route::middleware('auth')->group(function () {
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('process', [CheckoutController::class, 'process'])->name('process');
    });
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Wishlist
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    
    // Tickets (Claims)
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    
    // Reviews
    Route::post('reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store');
});

// ADMIN PANEL
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'productCreate'])->name('products.create');
    Route::post('/products', [AdminController::class, 'productStore'])->name('products.store');
    Route::patch('/products/{product}/stock', [AdminController::class, 'updateStock'])->name('products.stock');
    Route::patch('/products/{product}/discount', [AdminController::class, 'updateDiscount'])->name('products.discount');
    Route::patch('/products/{product}/toggle-pause', [AdminController::class, 'togglePause'])->name('products.toggle-pause');
    Route::delete('/products/{product}', [AdminController::class, 'productDelete'])->name('products.delete');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');

    // Admin Tickets
    Route::get('tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
    Route::patch('tickets/{ticket}', [AdminTicketController::class, 'update'])->name('tickets.update');

    // Admin Categories
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'categoryStore'])->name('categories.store');
    Route::patch('/categories/{category}', [AdminController::class, 'categoryUpdate'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'categoryDelete'])->name('categories.delete');
});

// Pages
Route::get('terms', [PageController::class, 'terms'])->name('pages.terms');

// Lang switch
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) Session::put('locale', $locale);
    return redirect()->back();
})->name('lang.switch');

require __DIR__.'/auth.php';
