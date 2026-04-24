<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ShopifyFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * GET /api/stores/{storeId}/products
     * Product listing with search, sort, pagination.
     */
    public function index(Request $request, int $storeId): JsonResponse
    {
        $query = Product::where('store_id', $storeId)
            ->where('status', 'ACTIVE')
            ->with('variants');

        // Search by query string
        if ($q = $request->input('query')) {
            $query->where(function ($qb) use ($q) {
                $qb->where('title', 'LIKE', "%{$q}%")
                    ->orWhere('description', 'LIKE', "%{$q}%")
                    ->orWhere('product_type', 'LIKE', "%{$q}%")
                    ->orWhere('vendor', 'LIKE', "%{$q}%");
            });
        }

        // Filter by product type
        if ($type = $request->input('productType')) {
            $query->where('product_type', $type);
        }

        // Sort
        $sortKey = $request->input('sortKey', 'CREATED_AT');
        $reverse = filter_var($request->input('reverse', false), FILTER_VALIDATE_BOOLEAN);

        $sortMap = [
            'TITLE' => 'title',
            'PRICE' => 'price_min',
            'CREATED_AT' => 'created_at',
            'UPDATED_AT' => 'updated_at',
            'BEST_SELLING' => 'id', // mock: just use id
            'RELEVANCE' => 'id',
        ];

        $sortColumn = $sortMap[$sortKey] ?? 'created_at';
        $query->orderBy($sortColumn, $reverse ? 'desc' : 'asc');

        // Pagination
        $count = min((int) $request->input('count', 12), 50);
        $cursor = $request->input('after');
        if ($cursor) {
            $query->where('id', '>', (int) base64_decode($cursor));
        }

        $products = $query->limit($count + 1)->get();
        $hasNextPage = $products->count() > $count;
        if ($hasNextPage) {
            $products = $products->take($count);
        }

        $nodes = $products->map(fn($p) => ShopifyFormatter::productCard($p))->values()->all();

        $lastProduct = $products->last();
        $firstProduct = $products->first();

        return response()->json([
            'products' => ShopifyFormatter::connection(
                $nodes,
                ShopifyFormatter::pageInfo(
                    hasPreviousPage: (bool) $cursor,
                    hasNextPage: $hasNextPage,
                    startCursor: $firstProduct ? base64_encode((string) $firstProduct->id) : null,
                    endCursor: $lastProduct ? base64_encode((string) $lastProduct->id) : null,
                )
            ),
        ]);
    }

    /**
     * GET /api/stores/{storeId}/products/{handle}
     * Full product detail.
     */
    public function show(int $storeId, string $handle): JsonResponse
    {
        $product = Product::where('store_id', $storeId)
            ->where('handle', $handle)
            ->with('variants')
            ->firstOrFail();

        return response()->json([
            'product' => ShopifyFormatter::product($product),
        ]);
    }

    /**
     * GET /api/stores/{storeId}/products/{handle}/variants
     * All variants for a product.
     */
    public function variants(int $storeId, string $handle): JsonResponse
    {
        $product = Product::where('store_id', $storeId)
            ->where('handle', $handle)
            ->with('variants')
            ->firstOrFail();

        $variants = $product->variants->map(fn($v) => ShopifyFormatter::variant($v))->values()->all();

        return response()->json([
            'product' => [
                'variants' => ShopifyFormatter::connection($variants),
            ],
        ]);
    }

    /**
     * POST /api/stores/{storeId}/products/recommended
     * Recommended products for a given product.
     */
    public function recommended(Request $request, int $storeId): JsonResponse
    {
        $productId = $request->input('productId');
        $count = min((int) $request->input('count', 4), 12);

        // Find the product to get its type
        $numericId = ShopifyFormatter::parseGid($productId ?? '0');
        $product = Product::find($numericId);

        // Get products of the same type, excluding the current one
        $query = Product::where('store_id', $storeId)
            ->where('status', 'ACTIVE')
            ->where('id', '!=', $numericId)
            ->with('variants');

        if ($product && $product->product_type) {
            $query->orderByRaw("CASE WHEN product_type = ? THEN 0 ELSE 1 END", [$product->product_type]);
        }

        $recommended = $query->limit($count)->get();
        $nodes = $recommended->map(fn($p) => ShopifyFormatter::productCard($p))->values()->all();

        return response()->json([
            'recommendedProducts' => ShopifyFormatter::connection($nodes),
        ]);
    }
}
