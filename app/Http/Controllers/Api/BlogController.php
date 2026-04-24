<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ShopifyFormatter;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * GET /api/stores/{storeId}/blogs/{handle}
     * Blog with paginated articles.
     */
    public function show(Request $request, int $storeId, string $handle): JsonResponse
    {
        $blog = Blog::where('store_id', $storeId)
            ->where('handle', $handle)
            ->firstOrFail();

        $pageBy = min((int) $request->input('pageBy', 10), 50);
        $cursor = $request->input('cursor');

        $query = $blog->articles()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc');

        if ($cursor) {
            $query->where('id', '<', (int) base64_decode($cursor));
        }

        $articles = $query->limit($pageBy + 1)->get();
        $hasNextPage = $articles->count() > $pageBy;
        if ($hasNextPage) {
            $articles = $articles->take($pageBy);
        }

        $nodes = $articles->map(fn($a) => ShopifyFormatter::article($a))->values()->all();
        $lastArticle = $articles->last();

        return response()->json([
            'blog' => [
                'id' => $blog->gid(),
                'title' => $blog->title,
                'handle' => $blog->handle,
                'seo' => $blog->seo,
                'articles' => ShopifyFormatter::connection(
                    $nodes,
                    ShopifyFormatter::pageInfo(
                        hasPreviousPage: (bool) $cursor,
                        hasNextPage: $hasNextPage,
                        endCursor: $lastArticle ? base64_encode((string) $lastArticle->id) : null,
                    )
                ),
            ],
        ]);
    }

    /**
     * GET /api/stores/{storeId}/blogs/{blogHandle}/articles/{articleHandle}
     * Single article.
     */
    public function article(int $storeId, string $blogHandle, string $articleHandle): JsonResponse
    {
        $blog = Blog::where('store_id', $storeId)
            ->where('handle', $blogHandle)
            ->firstOrFail();

        $article = Article::where('blog_id', $blog->id)
            ->where('handle', $articleHandle)
            ->firstOrFail();

        return response()->json([
            'article' => ShopifyFormatter::article($article),
            'blog' => [
                'id' => $blog->gid(),
                'title' => $blog->title,
                'handle' => $blog->handle,
            ],
        ]);
    }
}
