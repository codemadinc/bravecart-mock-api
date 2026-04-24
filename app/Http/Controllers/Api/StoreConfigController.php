<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreConfigController extends Controller
{
    /**
     * POST /api/internal/store-config
     * Domain detection — Host header → store config.
     */
    public function detect(Request $request): JsonResponse
    {
        $host = $request->input('host') ?? $request->header('X-Forwarded-Host') ?? $request->getHost();

        // Strip port number if present
        $domain = preg_replace('/:\d+$/', '', $host);

        $store = Store::where('domain', $domain)->first();

        if (!$store) {
            // Fallback to first store for development
            $store = Store::first();
        }

        if (!$store) {
            return response()->json([
                'error' => 'Store not found for domain: ' . $domain,
            ], 404);
        }

        return response()->json([
            'storeId' => $store->id,
            'storeName' => $store->name,
            'storeHandle' => $store->handle,
            'domain' => $store->domain,
            'currencyCode' => $store->currency_code,
            'languageCode' => $store->language_code,
            'logoUrl' => $store->logo_url,
        ]);
    }
}
