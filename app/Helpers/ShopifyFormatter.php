<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Collection;
use App\Models\Article;

/**
 * Transforms Eloquent models into Shopify-compatible response shapes.
 *
 * Response conventions:
 * - IDs use gid://bravecart/Type/123 format
 * - Prices use MoneyV2: { amount: "199.99", currencyCode: "USD" }
 * - Images use: { id, url, altText, width, height }
 * - Arrays use { nodes: [...] } wrapper
 * - Pagination uses { pageInfo: { hasPreviousPage, hasNextPage, endCursor, startCursor } }
 */
class ShopifyFormatter
{
    /**
     * Format a price as MoneyV2.
     */
    public static function money(?float $amount, string $currencyCode = 'USD'): ?array
    {
        if ($amount === null) return null;
        return [
            'amount' => number_format($amount, 2, '.', ''),
            'currencyCode' => $currencyCode,
        ];
    }

    /**
     * Format a product image.
     */
    public static function image(?array $img): ?array
    {
        if (!$img) return null;
        return [
            'id' => $img['id'] ?? null,
            'url' => $img['url'] ?? '',
            'altText' => $img['altText'] ?? null,
            'width' => $img['width'] ?? null,
            'height' => $img['height'] ?? null,
        ];
    }

    /**
     * Wrap an array in a nodes connection.
     */
    public static function connection(array $items, ?array $pageInfo = null): array
    {
        $result = ['nodes' => $items];
        if ($pageInfo) {
            $result['pageInfo'] = $pageInfo;
        }
        return $result;
    }

    /**
     * Create a simple pageInfo object.
     */
    public static function pageInfo(
        bool $hasPreviousPage = false,
        bool $hasNextPage = false,
        ?string $startCursor = null,
        ?string $endCursor = null
    ): array {
        return [
            'hasPreviousPage' => $hasPreviousPage,
            'hasNextPage' => $hasNextPage,
            'startCursor' => $startCursor,
            'endCursor' => $endCursor,
        ];
    }

    /**
     * Format a full product for detail view.
     */
    public static function product(Product $product, string $currencyCode = 'USD'): array
    {
        $product->loadMissing('variants');

        $images = collect($product->images ?? [])->map(fn($img) => self::image($img))->values()->all();
        $variants = $product->variants->map(fn($v) => self::variant($v, $currencyCode))->values()->all();

        $firstVariant = $product->variants->first();

        return [
            'id' => $product->gid(),
            'title' => $product->title,
            'handle' => $product->handle,
            'description' => $product->description,
            'descriptionHtml' => $product->description_html,
            'productType' => $product->product_type,
            'vendor' => $product->vendor,
            'tags' => $product->tags ?? [],
            'availableForSale' => $product->available_for_sale,
            'options' => collect($product->options ?? [])->map(fn($opt) => [
                'name' => $opt['name'],
                'values' => $opt['values'] ?? [],
                'optionValues' => collect($opt['values'] ?? [])->map(fn($v) => [
                    'name' => $v,
                    'firstSelectableVariant' => null, // simplified
                    'swatch' => null,
                ])->all(),
            ])->all(),
            'priceRange' => [
                'minVariantPrice' => self::money((float)$product->price_min, $currencyCode),
                'maxVariantPrice' => self::money((float)$product->price_max, $currencyCode),
            ],
            'compareAtPriceRange' => [
                'minVariantPrice' => self::money($product->compare_at_price_min ? (float)$product->compare_at_price_min : null, $currencyCode),
                'maxVariantPrice' => self::money($product->compare_at_price_max ? (float)$product->compare_at_price_max : null, $currencyCode),
            ],
            'featuredImage' => !empty($images) ? $images[0] : null,
            'images' => self::connection($images),
            'variants' => self::connection($variants),
            'selectedOrFirstAvailableVariant' => $firstVariant ? self::variant($firstVariant, $currencyCode) : null,
            'seo' => $product->seo ?? ['title' => $product->title, 'description' => $product->description],
            'createdAt' => $product->created_at?->toIso8601String(),
            'updatedAt' => $product->updated_at?->toIso8601String(),
        ];
    }

    /**
     * Format a product card (lighter version for listings).
     */
    public static function productCard(Product $product, string $currencyCode = 'USD'): array
    {
        $product->loadMissing('variants');
        $images = collect($product->images ?? [])->map(fn($img) => self::image($img))->values()->all();
        $variants = $product->variants->map(fn($v) => self::variant($v, $currencyCode))->values()->all();
        $firstVariant = $product->variants->first();

        return [
            'id' => $product->gid(),
            'title' => $product->title,
            'handle' => $product->handle,
            'vendor' => $product->vendor,
            'productType' => $product->product_type,
            'availableForSale' => $product->available_for_sale,
            'priceRange' => [
                'minVariantPrice' => self::money((float)$product->price_min, $currencyCode),
                'maxVariantPrice' => self::money((float)$product->price_max, $currencyCode),
            ],
            'compareAtPriceRange' => [
                'minVariantPrice' => self::money($product->compare_at_price_min ? (float)$product->compare_at_price_min : null, $currencyCode),
                'maxVariantPrice' => self::money($product->compare_at_price_max ? (float)$product->compare_at_price_max : null, $currencyCode),
            ],
            'featuredImage' => !empty($images) ? $images[0] : null,
            'images' => self::connection($images),
            'variants' => self::connection($variants),
            'selectedOrFirstAvailableVariant' => $firstVariant ? self::variant($firstVariant, $currencyCode) : null,
            'options' => collect($product->options ?? [])->map(fn($opt) => [
                'name' => $opt['name'],
                'values' => $opt['values'] ?? [],
                'optionValues' => collect($opt['values'] ?? [])->map(fn($v) => [
                    'name' => $v,
                    'firstSelectableVariant' => null,
                    'swatch' => null,
                ])->all(),
            ])->all(),
        ];
    }

    /**
     * Format a product variant.
     */
    public static function variant(ProductVariant $variant, string $currencyCode = 'USD'): array
    {
        return [
            'id' => $variant->gid(),
            'title' => $variant->title,
            'sku' => $variant->sku,
            'availableForSale' => $variant->available_for_sale,
            'quantityAvailable' => $variant->quantity_available,
            'price' => self::money((float)$variant->price, $currencyCode),
            'compareAtPrice' => $variant->compare_at_price ? self::money((float)$variant->compare_at_price, $currencyCode) : null,
            'selectedOptions' => $variant->selected_options ?? [],
            'image' => $variant->image_url ? [
                'id' => null,
                'url' => $variant->image_url,
                'altText' => $variant->title,
                'width' => 800,
                'height' => 1000,
            ] : null,
            'product' => [
                'id' => "gid://bravecart/Product/{$variant->product_id}",
                'handle' => $variant->product?->handle ?? '',
                'title' => $variant->product?->title ?? '',
            ],
            'weight' => $variant->weight,
            'weightUnit' => $variant->weight_unit,
        ];
    }

    /**
     * Format a collection.
     */
    public static function collection(Collection $collection, bool $includeProducts = false, string $currencyCode = 'USD'): array
    {
        $result = [
            'id' => $collection->gid(),
            'title' => $collection->title,
            'handle' => $collection->handle,
            'description' => $collection->description,
            'descriptionHtml' => $collection->description_html,
            'image' => $collection->image_url ? [
                'id' => null,
                'url' => $collection->image_url,
                'altText' => $collection->image_alt_text,
                'width' => 1200,
                'height' => 600,
            ] : null,
            'seo' => $collection->seo ?? ['title' => $collection->title, 'description' => $collection->description],
            'updatedAt' => $collection->updated_at?->toIso8601String(),
        ];

        if ($includeProducts) {
            $collection->loadMissing('products.variants');
            $products = $collection->products->map(fn($p) => self::productCard($p, $currencyCode))->values()->all();
            $result['products'] = self::connection($products);
        }

        return $result;
    }

    /**
     * Format an article.
     */
    public static function article(Article $article): array
    {
        return [
            'id' => $article->gid(),
            'title' => $article->title,
            'handle' => $article->handle,
            'excerpt' => $article->excerpt,
            'contentHtml' => $article->content_html,
            'author' => $article->author_name ? ['name' => $article->author_name] : null,
            'image' => $article->image_url ? [
                'id' => null,
                'url' => $article->image_url,
                'altText' => $article->image_alt_text,
                'width' => 1200,
                'height' => 600,
            ] : null,
            'tags' => $article->tags ?? [],
            'seo' => $article->seo ?? ['title' => $article->title, 'description' => $article->excerpt],
            'publishedAt' => $article->published_at?->toIso8601String(),
            'blog' => [
                'handle' => $article->blog?->handle ?? '',
            ],
        ];
    }

    /**
     * Extract numeric ID from a GID string.
     */
    public static function parseGid(string $gid): ?int
    {
        if (preg_match('/\/(\d+)$/', $gid, $matches)) {
            return (int) $matches[1];
        }
        // If it's just a number, return it directly
        if (is_numeric($gid)) {
            return (int) $gid;
        }
        return null;
    }
}
