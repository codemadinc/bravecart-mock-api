<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ShopifyFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Collection;
use App\Models\Page;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * GET /api/stores/{storeId}/search
     * Full search across products, collections, pages, articles.
     */
    public function search(Request $request, int $storeId): JsonResponse
    {
        $q = $request->input('q', '');
        $type = $request->input('type', 'PRODUCT'); // PRODUCT, COLLECTION, PAGE, ARTICLE
        $first = min((int) $request->input('first', 12), 50);

        if (empty($q)) {
            return response()->json([
                'search' => [
                    'totalCount' => 0,
                    'nodes' => [],
                    'pageInfo' => ShopifyFormatter::pageInfo(),
                ],
            ]);
        }

        $results = [];
        $totalCount = 0;

        if ($type === 'PRODUCT' || $type === 'ALL') {
            $products = Product::where('store_id', $storeId)
                ->where('status', 'ACTIVE')
                ->where(function ($qb) use ($q) {
                    $qb->where('title', 'LIKE', "%{$q}%")
                        ->orWhere('description', 'LIKE', "%{$q}%")
                        ->orWhere('vendor', 'LIKE', "%{$q}%")
                        ->orWhere('product_type', 'LIKE', "%{$q}%");
                })
                ->with('variants')
                ->limit($first)
                ->get();

            $results = $products->map(fn($p) => ShopifyFormatter::productCard($p))->values()->all();
            $totalCount = count($results);
        }

        return response()->json([
            'search' => [
                'totalCount' => $totalCount,
                'nodes' => $results,
                'pageInfo' => ShopifyFormatter::pageInfo(),
            ],
        ]);
    }

    /**
     * GET /api/stores/{storeId}/search/predictive
     * Predictive search — returns products, collections, pages, articles, queries.
     */
    public function predictive(Request $request, int $storeId): JsonResponse
    {
        $q = $request->input('q', '');
        $limit = min((int) $request->input('limit', 4), 10);

        if (empty($q)) {
            return response()->json([
                'predictiveSearch' => [
                    'products' => [],
                    'collections' => [],
                    'pages' => [],
                    'articles' => [],
                    'queries' => [],
                ],
            ]);
        }

        // Products
        $products = Product::where('store_id', $storeId)
            ->where('status', 'ACTIVE')
            ->where('title', 'LIKE', "%{$q}%")
            ->with('variants')
            ->limit($limit)
            ->get()
            ->map(fn($p) => ShopifyFormatter::productCard($p))
            ->values()
            ->all();

        // Collections
        $collections = Collection::where('store_id', $storeId)
            ->where('title', 'LIKE', "%{$q}%")
            ->limit($limit)
            ->get()
            ->map(fn($c) => ShopifyFormatter::collection($c, false))
            ->values()
            ->all();

        // Pages
        $pages = Page::where('store_id', $storeId)
            ->where('title', 'LIKE', "%{$q}%")
            ->limit($limit)
            ->get()
            ->map(fn($p) => [
                'id' => $p->gid(),
                'title' => $p->title,
                'handle' => $p->handle,
            ])
            ->values()
            ->all();

        // Articles
        $articles = Article::whereHas('blog', function ($qb) use ($storeId) {
                $qb->where('store_id', $storeId);
            })
            ->where('title', 'LIKE', "%{$q}%")
            ->limit($limit)
            ->get()
            ->map(fn($a) => ShopifyFormatter::article($a))
            ->values()
            ->all();

        // Mock query suggestions
        $queries = [];
        if (strlen($q) >= 2) {
            $queries = [
                ['text' => $q, 'styledText' => "<b>{$q}</b>"],
            ];
        }

        return response()->json([
            'predictiveSearch' => [
                'products' => $products,
                'collections' => $collections,
                'pages' => $pages,
                'articles' => $articles,
                'queries' => $queries,
            ],
        ]);
    }
}
