<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Swatch;
use Illuminate\Http\JsonResponse;

class SwatchController extends Controller
{
    /**
     * GET /api/stores/{storeId}/swatches
     * Get all color/image swatches.
     */
    public function index(int $storeId): JsonResponse
    {
        $swatches = Swatch::where('store_id', $storeId)->get();

        $nodes = $swatches->map(fn($s) => [
            'name' => $s->name,
            'color' => $s->color,
            'image' => $s->image_url ? [
                'previewImage' => [
                    'url' => $s->image_url,
                ],
            ] : null,
        ])->values()->all();

        return response()->json([
            'swatches' => $nodes,
        ]);
    }
}
