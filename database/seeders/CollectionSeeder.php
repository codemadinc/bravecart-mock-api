<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $collections = [
            [
                'title' => 'New Arrivals',
                'handle' => 'new-arrivals',
                'description' => 'Our latest additions — fresh styles for the season.',
                'description_html' => '<p>Our latest additions — fresh styles for the season.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&h=600&fit=crop',
                'image_alt_text' => 'New Arrivals Collection',
                'seo' => ['title' => 'New Arrivals | Pilot Demo Store', 'description' => 'Shop the latest arrivals.'],
                'product_handles' => ['classic-oxford-shirt', 'linen-summer-shirt', 'cashmere-scarf', 'canvas-sneakers'],
            ],
            [
                'title' => 'Bestsellers',
                'handle' => 'bestsellers',
                'description' => 'Our most popular products, loved by customers worldwide.',
                'description_html' => '<p>Our most popular products, loved by customers worldwide.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Bestsellers Collection',
                'seo' => ['title' => 'Bestsellers | Pilot Demo Store', 'description' => 'Shop our bestselling products.'],
                'product_handles' => ['classic-oxford-shirt', 'organic-cotton-tshirt', 'slim-fit-chinos', 'leather-weekend-bag'],
            ],
            [
                'title' => 'Tops',
                'handle' => 'tops',
                'description' => 'Shirts, sweaters, and t-shirts for every occasion.',
                'description_html' => '<p>Shirts, sweaters, and t-shirts for every occasion.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Tops Collection',
                'seo' => ['title' => 'Tops | Pilot Demo Store', 'description' => 'Shop shirts, sweaters, and t-shirts.'],
                'product_handles' => ['classic-oxford-shirt', 'merino-wool-sweater', 'organic-cotton-tshirt', 'linen-summer-shirt'],
            ],
            [
                'title' => 'Outerwear',
                'handle' => 'outerwear',
                'description' => 'Jackets and coats to keep you warm and stylish.',
                'description_html' => '<p>Jackets and coats to keep you warm and stylish.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1544923246-77307dd270b1?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Outerwear Collection',
                'seo' => ['title' => 'Outerwear | Pilot Demo Store', 'description' => 'Shop jackets and outerwear.'],
                'product_handles' => ['denim-jacket', 'wool-overcoat'],
            ],
            [
                'title' => 'Accessories',
                'handle' => 'accessories',
                'description' => 'The finishing touches — bags, belts, scarves, and eyewear.',
                'description_html' => '<p>The finishing touches — bags, belts, scarves, and eyewear.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Accessories Collection',
                'seo' => ['title' => 'Accessories | Pilot Demo Store', 'description' => 'Shop bags, belts, scarves, and eyewear.'],
                'product_handles' => ['leather-weekend-bag', 'leather-belt', 'sunglasses-aviator', 'cashmere-scarf'],
            ],
            [
                'title' => 'Sale',
                'handle' => 'sale',
                'description' => 'Limited-time offers on select styles.',
                'description_html' => '<p>Limited-time offers on select styles.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1607082349566-187342175e2f?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Sale Collection',
                'seo' => ['title' => 'Sale | Pilot Demo Store', 'description' => 'Shop our sale items.'],
                'product_handles' => ['classic-oxford-shirt', 'leather-weekend-bag', 'linen-summer-shirt'],
            ],
        ];

        foreach ($collections as $collectionData) {
            $productHandles = $collectionData['product_handles'];
            unset($collectionData['product_handles']);

            $collectionData['store_id'] = 1;
            $collection = Collection::create($collectionData);

            // Attach products
            $productIds = Product::whereIn('handle', $productHandles)->pluck('id');
            $sortOrder = 0;
            foreach ($productIds as $productId) {
                $collection->products()->attach($productId, ['sort_order' => $sortOrder++]);
            }
        }
    }
}
