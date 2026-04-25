<?php

namespace Database\Seeders;

use App\Models\ThemePage;
use App\Models\ThemeSettings;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Page Structure Data ──────────────────────────────────────────
        //
        // Page structure (items/sections) is intentionally left EMPTY here.
        // The SDK's local file fallback reads JSON files from the start-kit's
        // app/weaverse/pages/ directory when the API returns an empty page.
        //
        // This means the local JSON files are the SINGLE SOURCE OF TRUTH
        // for page layouts during development. To update a page layout:
        //   1. Export from Weaverse Studio → save to app/weaverse/pages/{type}.json
        //   2. Or edit the JSON file directly
        //
        // The API only needs to know which page types exist (for routing).
        // ──────────────────────────────────────────────────────────────────

        // Register all 8 page types with empty items
        // The SDK detects these as empty and falls back to local JSON files
        $pageTypes = [
            'INDEX',
            'PRODUCT',
            'COLLECTION',
            'ALL_PRODUCTS',
            'BLOG',
            'ARTICLE',
            'CONTACT',
            'COLLECTION_LIST',
        ];

        foreach ($pageTypes as $type) {
            ThemePage::create([
                'store_id' => 1,
                'type' => $type,
                'handle' => null,
                'items' => [],
            ]);
        }

        // Theme settings (kept — these are global settings, not page structure)
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
