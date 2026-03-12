<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SelfOrderController;

Route::get('/', function () {
    $categories = \App\Models\Category::has('products')
        ->with(['products' => function($query) {
        }])->get();

    return view('welcome', compact('categories'));
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Self Order Routes (Customer)
Route::name('self-order.')->prefix('order')->group(function () {
    Route::get('/', [SelfOrderController::class, 'index'])->name('index');
    Route::post('/info', [SelfOrderController::class, 'storeCustomerInfo'])->name('info.store');
    Route::get('/menu', [SelfOrderController::class, 'menu'])->name('menu');
    Route::post('/checkout', [SelfOrderController::class, 'checkout'])->name('checkout');
    Route::get('/payment/{order}', [SelfOrderController::class, 'payment'])->name('payment');
    Route::post('/payment/{order}/process', [SelfOrderController::class, 'processPayment'])->name('payment.process');
    Route::get('/success/{order}', [SelfOrderController::class, 'success'])->name('success');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Cafe Profile
    Route::get('/profile', [\App\Http\Controllers\Admin\CafeProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [\App\Http\Controllers\Admin\CafeProfileController::class, 'update'])->name('profile.update');
    
    // Categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['create', 'edit', 'show']);
    
    // Products
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['create', 'edit', 'show']);
    Route::patch('products/{product}/toggle', [\App\Http\Controllers\Admin\ProductController::class, 'toggleAvailability'])->name('products.toggle');
    
    // Users
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'edit', 'show']);
    
    // Orders
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status');
    Route::delete('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');
});

// Cashier Routes
Route::middleware(['auth', 'role:cashier'])->prefix('cashier')->name('cashier.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Cashier\DashboardController::class, 'index'])->name('dashboard');
    // Orders
    Route::get('/orders', [\App\Http\Controllers\Cashier\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\Cashier\OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\Cashier\OrderController::class, 'updateStatus'])->name('orders.status');
    // Products availability
    Route::get('/products', [\App\Http\Controllers\Cashier\ProductController::class, 'index'])->name('products.index');
    Route::patch('/products/{product}/toggle', [\App\Http\Controllers\Cashier\ProductController::class, 'toggle'])->name('products.toggle');
    // Sales Recap
    Route::get('/rekap', [\App\Http\Controllers\Cashier\SalesController::class, 'index'])->name('rekap.index');
});

// Owner Routes
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('dashboard');
    // Products & Pricing
    Route::get('/products', [\App\Http\Controllers\Owner\ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [\App\Http\Controllers\Owner\ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [\App\Http\Controllers\Owner\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [\App\Http\Controllers\Owner\ProductController::class, 'destroy'])->name('products.destroy');
    // Promos
    Route::get('/promos', [\App\Http\Controllers\Owner\PromoController::class, 'index'])->name('promos.index');
    Route::patch('/promos/{product}', [\App\Http\Controllers\Owner\PromoController::class, 'update'])->name('promos.update');
    // Reports
    Route::get('/reports', [\App\Http\Controllers\Owner\ReportController::class, 'index'])->name('reports.index');
});