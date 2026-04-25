<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // ─── 1. Classic Oxford Shirt ─────────────────────────────────
            [
                'title' => 'Classic Oxford Shirt',
                'handle' => 'classic-oxford-shirt',
                'description' => 'A timeless oxford shirt crafted from premium cotton. Perfect for both casual and formal occasions.',
                'description_html' => '<p>A timeless oxford shirt crafted from premium cotton. Perfect for both casual and formal occasions.</p><ul><li>100% organic cotton</li><li>Button-down collar</li><li>Regular fit</li><li>Machine washable</li></ul>',
                'product_type' => 'Shirts',
                'vendor' => 'Pilot Apparel',
                'tags' => ['cotton', 'formal', 'casual', 'bestseller'],
                'images' => [
                    ['id' => 'img_1_1', 'url' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=800&h=1000&fit=crop', 'altText' => 'Classic Oxford Shirt - Front', 'width' => 800, 'height' => 1000],
                    ['id' => 'img_1_2', 'url' => 'https://images.unsplash.com/photo-1598033129183-c4f50c736c10?w=800&h=1000&fit=crop', 'altText' => 'Classic Oxford Shirt - Detail', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['S', 'M', 'L', 'XL']],
                    ['name' => 'Color', 'values' => ['White', 'Light Blue', 'Navy']],
                ],
                'seo' => ['title' => 'Classic Oxford Shirt | Pilot Demo Store', 'description' => 'Premium cotton oxford shirt for every occasion.'],
                'price_min' => 79.00,
                'price_max' => 79.00,
                'compare_at_price_min' => 99.00,
                'compare_at_price_max' => 99.00,
                'variants' => [
                    ['title' => 'S / White', 'sku' => 'OXF-S-WHT', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'S'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => 'M / White', 'sku' => 'OXF-M-WHT', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => 'L / White', 'sku' => 'OXF-L-WHT', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => 'XL / White', 'sku' => 'OXF-XL-WHT', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'XL'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => 'S / Light Blue', 'sku' => 'OXF-S-LBL', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'S'], ['name' => 'Color', 'value' => 'Light Blue']]],
                    ['title' => 'M / Light Blue', 'sku' => 'OXF-M-LBL', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Light Blue']]],
                    ['title' => 'L / Light Blue', 'sku' => 'OXF-L-LBL', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Light Blue']]],
                    ['title' => 'S / Navy', 'sku' => 'OXF-S-NAV', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'S'], ['name' => 'Color', 'value' => 'Navy']]],
                    ['title' => 'M / Navy', 'sku' => 'OXF-M-NAV', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Navy']]],
                    ['title' => 'L / Navy', 'sku' => 'OXF-L-NAV', 'price' => 79.00, 'compare_at_price' => 99.00, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Navy']]],
                ],
            ],
            // ─── 2. Merino Wool Sweater ──────────────────────────────────
            [
                'title' => 'Merino Wool Sweater',
                'handle' => 'merino-wool-sweater',
                'description' => 'Luxuriously soft merino wool sweater with a relaxed fit. Temperature regulating and naturally odor-resistant.',
                'description_html' => '<p>Luxuriously soft merino wool sweater with a relaxed fit. Temperature regulating and naturally odor-resistant.</p>',
                'product_type' => 'Sweaters',
                'vendor' => 'Pilot Apparel',
                'tags' => ['wool', 'winter', 'premium'],
                'images' => [
                    ['id' => 'img_2_1', 'url' => 'https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=800&h=1000&fit=crop', 'altText' => 'Merino Wool Sweater', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['S', 'M', 'L', 'XL']],
                    ['name' => 'Color', 'values' => ['Charcoal', 'Oatmeal', 'Forest Green']],
                ],
                'seo' => ['title' => 'Merino Wool Sweater | Pilot Demo Store', 'description' => 'Premium merino wool sweater for cold weather.'],
                'price_min' => 129.00,
                'price_max' => 129.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => 'S / Charcoal', 'sku' => 'MWS-S-CHR', 'price' => 129.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'S'], ['name' => 'Color', 'value' => 'Charcoal']]],
                    ['title' => 'M / Charcoal', 'sku' => 'MWS-M-CHR', 'price' => 129.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Charcoal']]],
                    ['title' => 'L / Charcoal', 'sku' => 'MWS-L-CHR', 'price' => 129.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Charcoal']]],
                    ['title' => 'M / Oatmeal', 'sku' => 'MWS-M-OAT', 'price' => 129.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Oatmeal']]],
                    ['title' => 'L / Forest Green', 'sku' => 'MWS-L-FGR', 'price' => 129.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Forest Green']]],
                ],
            ],
            // ─── 3. Slim Fit Chinos ──────────────────────────────────────
            [
                'title' => 'Slim Fit Chinos',
                'handle' => 'slim-fit-chinos',
                'description' => 'Modern slim fit chinos with stretch comfort. A wardrobe essential that transitions seamlessly from office to weekend.',
                'description_html' => '<p>Modern slim fit chinos with stretch comfort. A wardrobe essential that transitions seamlessly from office to weekend.</p>',
                'product_type' => 'Pants',
                'vendor' => 'Pilot Apparel',
                'tags' => ['pants', 'casual', 'stretch'],
                'images' => [
                    ['id' => 'img_3_1', 'url' => 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=800&h=1000&fit=crop', 'altText' => 'Slim Fit Chinos', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['30', '32', '34', '36']],
                    ['name' => 'Color', 'values' => ['Khaki', 'Navy', 'Olive']],
                ],
                'seo' => ['title' => 'Slim Fit Chinos | Pilot Demo Store', 'description' => 'Comfortable stretch chinos in a modern slim fit.'],
                'price_min' => 89.00,
                'price_max' => 89.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => '32 / Khaki', 'sku' => 'CHI-32-KHK', 'price' => 89.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '32'], ['name' => 'Color', 'value' => 'Khaki']]],
                    ['title' => '34 / Khaki', 'sku' => 'CHI-34-KHK', 'price' => 89.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '34'], ['name' => 'Color', 'value' => 'Khaki']]],
                    ['title' => '32 / Navy', 'sku' => 'CHI-32-NAV', 'price' => 89.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '32'], ['name' => 'Color', 'value' => 'Navy']]],
                    ['title' => '34 / Navy', 'sku' => 'CHI-34-NAV', 'price' => 89.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '34'], ['name' => 'Color', 'value' => 'Navy']]],
                    ['title' => '32 / Olive', 'sku' => 'CHI-32-OLV', 'price' => 89.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '32'], ['name' => 'Color', 'value' => 'Olive']]],
                    ['title' => '34 / Olive', 'sku' => 'CHI-34-OLV', 'price' => 89.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '34'], ['name' => 'Color', 'value' => 'Olive']]],
                ],
            ],
            // ─── 4. Leather Weekend Bag ──────────────────────────────────
            [
                'title' => 'Leather Weekend Bag',
                'handle' => 'leather-weekend-bag',
                'description' => 'Full-grain leather weekend bag with brass hardware. Spacious enough for a 3-day trip with dedicated shoe compartment.',
                'description_html' => '<p>Full-grain leather weekend bag with brass hardware. Spacious enough for a 3-day trip with dedicated shoe compartment.</p><ul><li>Full-grain vegetable-tanned leather</li><li>Brass YKK zippers</li><li>Cotton canvas lining</li><li>Shoe compartment</li></ul>',
                'product_type' => 'Bags',
                'vendor' => 'Pilot Leather Co.',
                'tags' => ['leather', 'travel', 'premium', 'handcrafted'],
                'images' => [
                    ['id' => 'img_4_1', 'url' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&h=1000&fit=crop', 'altText' => 'Leather Weekend Bag', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Color', 'values' => ['Cognac', 'Black']],
                ],
                'seo' => ['title' => 'Leather Weekend Bag | Pilot Demo Store', 'description' => 'Handcrafted full-grain leather weekend bag.'],
                'price_min' => 349.00,
                'price_max' => 349.00,
                'compare_at_price_min' => 449.00,
                'compare_at_price_max' => 449.00,
                'variants' => [
                    ['title' => 'Cognac', 'sku' => 'LWB-COG', 'price' => 349.00, 'compare_at_price' => 449.00, 'selected_options' => [['name' => 'Color', 'value' => 'Cognac']]],
                    ['title' => 'Black', 'sku' => 'LWB-BLK', 'price' => 349.00, 'compare_at_price' => 449.00, 'selected_options' => [['name' => 'Color', 'value' => 'Black']]],
                ],
            ],
            // ─── 5. Canvas Sneakers ──────────────────────────────────────
            [
                'title' => 'Canvas Sneakers',
                'handle' => 'canvas-sneakers',
                'description' => 'Minimalist canvas sneakers with vulcanized rubber sole. The perfect everyday shoe.',
                'description_html' => '<p>Minimalist canvas sneakers with vulcanized rubber sole. The perfect everyday shoe.</p>',
                'product_type' => 'Shoes',
                'vendor' => 'Pilot Footwear',
                'tags' => ['shoes', 'casual', 'canvas'],
                'images' => [
                    ['id' => 'img_5_1', 'url' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?w=800&h=1000&fit=crop', 'altText' => 'Canvas Sneakers', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['8', '9', '10', '11', '12']],
                    ['name' => 'Color', 'values' => ['White', 'Black']],
                ],
                'seo' => ['title' => 'Canvas Sneakers | Pilot Demo Store', 'description' => 'Minimalist canvas sneakers for everyday wear.'],
                'price_min' => 65.00,
                'price_max' => 65.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => '9 / White', 'sku' => 'CNV-9-WHT', 'price' => 65.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '9'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => '10 / White', 'sku' => 'CNV-10-WHT', 'price' => 65.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '10'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => '11 / White', 'sku' => 'CNV-11-WHT', 'price' => 65.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '11'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => '9 / Black', 'sku' => 'CNV-9-BLK', 'price' => 65.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '9'], ['name' => 'Color', 'value' => 'Black']]],
                    ['title' => '10 / Black', 'sku' => 'CNV-10-BLK', 'price' => 65.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '10'], ['name' => 'Color', 'value' => 'Black']]],
                ],
            ],
            // ─── 6. Organic Cotton T-Shirt ───────────────────────────────
            [
                'title' => 'Organic Cotton T-Shirt',
                'handle' => 'organic-cotton-tshirt',
                'description' => 'Essential crew neck t-shirt made from 100% organic cotton. Garment-dyed for a lived-in feel from day one.',
                'description_html' => '<p>Essential crew neck t-shirt made from 100% organic cotton. Garment-dyed for a lived-in feel from day one.</p>',
                'product_type' => 'T-Shirts',
                'vendor' => 'Pilot Apparel',
                'tags' => ['organic', 'cotton', 'essential', 'bestseller'],
                'images' => [
                    ['id' => 'img_6_1', 'url' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=1000&fit=crop', 'altText' => 'Organic Cotton T-Shirt', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['XS', 'S', 'M', 'L', 'XL']],
                    ['name' => 'Color', 'values' => ['White', 'Black', 'Sage', 'Dusty Rose']],
                ],
                'seo' => ['title' => 'Organic Cotton T-Shirt | Pilot Demo Store', 'description' => 'Essential organic cotton crew neck t-shirt.'],
                'price_min' => 39.00,
                'price_max' => 39.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => 'S / White', 'sku' => 'OCT-S-WHT', 'price' => 39.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'S'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => 'M / White', 'sku' => 'OCT-M-WHT', 'price' => 39.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => 'L / White', 'sku' => 'OCT-L-WHT', 'price' => 39.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'White']]],
                    ['title' => 'M / Black', 'sku' => 'OCT-M-BLK', 'price' => 39.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Black']]],
                    ['title' => 'M / Sage', 'sku' => 'OCT-M-SAG', 'price' => 39.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Sage']]],
                    ['title' => 'M / Dusty Rose', 'sku' => 'OCT-M-DSR', 'price' => 39.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Dusty Rose']]],
                ],
            ],
            // ─── 7. Denim Jacket ─────────────────────────────────────────
            [
                'title' => 'Denim Jacket',
                'handle' => 'denim-jacket',
                'description' => 'Classic denim jacket with a modern fit. Selvedge denim from Japan, washed for a perfectly broken-in look.',
                'description_html' => '<p>Classic denim jacket with a modern fit. Selvedge denim from Japan, washed for a perfectly broken-in look.</p>',
                'product_type' => 'Jackets',
                'vendor' => 'Pilot Apparel',
                'tags' => ['denim', 'outerwear', 'japanese'],
                'images' => [
                    ['id' => 'img_7_1', 'url' => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=800&h=1000&fit=crop', 'altText' => 'Denim Jacket', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['S', 'M', 'L', 'XL']],
                ],
                'seo' => ['title' => 'Denim Jacket | Pilot Demo Store', 'description' => 'Japanese selvedge denim jacket.'],
                'price_min' => 189.00,
                'price_max' => 189.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => 'S', 'sku' => 'DNM-S', 'price' => 189.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'S']]],
                    ['title' => 'M', 'sku' => 'DNM-M', 'price' => 189.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M']]],
                    ['title' => 'L', 'sku' => 'DNM-L', 'price' => 189.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'L']]],
                    ['title' => 'XL', 'sku' => 'DNM-XL', 'price' => 189.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'XL']]],
                ],
            ],
            // ─── 8. Leather Belt ─────────────────────────────────────────
            [
                'title' => 'Leather Belt',
                'handle' => 'leather-belt',
                'description' => 'Handcrafted Italian leather belt with a brushed nickel buckle. Ages beautifully over time.',
                'description_html' => '<p>Handcrafted Italian leather belt with a brushed nickel buckle. Ages beautifully over time.</p>',
                'product_type' => 'Accessories',
                'vendor' => 'Pilot Leather Co.',
                'tags' => ['leather', 'accessories', 'italian'],
                'images' => [
                    ['id' => 'img_8_1', 'url' => 'https://images.unsplash.com/photo-1624222247344-550fb60583dc?w=800&h=800&fit=crop', 'altText' => 'Leather Belt', 'width' => 800, 'height' => 800],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['30', '32', '34', '36', '38']],
                    ['name' => 'Color', 'values' => ['Brown', 'Black']],
                ],
                'seo' => ['title' => 'Leather Belt | Pilot Demo Store', 'description' => 'Italian leather belt with brushed nickel buckle.'],
                'price_min' => 59.00,
                'price_max' => 59.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => '32 / Brown', 'sku' => 'BLT-32-BRN', 'price' => 59.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '32'], ['name' => 'Color', 'value' => 'Brown']]],
                    ['title' => '34 / Brown', 'sku' => 'BLT-34-BRN', 'price' => 59.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '34'], ['name' => 'Color', 'value' => 'Brown']]],
                    ['title' => '36 / Brown', 'sku' => 'BLT-36-BRN', 'price' => 59.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '36'], ['name' => 'Color', 'value' => 'Brown']]],
                    ['title' => '32 / Black', 'sku' => 'BLT-32-BLK', 'price' => 59.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '32'], ['name' => 'Color', 'value' => 'Black']]],
                    ['title' => '34 / Black', 'sku' => 'BLT-34-BLK', 'price' => 59.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '34'], ['name' => 'Color', 'value' => 'Black']]],
                ],
            ],
            // ─── 9. Linen Summer Shirt ───────────────────────────────────
            [
                'title' => 'Linen Summer Shirt',
                'handle' => 'linen-summer-shirt',
                'description' => 'Breathable linen shirt perfect for warm weather. Relaxed fit with a camp collar for effortless style.',
                'description_html' => '<p>Breathable linen shirt perfect for warm weather. Relaxed fit with a camp collar for effortless style.</p>',
                'product_type' => 'Shirts',
                'vendor' => 'Pilot Apparel',
                'tags' => ['linen', 'summer', 'casual'],
                'images' => [
                    ['id' => 'img_9_1', 'url' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=800&h=1000&fit=crop', 'altText' => 'Linen Summer Shirt', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['S', 'M', 'L', 'XL']],
                    ['name' => 'Color', 'values' => ['Sand', 'Sky Blue', 'White']],
                ],
                'seo' => ['title' => 'Linen Summer Shirt | Pilot Demo Store', 'description' => 'Breathable linen camp collar shirt.'],
                'price_min' => 95.00,
                'price_max' => 95.00,
                'compare_at_price_min' => 120.00,
                'compare_at_price_max' => 120.00,
                'variants' => [
                    ['title' => 'M / Sand', 'sku' => 'LIN-M-SND', 'price' => 95.00, 'compare_at_price' => 120.00, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Sand']]],
                    ['title' => 'L / Sand', 'sku' => 'LIN-L-SND', 'price' => 95.00, 'compare_at_price' => 120.00, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Sand']]],
                    ['title' => 'M / Sky Blue', 'sku' => 'LIN-M-SKY', 'price' => 95.00, 'compare_at_price' => 120.00, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Sky Blue']]],
                    ['title' => 'L / White', 'sku' => 'LIN-L-WHT', 'price' => 95.00, 'compare_at_price' => 120.00, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'White']]],
                ],
            ],
            // ─── 10. Wool Overcoat ───────────────────────────────────────
            [
                'title' => 'Wool Overcoat',
                'handle' => 'wool-overcoat',
                'description' => 'Tailored wool-blend overcoat with a clean silhouette. Fully lined with interior pockets.',
                'description_html' => '<p>Tailored wool-blend overcoat with a clean silhouette. Fully lined with interior pockets.</p>',
                'product_type' => 'Outerwear',
                'vendor' => 'Pilot Apparel',
                'tags' => ['wool', 'outerwear', 'winter', 'premium'],
                'images' => [
                    ['id' => 'img_10_1', 'url' => 'https://images.unsplash.com/photo-1539533018447-63fcce2678e3?w=800&h=1000&fit=crop', 'altText' => 'Wool Overcoat', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['S', 'M', 'L', 'XL']],
                    ['name' => 'Color', 'values' => ['Camel', 'Charcoal']],
                ],
                'seo' => ['title' => 'Wool Overcoat | Pilot Demo Store', 'description' => 'Tailored wool-blend overcoat.'],
                'price_min' => 299.00,
                'price_max' => 299.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => 'M / Camel', 'sku' => 'WOC-M-CML', 'price' => 299.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Camel']]],
                    ['title' => 'L / Camel', 'sku' => 'WOC-L-CML', 'price' => 299.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Camel']]],
                    ['title' => 'M / Charcoal', 'sku' => 'WOC-M-CHR', 'price' => 299.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Charcoal']]],
                    ['title' => 'L / Charcoal', 'sku' => 'WOC-L-CHR', 'price' => 299.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Charcoal']]],
                ],
            ],
            // ─── 11. Sunglasses - Aviator ────────────────────────────────
            [
                'title' => 'Sunglasses - Aviator',
                'handle' => 'sunglasses-aviator',
                'description' => 'Classic aviator sunglasses with polarized lenses and titanium frame. UV400 protection.',
                'description_html' => '<p>Classic aviator sunglasses with polarized lenses and titanium frame. UV400 protection.</p>',
                'product_type' => 'Accessories',
                'vendor' => 'Pilot Eyewear',
                'tags' => ['sunglasses', 'accessories', 'polarized'],
                'images' => [
                    ['id' => 'img_11_1', 'url' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=800&h=800&fit=crop', 'altText' => 'Aviator Sunglasses', 'width' => 800, 'height' => 800],
                ],
                'options' => [
                    ['name' => 'Lens', 'values' => ['Green', 'Brown', 'Gray']],
                ],
                'seo' => ['title' => 'Aviator Sunglasses | Pilot Demo Store', 'description' => 'Polarized aviator sunglasses with titanium frame.'],
                'price_min' => 149.00,
                'price_max' => 149.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => 'Green', 'sku' => 'AVI-GRN', 'price' => 149.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Lens', 'value' => 'Green']]],
                    ['title' => 'Brown', 'sku' => 'AVI-BRN', 'price' => 149.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Lens', 'value' => 'Brown']]],
                    ['title' => 'Gray', 'sku' => 'AVI-GRY', 'price' => 149.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Lens', 'value' => 'Gray']]],
                ],
            ],
            // ─── 12. Cashmere Scarf ──────────────────────────────────────
            [
                'title' => 'Cashmere Scarf',
                'handle' => 'cashmere-scarf',
                'description' => 'Ultra-soft cashmere scarf woven in Scotland. Lightweight yet warm, with a subtle herringbone pattern.',
                'description_html' => '<p>Ultra-soft cashmere scarf woven in Scotland. Lightweight yet warm, with a subtle herringbone pattern.</p>',
                'product_type' => 'Accessories',
                'vendor' => 'Pilot Apparel',
                'tags' => ['cashmere', 'accessories', 'winter', 'gift'],
                'images' => [
                    ['id' => 'img_12_1', 'url' => 'https://images.unsplash.com/photo-1520903920243-00d872a2d1c9?w=800&h=800&fit=crop', 'altText' => 'Cashmere Scarf', 'width' => 800, 'height' => 800],
                ],
                'options' => [
                    ['name' => 'Color', 'values' => ['Heather Gray', 'Burgundy', 'Navy', 'Camel']],
                ],
                'seo' => ['title' => 'Cashmere Scarf | Pilot Demo Store', 'description' => 'Scottish cashmere scarf with herringbone pattern.'],
                'price_min' => 119.00,
                'price_max' => 119.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => 'Heather Gray', 'sku' => 'CSF-HGR', 'price' => 119.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Color', 'value' => 'Heather Gray']]],
                    ['title' => 'Burgundy', 'sku' => 'CSF-BRG', 'price' => 119.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Color', 'value' => 'Burgundy']]],
                    ['title' => 'Navy', 'sku' => 'CSF-NAV', 'price' => 119.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Color', 'value' => 'Navy']]],
                    ['title' => 'Camel', 'sku' => 'CSF-CML', 'price' => 119.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Color', 'value' => 'Camel']]],
                ],
            ],
            // ─── 13. Relaxed Fit Joggers (NEW) ───────────────────────────
            [
                'title' => 'Relaxed Fit Joggers',
                'handle' => 'relaxed-fit-joggers',
                'description' => 'Premium French terry joggers with a relaxed tapered fit. Ribbed cuffs and an elastic waistband for all-day comfort.',
                'description_html' => '<p>Premium French terry joggers with a relaxed tapered fit. Ribbed cuffs and an elastic waistband for all-day comfort.</p><ul><li>80% cotton, 20% polyester French terry</li><li>Tapered leg with ribbed cuffs</li><li>Side pockets and back welt pocket</li></ul>',
                'product_type' => 'Pants',
                'vendor' => 'Pilot Apparel',
                'tags' => ['joggers', 'casual', 'comfort', 'loungewear'],
                'images' => [
                    ['id' => 'img_13_1', 'url' => 'https://images.unsplash.com/photo-1552902865-b72c031ac5ea?w=800&h=1000&fit=crop', 'altText' => 'Relaxed Fit Joggers', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['S', 'M', 'L', 'XL']],
                    ['name' => 'Color', 'values' => ['Heather Gray', 'Black', 'Navy']],
                ],
                'seo' => ['title' => 'Relaxed Fit Joggers | Pilot Demo Store', 'description' => 'Premium French terry joggers for all-day comfort.'],
                'price_min' => 75.00,
                'price_max' => 75.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => 'S / Heather Gray', 'sku' => 'JOG-S-HGR', 'price' => 75.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'S'], ['name' => 'Color', 'value' => 'Heather Gray']]],
                    ['title' => 'M / Heather Gray', 'sku' => 'JOG-M-HGR', 'price' => 75.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Heather Gray']]],
                    ['title' => 'L / Heather Gray', 'sku' => 'JOG-L-HGR', 'price' => 75.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Heather Gray']]],
                    ['title' => 'M / Black', 'sku' => 'JOG-M-BLK', 'price' => 75.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Black']]],
                    ['title' => 'L / Black', 'sku' => 'JOG-L-BLK', 'price' => 75.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Black']]],
                    ['title' => 'M / Navy', 'sku' => 'JOG-M-NAV', 'price' => 75.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Navy']]],
                ],
            ],
            // ─── 14. Leather Card Holder (NEW) ───────────────────────────
            [
                'title' => 'Leather Card Holder',
                'handle' => 'leather-card-holder',
                'description' => 'Slim leather card holder with four card slots and a center pocket. Made from the same full-grain leather as our weekend bag.',
                'description_html' => '<p>Slim leather card holder with four card slots and a center pocket. Made from the same full-grain leather as our weekend bag.</p>',
                'product_type' => 'Accessories',
                'vendor' => 'Pilot Leather Co.',
                'tags' => ['leather', 'accessories', 'wallet', 'gift', 'bestseller'],
                'images' => [
                    ['id' => 'img_14_1', 'url' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=800&h=800&fit=crop', 'altText' => 'Leather Card Holder', 'width' => 800, 'height' => 800],
                ],
                'options' => [
                    ['name' => 'Color', 'values' => ['Cognac', 'Black', 'Navy']],
                ],
                'seo' => ['title' => 'Leather Card Holder | Pilot Demo Store', 'description' => 'Slim full-grain leather card holder.'],
                'price_min' => 45.00,
                'price_max' => 45.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => 'Cognac', 'sku' => 'LCH-COG', 'price' => 45.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Color', 'value' => 'Cognac']]],
                    ['title' => 'Black', 'sku' => 'LCH-BLK', 'price' => 45.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Color', 'value' => 'Black']]],
                    ['title' => 'Navy', 'sku' => 'LCH-NAV', 'price' => 45.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Color', 'value' => 'Navy']]],
                ],
            ],
            // ─── 15. Heavyweight Hoodie (NEW) ────────────────────────────
            [
                'title' => 'Heavyweight Hoodie',
                'handle' => 'heavyweight-hoodie',
                'description' => 'Oversized heavyweight hoodie in 450gsm cotton. Double-layered hood, kangaroo pocket, and ribbed trims.',
                'description_html' => '<p>Oversized heavyweight hoodie in 450gsm cotton. Double-layered hood, kangaroo pocket, and ribbed trims.</p><ul><li>100% cotton, 450gsm</li><li>Oversized fit</li><li>Garment-dyed</li><li>YKK zipper on pocket (optional)</li></ul>',
                'product_type' => 'Sweaters',
                'vendor' => 'Pilot Apparel',
                'tags' => ['hoodie', 'streetwear', 'heavyweight', 'cotton'],
                'images' => [
                    ['id' => 'img_15_1', 'url' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&h=1000&fit=crop', 'altText' => 'Heavyweight Hoodie', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['S', 'M', 'L', 'XL', 'XXL']],
                    ['name' => 'Color', 'values' => ['Washed Black', 'Cream', 'Slate']],
                ],
                'seo' => ['title' => 'Heavyweight Hoodie | Pilot Demo Store', 'description' => 'Oversized 450gsm cotton hoodie.'],
                'price_min' => 110.00,
                'price_max' => 110.00,
                'compare_at_price_min' => 140.00,
                'compare_at_price_max' => 140.00,
                'variants' => [
                    ['title' => 'M / Washed Black', 'sku' => 'HWH-M-WBK', 'price' => 110.00, 'compare_at_price' => 140.00, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Washed Black']]],
                    ['title' => 'L / Washed Black', 'sku' => 'HWH-L-WBK', 'price' => 110.00, 'compare_at_price' => 140.00, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Washed Black']]],
                    ['title' => 'XL / Washed Black', 'sku' => 'HWH-XL-WBK', 'price' => 110.00, 'compare_at_price' => 140.00, 'selected_options' => [['name' => 'Size', 'value' => 'XL'], ['name' => 'Color', 'value' => 'Washed Black']]],
                    ['title' => 'M / Cream', 'sku' => 'HWH-M-CRM', 'price' => 110.00, 'compare_at_price' => 140.00, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Cream']]],
                    ['title' => 'L / Cream', 'sku' => 'HWH-L-CRM', 'price' => 110.00, 'compare_at_price' => 140.00, 'selected_options' => [['name' => 'Size', 'value' => 'L'], ['name' => 'Color', 'value' => 'Cream']]],
                    ['title' => 'M / Slate', 'sku' => 'HWH-M-SLT', 'price' => 110.00, 'compare_at_price' => 140.00, 'selected_options' => [['name' => 'Size', 'value' => 'M'], ['name' => 'Color', 'value' => 'Slate']]],
                ],
            ],
            // ─── 16. Suede Chelsea Boots (NEW) ───────────────────────────
            [
                'title' => 'Suede Chelsea Boots',
                'handle' => 'suede-chelsea-boots',
                'description' => 'Italian suede Chelsea boots with a Goodyear-welted sole. A refined boot that pairs with everything from denim to tailoring.',
                'description_html' => '<p>Italian suede Chelsea boots with a Goodyear-welted sole. A refined boot that pairs with everything from denim to tailoring.</p><ul><li>Italian suede upper</li><li>Goodyear-welted leather sole</li><li>Elastic side panels</li><li>Pull tab</li></ul>',
                'product_type' => 'Shoes',
                'vendor' => 'Pilot Footwear',
                'tags' => ['boots', 'suede', 'premium', 'italian'],
                'images' => [
                    ['id' => 'img_16_1', 'url' => 'https://images.unsplash.com/photo-1638247025967-b4e38f787b76?w=800&h=1000&fit=crop', 'altText' => 'Suede Chelsea Boots', 'width' => 800, 'height' => 1000],
                ],
                'options' => [
                    ['name' => 'Size', 'values' => ['8', '9', '10', '11', '12']],
                    ['name' => 'Color', 'values' => ['Sand', 'Dark Brown']],
                ],
                'seo' => ['title' => 'Suede Chelsea Boots | Pilot Demo Store', 'description' => 'Italian suede Chelsea boots with Goodyear-welted sole.'],
                'price_min' => 265.00,
                'price_max' => 265.00,
                'compare_at_price_min' => null,
                'compare_at_price_max' => null,
                'variants' => [
                    ['title' => '9 / Sand', 'sku' => 'SCB-9-SND', 'price' => 265.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '9'], ['name' => 'Color', 'value' => 'Sand']]],
                    ['title' => '10 / Sand', 'sku' => 'SCB-10-SND', 'price' => 265.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '10'], ['name' => 'Color', 'value' => 'Sand']]],
                    ['title' => '11 / Sand', 'sku' => 'SCB-11-SND', 'price' => 265.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '11'], ['name' => 'Color', 'value' => 'Sand']]],
                    ['title' => '9 / Dark Brown', 'sku' => 'SCB-9-DBR', 'price' => 265.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '9'], ['name' => 'Color', 'value' => 'Dark Brown']]],
                    ['title' => '10 / Dark Brown', 'sku' => 'SCB-10-DBR', 'price' => 265.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '10'], ['name' => 'Color', 'value' => 'Dark Brown']]],
                    ['title' => '11 / Dark Brown', 'sku' => 'SCB-11-DBR', 'price' => 265.00, 'compare_at_price' => null, 'selected_options' => [['name' => 'Size', 'value' => '11'], ['name' => 'Color', 'value' => 'Dark Brown']]],
                ],
            ],
        ];

        foreach ($products as $productData) {
            $variants = $productData['variants'];
            unset($productData['variants']);

            $productData['store_id'] = 1;
            $product = Product::create($productData);

            foreach ($variants as $variantData) {
                $variantData['product_id'] = $product->id;
                ProductVariant::create($variantData);
            }
        }
    }
}
