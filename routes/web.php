<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - RosTop Digital Marketplace & Direct Exchange (rostop.com)
|--------------------------------------------------------------------------
|
| Direct counterparty transactions:
| 1. Game Top-Up (UID Direct Instant Reload)
| 2. Buy Gift Cards (Digital Code Instant Delivery)
| 3. Digital Subscriptions (Automated Credentials & Warranty)
| 4. Sell Gift Cards to Us (RosTop Instant Payout Model)
*/

// 1. Flagship All-in-One Homepage & Dedicated Support Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/support', [HomeController::class, 'support'])->name('support');

// 2. Game Top-Up Directory & Detail
Route::get('/game-topup', [ProductController::class, 'gameTopupIndex'])->name('game.topup');
Route::get('/game-topup/{slug}', [ProductController::class, 'show'])->name('game.show');
Route::redirect('/game/{slug}', '/game-topup/{slug}');
Route::redirect('/game', '/game-topup');

// 3. Buy Gift Cards
Route::get('/gift-cards/buy', [ProductController::class, 'giftCardsBuyIndex'])->name('giftcards.buy');
Route::get('/gift-cards/buy/{slug}', [ProductController::class, 'show'])->name('giftcards.buy.show');

// 4. Sell Gift Cards to Us (RosTop Instant Payout Model)
Route::get('/gift-cards/sell', [ExchangeController::class, 'sellIndex'])->name('giftcards.sell');
Route::post('/gift-cards/sell', [ExchangeController::class, 'submitSell'])->name('giftcards.sell.submit');
Route::post('/api/rates/calculate', [ExchangeController::class, 'calculate'])->name('api.rates.calculate');

// 5. Digital Subscriptions & OTT Hub
Route::get('/subscriptions', [ProductController::class, 'subscriptionsIndex'])->name('subscriptions');
Route::get('/subscriptions/{slug}', [ProductController::class, 'show'])->name('subscriptions.show');

// 6. Software & Digital Products Marketplace
Route::get('/digital-products', [ProductController::class, 'digitalProductsIndex'])->name('digital.products');
Route::get('/digital-products/{slug}', [ProductController::class, 'show'])->name('digital.products.show');

// 7. General Product Show Route (Fallback for Any Product Slug)
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// 8. Checkout & Order Placement
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout/place-order', [OrderController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/order/success/{order_code}', [OrderController::class, 'success'])->name('order.success');

// 9. Live Order Tracking (SEO friendly /track-order)
Route::get('/track-order', [OrderController::class, 'trackOrder'])->name('track.order');
Route::post('/track-order', [OrderController::class, 'trackOrder'])->name('track.order.search');

// 10. Unified Login / Sign-Up (Phone or E-mail + OTP)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login/password', [AuthController::class, 'loginWithPassword'])->name('login.password');
    Route::post('/login/otp', [AuthController::class, 'sendOtp'])->name('login.otp');
    Route::post('/login/verify', [AuthController::class, 'verifyOtp'])->name('login.verify');
    Route::get('/login/reset', [AuthController::class, 'reset'])->name('login.reset');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 11. Admin Operations & Management Portal (Admin only)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard & Quick Actions
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/order/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('order.status');
    Route::post('/rate/{id}/update', [AdminController::class, 'updateRate'])->name('rate.update');

    // Orders Management
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.update');
    Route::post('/orders/{id}/delete', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');

    // Products & Packages Management
    Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::post('/products/{id}/toggle', [\App\Http\Controllers\Admin\ProductController::class, 'toggle'])->name('products.toggle');
    Route::post('/products/{id}/delete', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');

    // Categories Management
    Route::get('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::post('/categories/{id}/delete', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

    // Exchange Rates Management
    Route::get('/rates', [\App\Http\Controllers\Admin\RateController::class, 'index'])->name('rates.index');
    Route::post('/rates', [\App\Http\Controllers\Admin\RateController::class, 'store'])->name('rates.store');
    Route::post('/rates/{id}/delete', [\App\Http\Controllers\Admin\RateController::class, 'destroy'])->name('rates.destroy');
    Route::post('/rates/{id}/toggle', [\App\Http\Controllers\Admin\RateController::class, 'toggle'])->name('rates.toggle');

    // Reviews Management
    Route::get('/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{id}', [\App\Http\Controllers\Admin\ReviewController::class, 'update'])->name('reviews.update');
    Route::post('/reviews/{id}/toggle', [\App\Http\Controllers\Admin\ReviewController::class, 'toggle'])->name('reviews.toggle');
    Route::post('/reviews/{id}/delete', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Users Management
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/toggle-admin', [\App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
    Route::post('/users/{id}/delete', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
});

// 10B. Localized public pages (SEO-safe hreflang targets: /en/..., /bn/..., /hi/...)
Route::prefix('{locale}')
    ->where(['locale' => 'en|bn|hi'])
    ->middleware('setlocale')
    ->name('l.')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/support', [HomeController::class, 'support'])->name('support');
        Route::get('/game-topup', [ProductController::class, 'gameTopupIndex'])->name('game.topup');
        Route::get('/game-topup/{slug}', [ProductController::class, 'show'])->name('game.show');
        Route::get('/gift-cards/buy', [ProductController::class, 'giftCardsBuyIndex'])->name('giftcards.buy');
        Route::get('/gift-cards/buy/{slug}', [ProductController::class, 'show'])->name('giftcards.buy.show');
        Route::get('/gift-cards/sell', [ExchangeController::class, 'sellIndex'])->name('giftcards.sell');
        Route::get('/subscriptions', [ProductController::class, 'subscriptionsIndex'])->name('subscriptions');
        Route::get('/subscriptions/{slug}', [ProductController::class, 'show'])->name('subscriptions.show');
        Route::get('/digital-products', [ProductController::class, 'digitalProductsIndex'])->name('digital.products');
        Route::get('/digital-products/{slug}', [ProductController::class, 'show'])->name('digital.products.show');
        Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/track-order', [OrderController::class, 'trackOrder'])->name('track.order');
    });

// 11. XML Sitemap with hreflang alternates for SEO Indexing
Route::get('/sitemap.xml', function () {
    $products = \App\Models\Product::where('is_active', true)->get();
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

    $alternates = function (string $path): string {
        $en  = url($path);
        $bn  = url('bn' . ($path === '' ? '' : '/' . $path));
        $hi  = url('hi' . ($path === '' ? '' : '/' . $path));
        return '<xhtml:link rel="alternate" hreflang="en" href="' . htmlspecialchars($en) . '"/>'
             . '<xhtml:link rel="alternate" hreflang="bn-BD" href="' . htmlspecialchars($bn) . '"/>'
             . '<xhtml:link rel="alternate" hreflang="hi-IN" href="' . htmlspecialchars($hi) . '"/>'
             . '<xhtml:link rel="alternate" hreflang="x-default" href="' . htmlspecialchars($en) . '"/>';
    };

    $staticUrls = [
        ['path' => '', 'priority' => '1.0', 'changefreq' => 'daily'],
        ['path' => 'game-topup', 'priority' => '0.9', 'changefreq' => 'daily'],
        ['path' => 'gift-cards/buy', 'priority' => '0.9', 'changefreq' => 'daily'],
        ['path' => 'gift-cards/sell', 'priority' => '0.9', 'changefreq' => 'daily'],
        ['path' => 'subscriptions', 'priority' => '0.8', 'changefreq' => 'weekly'],
        ['path' => 'digital-products', 'priority' => '0.8', 'changefreq' => 'weekly'],
        ['path' => 'track-order', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ];

    foreach ($staticUrls as $u) {
        $xml .= '<url><loc>' . htmlspecialchars(url($u['path'])) . '</loc>'
             . $alternates($u['path'])
             . '<priority>' . $u['priority'] . '</priority><changefreq>' . $u['changefreq'] . '</changefreq></url>';
    }

    foreach ($products as $p) {
        $path = 'product/' . $p->slug;
        $xml .= '<url><loc>' . htmlspecialchars(url($path)) . '</loc>'
             . $alternates($path)
             . '<priority>0.8</priority><changefreq>weekly</changefreq></url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap.xml');

