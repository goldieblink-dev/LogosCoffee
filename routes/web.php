<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SelfOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CafeProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class , 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class , 'login']);
Route::post('/logout', [LoginController::class , 'logout'])->name('logout');

// Self Order Routes (Customer)
Route::name('self-order.')->prefix('order')->group(function () {
    Route::get('/', [SelfOrderController::class , 'index'])->name('index');
    Route::post('/info', [SelfOrderController::class , 'storeCustomerInfo'])->name('info.store');
    Route::get('/menu', [SelfOrderController::class , 'menu'])->name('menu');
    Route::post('/checkout', [SelfOrderController::class , 'checkout'])->name('checkout');
    Route::get('/payment/{order}', [SelfOrderController::class , 'payment'])->name('payment');
    Route::post('/payment/{order}/process', [SelfOrderController::class , 'processPayment'])->name('payment.process');
    Route::get('/success/{order}', [SelfOrderController::class , 'success'])->name('success');
});

// Admin Routes (Restricted to Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
            return view('admin.dashboard');
        }
        );

        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
        Route::get('/profile', [CafeProfileController::class , 'show'])->name('profile.show');
        Route::put('/profile', [CafeProfileController::class , 'update'])->name('profile.update');

        // Product CRUD (Full access for Admin)
        Route::resource('products', ProductController::class);
        Route::patch('/products/{product}/toggle', [ProductController::class , 'toggleAvailability'])->name('products.toggle');
        Route::resource('orders', OrderController::class);
        Route::get('/reports/sales', [ReportController::class , 'sales'])->name('reports.sales');
    });

// Cashier Routes (Restricted to Cashier)
Route::middleware(['auth', 'role:cashier'])->prefix('cashier')->name('cashier.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Cashier\DashboardController::class , 'index'])->name('dashboard');

    // Managed by Cashier
    Route::get('/products', [\App\Http\Controllers\Cashier\ProductController::class , 'index'])->name('products.index');
    Route::patch('/products/{product}/toggle', [\App\Http\Controllers\Cashier\ProductController::class , 'toggleAvailability'])->name('products.toggle');

    Route::get('/orders', [\App\Http\Controllers\Cashier\OrderController::class , 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\Cashier\OrderController::class , 'show'])->name('orders.show');
    Route::put('/orders/{order}', [\App\Http\Controllers\Cashier\OrderController::class , 'update'])->name('orders.update');

    Route::get('/reports/sales', [\App\Http\Controllers\Admin\ReportController::class , 'sales'])->name('reports.sales');
});

// Owner Routes (Restricted to Owner)
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Owner\DashboardController::class , 'index'])->name('dashboard');
    Route::resource('products', \App\Http\Controllers\Owner\ProductController::class);
    Route::patch('/products/{product}/toggle', [\App\Http\Controllers\Owner\ProductController::class , 'toggleAvailability'])->name('products.toggle');
    Route::get('/reports/sales', [\App\Http\Controllers\Owner\ReportController::class , 'sales'])->name('reports.sales');
});