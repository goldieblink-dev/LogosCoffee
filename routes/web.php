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
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
});

// Cashier Routes
Route::middleware(['auth', 'role:cashier'])->prefix('cashier')->name('cashier.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Cashier\DashboardController::class, 'index'])->name('dashboard');
});

// Owner Routes
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('dashboard');
});