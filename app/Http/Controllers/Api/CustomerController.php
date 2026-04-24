<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ShopifyFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * GET /api/stores/{storeId}/customer
     * Mock customer details.
     */
    public function show(int $storeId): JsonResponse
    {
        // Mock customer — in production this would come from auth token
        return response()->json([
            'customer' => [
                'id' => 'gid://bravecart/Customer/1',
                'firstName' => 'Jane',
                'lastName' => 'Doe',
                'email' => 'jane.doe@example.com',
                'phone' => '+15551234567',
                'defaultAddress' => [
                    'id' => 'gid://bravecart/MailingAddress/1',
                    'firstName' => 'Jane',
                    'lastName' => 'Doe',
                    'address1' => '123 Fashion Avenue',
                    'address2' => 'Suite 100',
                    'city' => 'New York',
                    'province' => 'New York',
                    'provinceCode' => 'NY',
                    'zip' => '10001',
                    'country' => 'United States',
                    'countryCodeV2' => 'US',
                    'formatted' => ['123 Fashion Avenue', 'Suite 100', 'New York NY 10001', 'United States'],
                ],
                'addresses' => [
                    'nodes' => [
                        [
                            'id' => 'gid://bravecart/MailingAddress/1',
                            'firstName' => 'Jane',
                            'lastName' => 'Doe',
                            'address1' => '123 Fashion Avenue',
                            'city' => 'New York',
                            'province' => 'New York',
                            'zip' => '10001',
                            'country' => 'United States',
                        ],
                    ],
                ],
                'orders' => [
                    'totalCount' => 2,
                ],
            ],
        ]);
    }

    /**
     * GET /api/stores/{storeId}/customer/orders
     * Mock customer orders.
     */
    public function orders(Request $request, int $storeId): JsonResponse
    {
        return response()->json([
            'customer' => [
                'orders' => ShopifyFormatter::connection([
                    [
                        'id' => 'gid://bravecart/Order/1001',
                        'name' => '#1001',
                        'orderNumber' => 1001,
                        'processedAt' => '2026-04-15T10:30:00Z',
                        'financialStatus' => 'PAID',
                        'fulfillmentStatus' => 'FULFILLED',
                        'totalPrice' => ShopifyFormatter::money(168.00),
                        'lineItems' => ShopifyFormatter::connection([
                            [
                                'title' => 'Classic Oxford Shirt',
                                'quantity' => 1,
                                'variant' => [
                                    'title' => 'M / White',
                                    'price' => ShopifyFormatter::money(79.00),
                                    'image' => [
                                        'url' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=200&h=200&fit=crop',
                                        'altText' => 'Classic Oxford Shirt',
                                    ],
                                ],
                            ],
                            [
                                'title' => 'Slim Fit Chinos',
                                'quantity' => 1,
                                'variant' => [
                                    'title' => '32 / Navy',
                                    'price' => ShopifyFormatter::money(89.00),
                                    'image' => [
                                        'url' => 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=200&h=200&fit=crop',
                                        'altText' => 'Slim Fit Chinos',
                                    ],
                                ],
                            ],
                        ]),
                    ],
                    [
                        'id' => 'gid://bravecart/Order/1002',
                        'name' => '#1002',
                        'orderNumber' => 1002,
                        'processedAt' => '2026-04-20T14:15:00Z',
                        'financialStatus' => 'PAID',
                        'fulfillmentStatus' => 'UNFULFILLED',
                        'totalPrice' => ShopifyFormatter::money(349.00),
                        'lineItems' => ShopifyFormatter::connection([
                            [
                                'title' => 'Leather Weekend Bag',
                                'quantity' => 1,
                                'variant' => [
                                    'title' => 'Cognac',
                                    'price' => ShopifyFormatter::money(349.00),
                                    'image' => [
                                        'url' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=200&h=200&fit=crop',
                                        'altText' => 'Leather Weekend Bag',
                                    ],
                                ],
                            ],
                        ]),
                    ],
                ], ShopifyFormatter::pageInfo()),
            ],
        ]);
    }

    /**
     * GET /api/stores/{storeId}/customer/orders/{orderId}
     * Mock single order detail.
     */
    public function order(int $storeId, string $orderId): JsonResponse
    {
        return response()->json([
            'order' => [
                'id' => "gid://bravecart/Order/{$orderId}",
                'name' => "#{$orderId}",
                'orderNumber' => (int) $orderId,
                'processedAt' => '2026-04-15T10:30:00Z',
                'financialStatus' => 'PAID',
                'fulfillmentStatus' => 'FULFILLED',
                'totalPrice' => ShopifyFormatter::money(168.00),
                'subtotalPrice' => ShopifyFormatter::money(168.00),
                'totalShippingPrice' => ShopifyFormatter::money(0),
                'totalTax' => ShopifyFormatter::money(0),
                'shippingAddress' => [
                    'firstName' => 'Jane',
                    'lastName' => 'Doe',
                    'address1' => '123 Fashion Avenue',
                    'city' => 'New York',
                    'province' => 'New York',
                    'zip' => '10001',
                    'country' => 'United States',
                ],
                'lineItems' => ShopifyFormatter::connection([
                    [
                        'title' => 'Classic Oxford Shirt',
                        'quantity' => 1,
                        'variant' => [
                            'title' => 'M / White',
                            'price' => ShopifyFormatter::money(79.00),
                        ],
                    ],
                    [
                        'title' => 'Slim Fit Chinos',
                        'quantity' => 1,
                        'variant' => [
                            'title' => '32 / Navy',
                            'price' => ShopifyFormatter::money(89.00),
                        ],
                    ],
                ]),
            ],
        ]);
    }
}
