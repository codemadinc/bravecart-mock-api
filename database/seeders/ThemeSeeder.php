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

        // ─── Theme Settings ──────────────────────────────────────────────
        //
        // IMPORTANT: Keys MUST be flat (not nested) and match the exact
        // `name` fields in the start-kit's app/weaverse/settings/*.ts schemas.
        //
        // The SDK passes these through as-is to useThemeSettings(), and
        // the GlobalStyle component + other consumers destructure them
        // by these exact flat key names.
        //
        // Cross-referenced against:
        //   - app/weaverse/style.tsx (GlobalStyle)
        //   - app/weaverse/settings/general.ts
        //   - app/weaverse/settings/typography.ts
        //   - app/weaverse/settings/links-buttons.ts
        //   - app/weaverse/settings/announcements.ts
        //   - app/weaverse/settings/header.ts
        //   - app/weaverse/settings/product-badges.ts
        //   - app/weaverse/settings/product-cards.ts
        //   - app/weaverse/settings/newsletter.ts
        //   - app/weaverse/settings/search.ts
        //   - app/weaverse/settings/cart.ts
        //   - app/weaverse/settings/footer.ts
        // ──────────────────────────────────────────────────────────────────

        ThemeSettings::create([
            'store_id' => 1,
            'settings' => [

                // ── General (general.ts) ─────────────────────────────────
                // Layout
                'pageWidth' => 1280,
                'navHeightMobile' => 3,
                'navHeightTablet' => 4,
                'navHeightDesktop' => 6,

                // Border radius
                'radiusBase' => 0,

                // Animations
                'enableViewTransition' => true,
                'revealElementsOnScroll' => true,

                // Colors (general)
                'colorBackground' => '#ffffff',
                'colorText' => '#0F0F0F',
                'colorTextSubtle' => '#88847F',
                'colorTextInverse' => '#ffffff',
                'colorLine' => '#3B352C',
                'colorLineSubtle' => '#A19B91',

                // Colors (product — in general.ts)
                'comparePriceTextColor' => '#84807B',
                'productReviewsColor' => '#108474',

                // ── Typography (typography.ts) ───────────────────────────
                // Headings
                'headingBaseSpacing' => '0em',
                'h1BaseSize' => 60,
                'headingBaseLineHeight' => 1.2,

                // Body text
                'bodyBaseSpacing' => '0.025em',
                'bodyBaseSize' => 16,
                'bodyBaseLineHeight' => 1.5,

                // ── Links & Buttons (links-buttons.ts) ───────────────────
                // Primary
                'buttonPrimaryBg' => '#000000',
                'buttonPrimaryBgHover' => '#404040',
                'buttonPrimaryColor' => '#ffffff',

                // Secondary
                'buttonSecondaryBg' => '#ffffff',
                'buttonSecondaryBgHover' => '#f5f5f5',
                'buttonSecondaryColor' => '#000000',

                // Outline
                'buttonOutlineTextAndBorder' => '#000000',
                'buttonOutlineBgHover' => '#f5f5f5',

                // ── Scrolling Announcements (announcements.ts) ───────────
                'topbarText' => '<p>Free shipping on orders over $50</p><p>New arrivals dropping every week</p><p>30-day hassle-free returns</p><p>Sign up and get 10% off your first order</p>',
                'topbarScrollingGap' => 44,
                'topbarHeight' => 36,
                'topbarScrollingSpeed' => 1,
                'topbarTextColor' => '#ffffff',
                'topbarBgColor' => '#000000',

                // ── Header (header.ts) ───────────────────────────────────
                'headerWidth' => 'fixed',
                'enableTransparentHeader' => false,
                'logoData' => [
                    'id' => 'gid://shopify/MediaImage/34144817938616',
                    'altText' => 'Logo',
                    'url' => 'https://cdn.shopify.com/s/files/1/0623/5095/0584/files/Pilot_logo_b04f1938-06e5-414d-8a47-d5fcca424000.png?v=1697101908',
                    'width' => 320,
                    'height' => 116,
                ],
                'transparentLogoData' => [
                    'id' => 'gid://shopify/MediaImage/34144817938616',
                    'altText' => 'Logo',
                    'url' => 'https://cdn.shopify.com/s/files/1/0838/0052/3057/files/transparent_Pilot_logo.png?v=1718763594',
                    'width' => 320,
                    'height' => 116,
                ],
                'logoWidth' => 150,
                'showHeaderCountrySelector' => false,
                'countryNameDisplay' => 'short',
                'headerBgColor' => '#ffffff',
                'headerText' => '#000000',
                'transparentHeaderText' => '#ffffff',

                // ── Product Badges (product-badges.ts) ───────────────────
                'badgeTextTransform' => 'uppercase',
                'bestSellerBadgeText' => 'Best Seller',
                'newBadgeText' => 'New',
                'newBadgeDaysOld' => 30,
                'bundleBadgeText' => 'Bundle',
                'soldOutBadgeText' => 'Sold out',
                'saleBadgeText' => '-[percentage]% Off',
                'saleBadgeColor' => '#c6512c',
                'newBadgeColor' => '#67785d',
                'bestSellerBadgeColor' => '#000000',
                'bundleBadgeColor' => '#10804c',
                'soldOutBadgeColor' => '#d4d4d4',

                // ── Product Cards (product-cards.ts) ─────────────────────
                'pcardImageRatio' => '3/4',
                'pcardShowImageOnHover' => true,
                'pcardShowVendor' => true,
                'pcardShowLowestPrice' => true,
                'pcardShowSalePrice' => true,
                'pcardShowReviews' => true,
                'pcardAlignment' => 'left',
                'pcardTitlePricesAlignment' => 'left',
                'pcardBackgroundColor' => '',
                'pcardShowOptionValues' => true,
                'pcardOptionToShow' => 'Color',
                'pcardMaxOptionValues' => 5,
                'pcardEnableQuickShop' => true,
                'pcardShowQuickShopOnHover' => true,
                'pcardQuickShopButtonType' => 'icon',
                'pcardQuickShopButtonText' => 'Quick shop',
                'pcardQuickShopPanelType' => 'modal',
                'quickShopGroupMediaByVariant' => true,
                'quickShopGroupByOption' => 'Color',
                'pcardShowSaleBadge' => true,
                'pcardShowBundleBadge' => true,
                'pcardShowBestSellerBadge' => true,
                'pcardShowNewBadge' => true,
                'pcardShowOutOfStockBadge' => false,

                // ── Newsletter Popup (newsletter.ts) ─────────────────────
                'newsletterPopupEnabled' => true,
                'newsletterPopupType' => 'popup',
                'newsletterPopupDelay' => 5,
                'newsletterPopupHomeOnly' => true,
                'newsletterPopupAllowDismiss' => false,
                'newsletterPopupPosition' => 'bottom-left',
                'newsletterPopupImage' => [
                    'id' => 'gid://shopify/MediaImage/0',
                    'altText' => 'Newsletter signup',
                    'url' => 'https://cdn.shopify.com/s/files/1/0838/0052/3057/files/banner_1.jpg',
                    'width' => 600,
                    'height' => 800,
                ],
                'newsletterPopupImagePosition' => 'top',
                'newsletterPopupHeading' => 'Stay in the loop!',
                'newsletterPopupDescription' => 'Subscribe to our newsletter and get exclusive offers, new product updates, and more.',
                'newsletterPopupButtonText' => 'Get 15% Off Your First Order',

                // ── Search (search.ts) ───────────────────────────────────
                'popularSearchKeywords' => 'sunglasses, hats, jackets, shoes',

                // ── Cart (cart.ts) ───────────────────────────────────────
                'enableCartNote' => true,
                'cartNoteButtonText' => 'Add a note',
                'enableDiscountCode' => true,
                'discountCodeButtonText' => 'Add a discount code',
                'enableGiftCard' => true,
                'giftCardButtonText' => 'Redeem a gift card',
                'checkoutButtonText' => 'Continue to Checkout',

                // ── Footer (footer.ts) ───────────────────────────────────
                'footerWidth' => 'fixed',
                'socialInstagram' => 'https://www.instagram.com/',
                'socialX' => 'https://x.com/',
                'socialLinkedIn' => 'https://www.linkedin.com/',
                'socialFacebook' => 'https://www.facebook.com/',
                'addressTitle' => 'OUR SHOP',
                'storeAddress' => '301 Front St W, Toronto, ON M5V 2T6, Canada',
                'storeEmail' => 'contact@my-store.com',
                'newsletterTitle' => 'STAY IN TOUCH',
                'newsletterDescription' => 'News and inspiration in your inbox, every week.',
                'newsletterPlaceholder' => 'Please enter your email',
                'newsletterButtonText' => 'Subscribe',
                'newsletterInputWidth' => 450,
                'copyright' => '© 2024 Weaverse. All rights reserved.',
                'showPaymentMethods' => false,
                'showAmazonPay' => true,
                'showPayPal' => true,
                'showKlarna' => false,
                'showGooglePay' => true,
                'showApplePay' => true,
                'showJCB' => false,
                'showAmericanExpress' => true,
                'showVisa' => true,
                'showMastercard' => true,
                'showDiners' => false,
                'showDiscover' => false,
                'showAlipay' => false,
                'footerBgColor' => '#000000',
                'footerText' => '#ffffff',
            ],
        ]);
    }
}
