<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LayoutController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PolicyController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\StoreConfigController;
use App\Http\Controllers\Api\ThemeController;
use App\Http\Controllers\Api\SeoController;
use App\Http\Controllers\Api\SwatchController;

/*
|--------------------------------------------------------------------------
| BraveCart Mock API Routes
|--------------------------------------------------------------------------
|
| All routes follow the pattern: /api/stores/{storeId}/...
| Response shapes are Shopify-compatible (MoneyV2, nodes, pageInfo, GIDs).
|
| Internal routes use: /api/internal/...
|
*/

// ─── Health Check ────────────────────────────────────────────────────
Route::get('/health', fn() => response()->json([
    'status' => 'ok',
    'service' => 'bravecart-mock-api',
    'version' => '1.0.0',
    'timestamp' => now()->toIso8601String(),
]));

// ─── Internal Routes ─────────────────────────────────────────────────
Route::post('/internal/store-config', [StoreConfigController::class, 'detect']);

// ─── Store-Scoped Routes ─────────────────────────────────────────────
Route::prefix('stores/{storeId}')->group(function () {

    // 1. Layout (shop info + menus)
    Route::get('/layout', [LayoutController::class, 'index']);

    // 2. Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{handle}', [ProductController::class, 'show']);
    Route::get('/products/{handle}/variants', [ProductController::class, 'variants']);
    Route::post('/products/recommended', [ProductController::class, 'recommended']);

    // 3. Collections
    Route::get('/collections', [CollectionController::class, 'index']);
    Route::get('/collections/{handle}', [CollectionController::class, 'show']);
    Route::get('/collections/{handle}/product-count', [CollectionController::class, 'productCount']);

    // 4. Cart (functional, token-based)
    Route::post('/cart/create', [CartController::class, 'create']);
    Route::get('/cart/{token}', [CartController::class, 'show']);
    Route::post('/cart/{token}/add', [CartController::class, 'addLines']);
    Route::post('/cart/{token}/update', [CartController::class, 'updateLines']);
    Route::post('/cart/{token}/remove', [CartController::class, 'removeLines']);
    Route::post('/cart/{token}/discount', [CartController::class, 'applyDiscount']);

    // 5. Search
    Route::get('/search', [SearchController::class, 'search']);
    Route::get('/search/predictive', [SearchController::class, 'predictive']);

    // 6. Blog/Articles
    Route::get('/blogs/{handle}', [BlogController::class, 'show']);
    Route::get('/blogs/{blogHandle}/articles/{articleHandle}', [BlogController::class, 'article']);

    // 7. Pages
    Route::get('/pages/{handle}', [PageController::class, 'show']);

    // 8. Policies
    Route::get('/policies', [PolicyController::class, 'index']);
    Route::get('/policies/{handle}', [PolicyController::class, 'show']);

    // 9. Customer (mock)
    Route::get('/customer', [CustomerController::class, 'show']);
    Route::get('/customer/orders', [CustomerController::class, 'orders']);
    Route::get('/customer/orders/{orderId}', [CustomerController::class, 'order']);

    // 11. CMS (functional — real DB read/write)
    Route::get('/theme/page', [ThemeController::class, 'getPage']);
    Route::post('/theme/page', [ThemeController::class, 'savePage']);
    Route::get('/theme/settings', [ThemeController::class, 'getSettings']);
    Route::post('/theme/settings', [ThemeController::class, 'saveSettings']);

    // 12. SEO
    Route::get('/robots.txt', [SeoController::class, 'robots']);

    // 13. Swatches
    Route::get('/swatches', [SwatchController::class, 'index']);
});
