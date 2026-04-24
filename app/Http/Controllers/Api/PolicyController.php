<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\JsonResponse;

class PolicyController extends Controller
{
    /**
     * GET /api/stores/{storeId}/policies
     * List all policies.
     */
    public function index(int $storeId): JsonResponse
    {
        $policies = Policy::where('store_id', $storeId)->get();

        $nodes = $policies->map(fn($p) => [
            'id' => $p->gid(),
            'title' => $p->title,
            'handle' => $p->handle,
            'body' => $p->body,
            'url' => "/policies/{$p->handle}",
        ])->values()->all();

        return response()->json([
            'shop' => [
                'privacyPolicy' => $policies->firstWhere('handle', 'privacy-policy') ? [
                    'id' => $policies->firstWhere('handle', 'privacy-policy')->gid(),
                    'title' => 'Privacy Policy',
                    'handle' => 'privacy-policy',
                    'body' => $policies->firstWhere('handle', 'privacy-policy')->body,
                    'url' => '/policies/privacy-policy',
                ] : null,
                'shippingPolicy' => $policies->firstWhere('handle', 'shipping-policy') ? [
                    'id' => $policies->firstWhere('handle', 'shipping-policy')->gid(),
                    'title' => 'Shipping Policy',
                    'handle' => 'shipping-policy',
                    'body' => $policies->firstWhere('handle', 'shipping-policy')->body,
                    'url' => '/policies/shipping-policy',
                ] : null,
                'termsOfService' => $policies->firstWhere('handle', 'terms-of-service') ? [
                    'id' => $policies->firstWhere('handle', 'terms-of-service')->gid(),
                    'title' => 'Terms of Service',
                    'handle' => 'terms-of-service',
                    'body' => $policies->firstWhere('handle', 'terms-of-service')->body,
                    'url' => '/policies/terms-of-service',
                ] : null,
                'refundPolicy' => $policies->firstWhere('handle', 'refund-policy') ? [
                    'id' => $policies->firstWhere('handle', 'refund-policy')->gid(),
                    'title' => 'Refund Policy',
                    'handle' => 'refund-policy',
                    'body' => $policies->firstWhere('handle', 'refund-policy')->body,
                    'url' => '/policies/refund-policy',
                ] : null,
            ],
        ]);
    }

    /**
     * GET /api/stores/{storeId}/policies/{handle}
     * Single policy.
     */
    public function show(int $storeId, string $handle): JsonResponse
    {
        $policy = Policy::where('store_id', $storeId)
            ->where('handle', $handle)
            ->firstOrFail();

        return response()->json([
            'policy' => [
                'id' => $policy->gid(),
                'title' => $policy->title,
                'handle' => $policy->handle,
                'body' => $policy->body,
                'url' => "/policies/{$policy->handle}",
            ],
        ]);
    }
}
