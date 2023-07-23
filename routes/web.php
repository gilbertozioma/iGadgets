<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth Routes
Auth::routes();

// Frontend Routes
Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    // Home Page
    Route::get('/', 'index');

    // Categories Page
    Route::get('/collections', 'categories');

    // Products Page for a specific category
    Route::get('/collections/{category_slug}', 'products');

    // Individual Product View Page
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');

    // New Arrivals Page
    Route::get('/new-arrivals', 'newArrival');

    // Featured Products Page
    Route::get('/featured-products', 'featuredProducts');

    // Product Search Page
    Route::get('search', 'searchProducts');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Wishlist Page
    Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);

    // Cart Page
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);

    // Checkout Page
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);

    // Order History Page
    Route::get('orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);

    // Individual Order Details Page
    Route::get('orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);

    // User Profile Page (View and Update)
    Route::get('profile', [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::post('profile', [App\Http\Controllers\Frontend\UserController::class, 'updateUserDetails']);

    // Change Password Page
    Route::get('change-password', [App\Http\Controllers\Frontend\UserController::class, 'passwordCreate']);
    Route::post('change-password', [App\Http\Controllers\Frontend\UserController::class, 'changePassword']);
});

// Thank You Page
Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);

// Home Page for authenticated users
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes (prefixed with '/admin' and requiring 'auth' and 'isAdmin' middleware)
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    // Admin Dashboard Page
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Settings Page (View and Update)
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index']);
    Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'store']);

    // Slider Routes
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('sliders', 'index');
        Route::get('sliders/create', 'create');
        Route::post('sliders/create', 'store');
        Route::get('sliders/{slider}/edit', 'edit');
        Route::put('sliders/{slider}', 'update');
        Route::get('sliders/{slider}/delete', 'destroy');
    });

    // Category Routes
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
    });

    // Product Routes
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('products/{product_id}/delete','destroy');
        Route::get('product-image/{product_image_id}/delete','destroyImage');

        // Product Color and Quantity Update
        Route::post('product-color/{prod_color_id}', 'updateProdColorQty');

        // Delete Product Color
        Route::get('product-color/{prod_color_id}/delete', 'deleteProdColor');
    });

    // Brand Index Page
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);

    // Color Routes
    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors/create', 'store');
        Route::get('/colors/{color}/edit','edit');
        Route::put('/colors/{color_id}','update');
        Route::get('/colors/{color_id}/delete','destroy');
    });

    // Order Routes
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderStatus');

        // Invoice Routes
        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
        Route::get('/invoice/{orderId}/mail', 'mailInvoice');
    });

    // User Routes
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{user_id}/edit', 'edit');
        Route::put('users/{user_id}', 'update');
        Route::get('users/{user_id}/delete', 'destroy');
    });
});
