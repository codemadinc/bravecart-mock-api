<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ShopifyFormatter;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * GET /api/stores/{storeId}/collections
     * All collections list.
     */
    public function index(int $storeId): JsonResponse
    {
        $collections = Collection::where('store_id', $storeId)->get();

        $nodes = $collections->map(fn($c) => ShopifyFormatter::collection($c, false))->values()->all();

        return response()->json([
            'collections' => ShopifyFormatter::connection($nodes),
        ]);
    }

    /**
     * GET /api/stores/{storeId}/collections/{handle}
     * Collection with products (supports sort, pagination).
     */
    public function show(Request $request, int $storeId, string $handle): JsonResponse
    {
        $collection = Collection::where('store_id', $storeId)
            ->where('handle', $handle)
            ->firstOrFail();

        // Build product query through the pivot
        $productsQuery = $collection->products()
            ->where('status', 'ACTIVE')
            ->with('variants');

        // Sort
        $sortKey = $request->input('sortKey', 'COLLECTION_DEFAULT');
        $reverse = filter_var($request->input('reverse', false), FILTER_VALIDATE_BOOLEAN);

        $sortMap = [
            'COLLECTION_DEFAULT' => 'collection_products.sort_order',
            'TITLE' => 'products.title',
            'PRICE' => 'products.price_min',
            'CREATED' => 'products.created_at',
            'BEST_SELLING' => 'products.id',
        ];

        $sortColumn = $sortMap[$sortKey] ?? 'collection_products.sort_order';
        $productsQuery->orderBy($sortColumn, $reverse ? 'desc' : 'asc');

        // Pagination
        $first = min((int) $request->input('first', 12), 50);
        $cursor = $request->input('after');
        if ($cursor) {
            $productsQuery->where('products.id', '>', (int) base64_decode($cursor));
        }

        $products = $productsQuery->limit($first + 1)->get();
        $hasNextPage = $products->count() > $first;
        if ($hasNextPage) {
            $products = $products->take($first);
        }

        $nodes = $products->map(fn($p) => ShopifyFormatter::productCard($p))->values()->all();
        $lastProduct = $products->last();
        $firstProduct = $products->first();

        $collectionData = ShopifyFormatter::collection($collection, false);
        $collectionData['products'] = ShopifyFormatter::connection(
            $nodes,
            ShopifyFormatter::pageInfo(
                hasPreviousPage: (bool) $cursor,
                hasNextPage: $hasNextPage,
                startCursor: $firstProduct ? base64_encode((string) $firstProduct->id) : null,
                endCursor: $lastProduct ? base64_encode((string) $lastProduct->id) : null,
            )
        );

        return response()->json([
            'collection' => $collectionData,
        ]);
    }

    /**
     * GET /api/stores/{storeId}/collections/{handle}/product-count
     * Product count for a collection.
     */
    public function productCount(int $storeId, string $handle): JsonResponse
    {
        $collection = Collection::where('store_id', $storeId)
            ->where('handle', $handle)
            ->firstOrFail();

        $count = $collection->products()->where('status', 'ACTIVE')->count();

        return response()->json([
            'collection' => [
                'id' => $collection->gid(),
                'handle' => $collection->handle,
                'productsCount' => $count,
            ],
        ]);
    }
}
