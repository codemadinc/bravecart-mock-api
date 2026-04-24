<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    /**
     * GET /api/stores/{storeId}/pages/{handle}
     * Single page.
     */
    public function show(int $storeId, string $handle): JsonResponse
    {
        $page = Page::where('store_id', $storeId)
            ->where('handle', $handle)
            ->firstOrFail();

        return response()->json([
            'page' => [
                'id' => $page->gid(),
                'title' => $page->title,
                'handle' => $page->handle,
                'body' => $page->body_html,
                'bodySummary' => strip_tags(substr($page->body_html ?? '', 0, 200)),
                'seo' => $page->seo ?? ['title' => $page->title, 'description' => ''],
                'createdAt' => $page->created_at?->toIso8601String(),
                'updatedAt' => $page->updated_at?->toIso8601String(),
            ],
        ]);
    }
}
