<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ThemePage;
use App\Models\ThemeSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * GET /api/stores/{storeId}/theme/page
     * Get page layout by type and optional handle.
     */
    public function getPage(Request $request, int $storeId): JsonResponse
    {
        $type = strtoupper($request->input('type', 'INDEX'));
        $handle = $request->input('handle');

        // First try specific handle, then fall back to type default
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

        if (!$page) {
            return response()->json([
                'page' => null,
                'message' => "No layout found for type={$type}" . ($handle ? ", handle={$handle}" : ''),
            ]);
        }

        return response()->json([
            'page' => [
                'id' => $page->id,
                'type' => $page->type,
                'handle' => $page->handle,
                'items' => $page->items,
                'updatedAt' => $page->updated_at?->toIso8601String(),
            ],
        ]);
    }

    /**
     * POST /api/stores/{storeId}/theme/page
     * Save page layout (create or update).
     */
    public function savePage(Request $request, int $storeId): JsonResponse
    {
        $type = strtoupper($request->input('type', 'INDEX'));
        $handle = $request->input('handle');
        $items = $request->input('items', []);

        $page = ThemePage::updateOrCreate(
            [
                'store_id' => $storeId,
                'type' => $type,
                'handle' => $handle,
            ],
            [
                'items' => $items,
            ]
        );

        return response()->json([
            'page' => [
                'id' => $page->id,
                'type' => $page->type,
                'handle' => $page->handle,
                'items' => $page->items,
                'updatedAt' => $page->updated_at?->toIso8601String(),
            ],
            'message' => 'Page layout saved successfully.',
        ]);
    }

    /**
     * GET /api/stores/{storeId}/theme/settings
     * Get theme settings.
     */
    public function getSettings(int $storeId): JsonResponse
    {
        $settings = ThemeSettings::where('store_id', $storeId)->first();

        return response()->json([
            'themeSettings' => $settings ? $settings->settings : null,
            'updatedAt' => $settings?->updated_at?->toIso8601String(),
        ]);
    }

    /**
     * POST /api/stores/{storeId}/theme/settings
     * Save theme settings (full replace).
     */
    public function saveSettings(Request $request, int $storeId): JsonResponse
    {
        $settings = $request->input('settings', []);

        $themeSettings = ThemeSettings::updateOrCreate(
            ['store_id' => $storeId],
            ['settings' => $settings]
        );

        return response()->json([
            'themeSettings' => $themeSettings->settings,
            'updatedAt' => $themeSettings->updated_at?->toIso8601String(),
            'message' => 'Theme settings saved successfully.',
        ]);
    }
}
