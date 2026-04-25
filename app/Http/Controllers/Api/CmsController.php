<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ThemePage;
use App\Models\ThemeSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * CmsController — serves the /cms/* routes that the BraveCart SDK v2 expects.
 *
 * These routes mirror the existing ThemeController logic but return the
 * response shapes defined in the SDK's TypeScript types:
 *   - FetchProjectPayload  → { page, project, pageAssignment }
 *   - ThemeSettingsResponse → { theme: HydrogenThemeSettings }
 *   - Translations          → Record<string, unknown>
 *   - CustomPages           → { data: CustomPageEntry[], nextCursor: string | null }
 *
 * The original /theme/page and /theme/settings routes remain untouched
 * so the BraveCart Studio can continue to use them.
 */
class CmsController extends Controller
{
    /**
     * POST /api/stores/{storeId}/cms/pages
     *
     * SDK sends: { projectId, url, i18n, params: { type?, handle?, locale? } }
     * Returns:   { page: HydrogenPageData, project: HydrogenProjectType, pageAssignment: HydrogenPageAssignment }
     */
    public function loadPage(Request $request, int $storeId): JsonResponse
    {
        $projectId = $request->input('projectId', 'mock-project-1');
        $params = $request->input('params', []);
        $type = strtoupper($params['type'] ?? 'INDEX');
        $handle = $params['handle'] ?? null;
        $locale = $params['locale'] ?? 'en-us';

        // Look up page layout — same logic as ThemeController::getPage
        $page = ThemePage::where('store_id', $storeId)
            ->where('type', $type)
            ->where('handle', $handle)
            ->first();

        if (!$page && $handle) {
            // Fall back to type-level default (handle = null)
            $page = ThemePage::where('store_id', $storeId)
                ->where('type', $type)
                ->whereNull('handle')
                ->first();
        }

        // Build HydrogenPageData
        // The SDK expects:
        //   - rootId references an item in the items array
        //   - That root item has type: 'main'
        //   - Child items have parentId pointing to the root item's id
        if ($page) {
            $rootId = 'root-' . $page->id;
            $rawItems = $page->items ?? [];

            // Wrap existing items inside a 'main' root container.
            // Set each child's parentId to the root so the SDK tree resolves.
            $children = array_map(function ($item) use ($rootId) {
                $item['parentId'] = $rootId;
                return $item;
            }, $rawItems);

            // Prepend the root 'main' item
            $rootItem = [
                'id' => $rootId,
                'type' => 'main',
                'parentId' => null,
                'data' => [],
            ];
            $allItems = array_merge([$rootItem], $children);

            $pageData = [
                'id' => (string) $page->id,
                'name' => $type . ($handle ? " — {$handle}" : ''),
                'rootId' => $rootId,
                'items' => $allItems,
                'updatedAt' => $page->updated_at?->toIso8601String(),
            ];
        } else {
            // Return a minimal fallback page so the SDK doesn't error out
            $fallbackId = 'fallback-' . strtolower($type);
            $pageData = [
                'id' => $fallbackId,
                'name' => $type . ' (fallback)',
                'rootId' => $fallbackId,
                'items' => [
                    [
                        'id' => $fallbackId,
                        'type' => 'main',
                        'parentId' => null,
                        'data' => [],
                    ],
                ],
            ];
        }

        // Build HydrogenProjectType
        $project = [
            'id' => $projectId,
            'weaverseShopId' => (string) $storeId,
            'name' => 'Mock Project',
        ];

        // Build HydrogenPageAssignment
        $pageAssignment = [
            'projectId' => $projectId,
            'type' => $type,
            'handle' => $handle ?? '',
            'locale' => $locale,
        ];

        return response()->json([
            'page' => $pageData,
            'project' => $project,
            'pageAssignment' => $pageAssignment,
        ]);
    }

    /**
     * GET /api/stores/{storeId}/cms/theme-settings
     *
     * Returns: { theme: HydrogenThemeSettings }
     * The SDK checks `isThemeSettingsResponse(data)` which requires
     * `data.theme` to be a non-null object.
     */
    public function themeSettings(int $storeId): JsonResponse
    {
        $settings = ThemeSettings::where('store_id', $storeId)->first();

        // Wrap in { theme: ... } to match SDK's isThemeSettingsResponse guard
        return response()->json([
            'theme' => $settings ? $settings->settings : (object) [],
        ]);
    }

    /**
     * GET /api/stores/{storeId}/cms/translations?locale={locale}
     *
     * Returns: Record<string, unknown> — merchant translation overrides.
     * For the mock API we return an empty object (no overrides).
     */
    public function translations(Request $request, int $storeId): JsonResponse
    {
        // In a real implementation this would look up locale-specific
        // merchant overrides from the database. For mock, return empty.
        return response()->json((object) []);
    }

    /**
     * GET /api/stores/{storeId}/cms/custom-pages?locale=&limit=&cursor=
     *
     * Returns: { data: CustomPageEntry[], nextCursor: string | null }
     * Used by the SDK's fetchCustomPages() for sitemap generation.
     */
    public function customPages(Request $request, int $storeId): JsonResponse
    {
        $locale = $request->query('locale');
        $limit = (int) $request->query('limit', 50);
        $cursor = $request->query('cursor');

        // Collect all theme pages for this store as custom page entries
        $query = ThemePage::where('store_id', $storeId);
        if ($cursor) {
            $query->where('id', '>', $cursor);
        }
        $pages = $query->orderBy('id')->limit($limit + 1)->get();

        $hasMore = $pages->count() > $limit;
        if ($hasMore) {
            $pages = $pages->slice(0, $limit);
        }

        $data = $pages->map(function ($page) use ($locale) {
            $handle = $page->handle ?? strtolower($page->type);
            return [
                'handle' => $handle,
                'path' => '/' . $handle,
                'lastModified' => $page->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                'locale' => $locale,
                'changeFrequency' => 'weekly',
                'priority' => 0.7,
            ];
        })->values()->toArray();

        $nextCursor = $hasMore ? (string) $pages->last()->id : null;

        return response()->json([
            'data' => $data,
            'nextCursor' => $nextCursor,
        ]);
    }
}
