<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ShopifyFormatter;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * POST /api/stores/{storeId}/cart/create
     * Create a new cart.
     */
    public function create(Request $request, int $storeId): JsonResponse
    {
        $cart = Cart::create([
            'store_id' => $storeId,
            'token' => Cart::generateToken(),
            'buyer_identity' => $request->input('buyerIdentity'),
        ]);

        // Optionally add initial lines
        if ($lines = $request->input('lines')) {
            foreach ($lines as $line) {
                $variantId = ShopifyFormatter::parseGid($line['merchandiseId'] ?? '0');
                $variant = ProductVariant::find($variantId);
                if ($variant) {
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'product_variant_id' => $variant->id,
                        'quantity' => max(1, (int) ($line['quantity'] ?? 1)),
                    ]);
                }
            }
        }

        return response()->json([
            'cart' => $this->formatCart($cart->fresh()),
        ], 201);
    }

    /**
     * GET /api/stores/{storeId}/cart/{token}
     * Get cart by token.
     */
    public function show(int $storeId, string $token): JsonResponse
    {
        $cart = Cart::where('store_id', $storeId)
            ->where('token', $token)
            ->firstOrFail();

        return response()->json([
            'cart' => $this->formatCart($cart),
        ]);
    }

    /**
     * POST /api/stores/{storeId}/cart/{token}/add
     * Add lines to cart.
     */
    public function addLines(Request $request, int $storeId, string $token): JsonResponse
    {
        $cart = Cart::where('store_id', $storeId)
            ->where('token', $token)
            ->firstOrFail();

        $lines = $request->input('lines', []);
        foreach ($lines as $line) {
            $variantId = ShopifyFormatter::parseGid($line['merchandiseId'] ?? '0');
            $variant = ProductVariant::find($variantId);
            if (!$variant) continue;

            $existing = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id', $variant->id)
                ->first();

            if ($existing) {
                $existing->increment('quantity', max(1, (int) ($line['quantity'] ?? 1)));
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => max(1, (int) ($line['quantity'] ?? 1)),
                ]);
            }
        }

        return response()->json([
            'cart' => $this->formatCart($cart->fresh()),
        ]);
    }

    /**
     * POST /api/stores/{storeId}/cart/{token}/update
     * Update line quantities.
     */
    public function updateLines(Request $request, int $storeId, string $token): JsonResponse
    {
        $cart = Cart::where('store_id', $storeId)
            ->where('token', $token)
            ->firstOrFail();

        $lines = $request->input('lines', []);
        foreach ($lines as $line) {
            $lineId = ShopifyFormatter::parseGid($line['id'] ?? '0');
            $cartItem = CartItem::where('cart_id', $cart->id)->where('id', $lineId)->first();
            if (!$cartItem) continue;

            $quantity = (int) ($line['quantity'] ?? 0);
            if ($quantity <= 0) {
                $cartItem->delete();
            } else {
                $cartItem->update(['quantity' => $quantity]);
            }
        }

        return response()->json([
            'cart' => $this->formatCart($cart->fresh()),
        ]);
    }

    /**
     * POST /api/stores/{storeId}/cart/{token}/remove
     * Remove lines from cart.
     */
    public function removeLines(Request $request, int $storeId, string $token): JsonResponse
    {
        $cart = Cart::where('store_id', $storeId)
            ->where('token', $token)
            ->firstOrFail();

        $lineIds = $request->input('lineIds', []);
        foreach ($lineIds as $lineId) {
            $numericId = ShopifyFormatter::parseGid($lineId);
            CartItem::where('cart_id', $cart->id)->where('id', $numericId)->delete();
        }

        return response()->json([
            'cart' => $this->formatCart($cart->fresh()),
        ]);
    }

    /**
     * POST /api/stores/{storeId}/cart/{token}/discount
     * Apply discount code (mock: 10% off for "PILOT10", 20% for "PILOT20").
     */
    public function applyDiscount(Request $request, int $storeId, string $token): JsonResponse
    {
        $cart = Cart::where('store_id', $storeId)
            ->where('token', $token)
            ->firstOrFail();

        $code = strtoupper($request->input('discountCode', ''));

        $discounts = [
            'PILOT10' => 10,
            'PILOT20' => 20,
            'WELCOME' => 15,
        ];

        if (isset($discounts[$code])) {
            $cart->update([
                'discount_code' => $code,
                'discount_amount' => $discounts[$code],
            ]);

            return response()->json([
                'cart' => $this->formatCart($cart->fresh()),
                'userErrors' => [],
            ]);
        }

        return response()->json([
            'cart' => $this->formatCart($cart),
            'userErrors' => [
                ['field' => ['discountCode'], 'message' => 'Discount code is not valid'],
            ],
        ], 422);
    }

    /**
     * Format a cart into Shopify-compatible shape.
     */
    private function formatCart(Cart $cart): array
    {
        $cart->load('items.variant.product');

        $lines = $cart->items->map(function (CartItem $item) {
            $variant = $item->variant;
            $product = $variant?->product;
            $price = (float) ($variant?->price ?? 0);

            return [
                'id' => $item->gid(),
                'quantity' => $item->quantity,
                'cost' => [
                    'totalAmount' => ShopifyFormatter::money($price * $item->quantity),
                    'amountPerQuantity' => ShopifyFormatter::money($price),
                    'compareAtAmountPerQuantity' => $variant?->compare_at_price
                        ? ShopifyFormatter::money((float) $variant->compare_at_price)
                        : null,
                ],
                'merchandise' => $variant ? [
                    'id' => $variant->gid(),
                    'title' => $variant->title,
                    'selectedOptions' => $variant->selected_options ?? [],
                    'image' => $variant->image_url ? [
                        'url' => $variant->image_url,
                        'altText' => $variant->title,
                    ] : ($product && !empty($product->images) ? [
                        'url' => $product->images[0]['url'] ?? '',
                        'altText' => $product->images[0]['altText'] ?? $product->title,
                    ] : null),
                    'product' => $product ? [
                        'id' => $product->gid(),
                        'title' => $product->title,
                        'handle' => $product->handle,
                        'vendor' => $product->vendor,
                    ] : null,
                ] : null,
            ];
        })->values()->all();

        // Calculate totals
        $subtotal = $cart->items->sum(function ($item) {
            return (float) ($item->variant?->price ?? 0) * $item->quantity;
        });

        $discountPercent = (float) $cart->discount_amount;
        $discountValue = $subtotal * ($discountPercent / 100);
        $total = max(0, $subtotal - $discountValue);
        $totalQuantity = $cart->items->sum('quantity');

        return [
            'id' => $cart->gid(),
            'token' => $cart->token,
            'checkoutUrl' => "/checkout?cart={$cart->token}",
            'totalQuantity' => $totalQuantity,
            'cost' => [
                'subtotalAmount' => ShopifyFormatter::money($subtotal),
                'totalAmount' => ShopifyFormatter::money($total),
                'totalTaxAmount' => ShopifyFormatter::money(0),
            ],
            'lines' => ShopifyFormatter::connection($lines),
            'discountCodes' => $cart->discount_code ? [
                ['code' => $cart->discount_code, 'applicable' => true],
            ] : [],
            'discountAllocations' => $discountValue > 0 ? [
                [
                    'discountedAmount' => ShopifyFormatter::money($discountValue),
                    'code' => $cart->discount_code,
                ],
            ] : [],
            'note' => $cart->note,
            'buyerIdentity' => $cart->buyer_identity,
            'createdAt' => $cart->created_at?->toIso8601String(),
            'updatedAt' => $cart->updated_at?->toIso8601String(),
        ];
    }
}
