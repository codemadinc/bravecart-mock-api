<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class LayoutController extends Controller
{
    /**
     * GET /api/stores/{storeId}/layout
     * Returns shop info + header menu + footer menu.
     */
    public function index(int $storeId): JsonResponse
    {
        $store = Store::with('menus')->findOrFail($storeId);

        $headerMenu = $store->menus->firstWhere('handle', 'header');
        $footerMenu = $store->menus->firstWhere('handle', 'footer');

        return response()->json([
            'shop' => [
                'id' => $store->gid(),
                'name' => $store->name,
                'description' => $store->description,
                'primaryDomain' => [
                    'url' => "https://{$store->domain}",
                ],
                'brand' => [
                    'logo' => [
                        'image' => [
                            'url' => $store->logo_url,
                        ],
                    ],
                ],
            ],
            'headerMenu' => $headerMenu ? [
                'id' => $headerMenu->gid(),
                'items' => $headerMenu->items,
            ] : null,
            'footerMenu' => $footerMenu ? [
                'id' => $footerMenu->gid(),
                'items' => $footerMenu->items,
            ] : null,
        ]);
    }
}
