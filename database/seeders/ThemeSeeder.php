<?php

namespace Database\Seeders;

use App\Models\ThemePage;
use App\Models\ThemeSettings;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        // Default homepage layout
        ThemePage::create([
            'store_id' => 1,
            'type' => 'INDEX',
            'handle' => null,
            'items' => [
                [
                    'id' => 'hero-banner',
                    'type' => 'hero-banner',
                    'parentId' => null,
                    'data' => [
                        'heading' => 'New Season, New Style',
                        'subheading' => 'Discover our latest collection of timeless essentials',
                        'buttonText' => 'Shop Now',
                        'buttonLink' => '/collections/new-arrivals',
                        'backgroundImage' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1600&h=800&fit=crop',
                        'overlayOpacity' => 40,
                        'height' => 'large',
                    ],
                ],
                [
                    'id' => 'featured-collections',
                    'type' => 'featured-collections',
                    'parentId' => null,
                    'data' => [
                        'heading' => 'Shop by Category',
                        'collections' => ['new-arrivals', 'tops', 'outerwear', 'accessories'],
                        'layout' => 'grid',
                    ],
                ],
                [
                    'id' => 'featured-products',
                    'type' => 'featured-products',
                    'parentId' => null,
                    'data' => [
                        'heading' => 'Bestsellers',
                        'collection' => 'bestsellers',
                        'count' => 4,
                    ],
                ],
                [
                    'id' => 'rich-text',
                    'type' => 'rich-text',
                    'parentId' => null,
                    'data' => [
                        'heading' => 'Crafted with Care',
                        'content' => 'Every piece in our collection is designed to last. We work with the finest materials and trusted manufacturers to create clothing that looks better with age.',
                        'alignment' => 'center',
                    ],
                ],
            ],
        ]);

        // Default product page layout
        ThemePage::create([
            'store_id' => 1,
            'type' => 'PRODUCT',
            'handle' => null,
            'items' => [
                [
                    'id' => 'product-detail',
                    'type' => 'product-detail',
                    'parentId' => null,
                    'data' => [
                        'showVendor' => true,
                        'showSku' => false,
                        'showQuantitySelector' => true,
                    ],
                ],
                [
                    'id' => 'related-products',
                    'type' => 'related-products',
                    'parentId' => null,
                    'data' => [
                        'heading' => 'You May Also Like',
                        'count' => 4,
                    ],
                ],
            ],
        ]);

        // Default collection page layout
        ThemePage::create([
            'store_id' => 1,
            'type' => 'COLLECTION',
            'handle' => null,
            'items' => [
                [
                    'id' => 'collection-banner',
                    'type' => 'collection-banner',
                    'parentId' => null,
                    'data' => [
                        'showDescription' => true,
                        'showImage' => true,
                    ],
                ],
                [
                    'id' => 'product-grid',
                    'type' => 'product-grid',
                    'parentId' => null,
                    'data' => [
                        'columns' => 3,
                        'productsPerPage' => 12,
                        'showFilters' => true,
                        'showSort' => true,
                    ],
                ],
            ],
        ]);

        // Theme settings
        ThemeSettings::create([
            'store_id' => 1,
            'settings' => [
                'colors' => [
                    'primary' => '#1B2A4A',
                    'secondary' => '#C19A6B',
                    'background' => '#FFFFFF',
                    'text' => '#1A1A1A',
                    'accent' => '#D4A574',
                    'error' => '#DC2626',
                    'success' => '#16A34A',
                ],
                'typography' => [
                    'headingFont' => 'Playfair Display',
                    'bodyFont' => 'Inter',
                    'baseFontSize' => '16px',
                ],
                'layout' => [
                    'maxWidth' => '1280px',
                    'containerPadding' => '1.5rem',
                ],
                'header' => [
                    'sticky' => true,
                    'transparent' => false,
                    'announcementBar' => [
                        'enabled' => true,
                        'text' => 'Free shipping on orders over $100',
                        'link' => '/collections/new-arrivals',
                    ],
                ],
                'footer' => [
                    'showNewsletter' => true,
                    'newsletterHeading' => 'Stay in the Loop',
                    'newsletterSubheading' => 'Subscribe for exclusive offers and new arrivals.',
                    'showSocialLinks' => true,
                    'socialLinks' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/pilotdemo'],
                        ['platform' => 'twitter', 'url' => 'https://twitter.com/pilotdemo'],
                        ['platform' => 'facebook', 'url' => 'https://facebook.com/pilotdemo'],
                    ],
                ],
                'product' => [
                    'showVendor' => true,
                    'showCompareAtPrice' => true,
                    'imageAspectRatio' => '3/4',
                ],
            ],
        ]);
    }
}
