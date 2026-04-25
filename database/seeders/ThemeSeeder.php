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
        // Section types MUST match the start-kit's registered component schemas
        // See: bravecart-start-kit-v2/app/weaverse/components.ts
        ThemePage::create([
            'store_id' => 1,
            'type' => 'INDEX',
            'handle' => null,
            'items' => [
                // hero-image section (start-kit type: "hero-image")
                [
                    'id' => 'hero-image',
                    'type' => 'hero-image',
                    'parentId' => null,
                    'data' => [
                        'height' => 'large',
                        'contentPosition' => 'center center',
                        'backgroundImage' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1600&h=800&fit=crop',
                        'backgroundFit' => 'cover',
                        'enableOverlay' => true,
                        'overlayOpacity' => 40,
                    ],
                ],
                // hero-image children: subheading, heading, paragraph, button
                [
                    'id' => 'hero-subheading',
                    'type' => 'subheading',
                    'parentId' => 'hero-image',
                    'data' => [
                        'content' => 'Discover our latest collection of timeless essentials',
                        'color' => '#ffffff',
                    ],
                ],
                [
                    'id' => 'hero-heading',
                    'type' => 'heading',
                    'parentId' => 'hero-image',
                    'data' => [
                        'content' => 'New Season, New Style',
                        'as' => 'h2',
                        'color' => '#ffffff',
                        'size' => 'default',
                    ],
                ],
                [
                    'id' => 'hero-paragraph',
                    'type' => 'paragraph',
                    'parentId' => 'hero-image',
                    'data' => [
                        'content' => 'Curated pieces designed to elevate your everyday wardrobe.',
                        'color' => '#ffffff',
                    ],
                ],
                [
                    'id' => 'hero-button',
                    'type' => 'button',
                    'parentId' => 'hero-image',
                    'data' => [
                        'text' => 'Shop Now',
                        'link' => '/collections/new-arrivals',
                    ],
                ],
                // featured-collections section
                // collections use WeaverseCollection format: { id, handle }
                [
                    'id' => 'featured-collections',
                    'type' => 'featured-collections',
                    'parentId' => null,
                    'data' => [
                        'collections' => [
                            ['id' => 1, 'handle' => 'new-arrivals'],
                            ['id' => 3, 'handle' => 'tops'],
                            ['id' => 4, 'handle' => 'outerwear'],
                            ['id' => 5, 'handle' => 'accessories'],
                        ],
                    ],
                ],
                [
                    'id' => 'fc-heading',
                    'type' => 'heading',
                    'parentId' => 'featured-collections',
                    'data' => [
                        'content' => 'Shop by Category',
                    ],
                ],
                [
                    'id' => 'fc-items',
                    'type' => 'featured-collections-items',
                    'parentId' => 'featured-collections',
                    'data' => [
                        'imageAspectRatio' => '3/4',
                        'gridSize' => '4',
                        'contentPosition' => 'over',
                        'collectionNameColor' => '#fff',
                        'buttonText' => 'Shop now',
                        'enableOverlay' => true,
                        'overlayColor' => '#000',
                        'overlayOpacity' => 30,
                    ],
                ],
                // featured-products section (auto mode)
                [
                    'id' => 'featured-products',
                    'type' => 'featured-products',
                    'parentId' => null,
                    'data' => [
                        'selectionMethod' => 'auto',
                    ],
                ],
                [
                    'id' => 'fp-heading',
                    'type' => 'heading',
                    'parentId' => 'featured-products',
                    'data' => [
                        'content' => 'Bestsellers',
                    ],
                ],
                [
                    'id' => 'fp-items',
                    'type' => 'featured-products-items',
                    'parentId' => 'featured-products',
                    'data' => [],
                ],
                // image-with-text section (replaces old "rich-text" which doesn't exist)
                [
                    'id' => 'image-with-text',
                    'type' => 'image-with-text',
                    'parentId' => null,
                    'data' => [
                        'verticalPadding' => 'none',
                    ],
                ],
                [
                    'id' => 'iwt-image',
                    'type' => 'image-with-text--image',
                    'parentId' => 'image-with-text',
                    'data' => [
                        'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800&h=600&fit=crop',
                        'hideOnMobile' => false,
                    ],
                ],
                [
                    'id' => 'iwt-content',
                    'type' => 'image-with-text--content',
                    'parentId' => 'image-with-text',
                    'data' => [],
                ],
                [
                    'id' => 'iwt-heading',
                    'type' => 'heading',
                    'parentId' => 'iwt-content',
                    'data' => [
                        'content' => 'Crafted with Care',
                    ],
                ],
                [
                    'id' => 'iwt-paragraph',
                    'type' => 'paragraph',
                    'parentId' => 'iwt-content',
                    'data' => [
                        'content' => 'Every piece in our collection is designed to last. We work with the finest materials and trusted manufacturers to create clothing that looks better with age.',
                    ],
                ],
                [
                    'id' => 'iwt-button',
                    'type' => 'button',
                    'parentId' => 'iwt-content',
                    'data' => [
                        'text' => 'Learn More',
                        'link' => '/pages/about',
                    ],
                ],
            ],
        ]);

        // Default product page layout
        // Section types: main-product, related-products
        ThemePage::create([
            'store_id' => 1,
            'type' => 'PRODUCT',
            'handle' => null,
            'items' => [
                [
                    'id' => 'main-product',
                    'type' => 'main-product',
                    'parentId' => null,
                    'data' => [],
                ],
                [
                    'id' => 'mp-media',
                    'type' => 'mp--media',
                    'parentId' => 'main-product',
                    'data' => [],
                ],
                [
                    'id' => 'mp-info',
                    'type' => 'mp--info',
                    'parentId' => 'main-product',
                    'data' => [],
                ],
                [
                    'id' => 'mp-breadcrumb',
                    'type' => 'mp--breadcrumb',
                    'parentId' => 'mp-info',
                    'data' => [],
                ],
                [
                    'id' => 'mp-title',
                    'type' => 'mp--title',
                    'parentId' => 'mp-info',
                    'data' => [],
                ],
                [
                    'id' => 'mp-prices',
                    'type' => 'mp--prices',
                    'parentId' => 'mp-info',
                    'data' => [],
                ],
                [
                    'id' => 'mp-variants',
                    'type' => 'mp--variant-selector',
                    'parentId' => 'mp-info',
                    'data' => [],
                ],
                [
                    'id' => 'mp-quantity',
                    'type' => 'mp--quantity-selector',
                    'parentId' => 'mp-info',
                    'data' => [],
                ],
                [
                    'id' => 'mp-atc',
                    'type' => 'mp--atc-buttons',
                    'parentId' => 'mp-info',
                    'data' => [],
                ],
                [
                    'id' => 'related-products',
                    'type' => 'related-products',
                    'parentId' => null,
                    'data' => [],
                ],
                [
                    'id' => 'rp-heading',
                    'type' => 'heading',
                    'parentId' => 'related-products',
                    'data' => [
                        'content' => 'You May Also Like',
                    ],
                ],
                [
                    'id' => 'rp-items',
                    'type' => 'related-products--items',
                    'parentId' => 'related-products',
                    'data' => [],
                ],
            ],
        ]);

        // Default collection page layout
        // Section types: main-collection with children
        ThemePage::create([
            'store_id' => 1,
            'type' => 'COLLECTION',
            'handle' => null,
            'items' => [
                [
                    'id' => 'main-collection',
                    'type' => 'main-collection',
                    'parentId' => null,
                    'data' => [],
                ],
                [
                    'id' => 'mc-header',
                    'type' => 'mc--header',
                    'parentId' => 'main-collection',
                    'data' => [],
                ],
                [
                    'id' => 'mc-toolbar',
                    'type' => 'mc--toolbar',
                    'parentId' => 'main-collection',
                    'data' => [],
                ],
                [
                    'id' => 'mc-content',
                    'type' => 'mc--content',
                    'parentId' => 'main-collection',
                    'data' => [],
                ],
                [
                    'id' => 'mc-filters',
                    'type' => 'mc--filters',
                    'parentId' => 'mc-content',
                    'data' => [],
                ],
                [
                    'id' => 'mc-product-grid',
                    'type' => 'mc--product-grid',
                    'parentId' => 'mc-content',
                    'data' => [],
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
