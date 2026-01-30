<?php

use App\Livewire\Cart;
use App\Livewire\ProductList;
use App\Livewire\Admin\ProductManager;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\User\OrderHistory;
use App\Livewire\User\Wishlist;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/fix-name', function () {
    $p = \App\Models\Product::where('name', 'iPhone 17 Ultra')->first();
    if($p) {
        $p->name = 'iPhone 17 Pro Max';
        $p->slug = \Illuminate\Support\Str::slug('iPhone 17 Pro Max');
        $p->save();
        return "Renamed to iPhone 17 Pro Max";
    }
    return "Product not found";
});

Route::get('/promote-me', function () {
    if (auth()->check()) {
        $user = auth()->user();
        $user->role = 'admin';
        $user->save();
        return 'User ' . $user->email . ' is now Admin! Go to /dashboard';
    }
    return 'Please login first';
});

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::get('/wishlist', Wishlist::class)->name('wishlist'); // Added this line
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/orders', OrderHistory::class)->name('orders.history');
    Route::get('/orders/success/{order_id}', \App\Livewire\User\OrderSuccess::class)->name('order.success');
    Route::get('/products/{slug}', \App\Livewire\ProductDetail::class)->name('products.show');

    Route::get('/orders/invoice/{order_id}', [\App\Http\Controllers\InvoiceController::class, 'show'])->name('invoice.show');

    // Stripe Routes
    Route::get('/stripe/session', [\App\Http\Controllers\StripeController::class, 'session'])->name('stripe.session');
    Route::get('/stripe/success', [\App\Http\Controllers\StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel', [\App\Http\Controllers\StripeController::class, 'cancel'])->name('stripe.cancel');

    // Admin Routes
    Route::middleware(['can:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/products', ProductManager::class)->name('products');
        Route::get('/coupons', \App\Livewire\Admin\CouponManager::class)->name('coupons');
    });
});

require __DIR__.'/debug.php';
