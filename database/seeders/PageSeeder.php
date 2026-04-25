<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::create([
            'store_id' => 1,
            'title' => 'About Us',
            'handle' => 'about',
            'body_html' => '<h2>Our Story</h2><p>Pilot Demo Store was founded in 2020 with a simple mission: create timeless, well-made clothing that respects both people and planet.</p><p>We believe in quality over quantity. Every piece in our collection is designed to last — not just in durability, but in style. We work with small, family-run factories in Portugal, Japan, and Italy who share our commitment to craftsmanship.</p><h2>Our Values</h2><p><strong>Quality First:</strong> We use the finest materials and construction techniques to create products that improve with age.</p><p><strong>Sustainability:</strong> From organic cotton to vegetable-tanned leather, we choose materials that minimize environmental impact.</p><p><strong>Transparency:</strong> We believe you should know where your clothes come from and who made them.</p>',
            'seo' => ['title' => 'About Us | Pilot Demo Store', 'description' => 'Learn about our story, values, and commitment to quality.'],
        ]);

        Page::create([
            'store_id' => 1,
            'title' => 'Contact Us',
            'handle' => 'contact',
            'body_html' => '<h2>Get in Touch</h2><p>We\'d love to hear from you. Whether you have a question about our products, need help with an order, or just want to say hello — we\'re here to help.</p><p><strong>Email:</strong> hello@pilotdemo.store</p><p><strong>Phone:</strong> +1 (555) 123-4567</p><p><strong>Hours:</strong> Monday – Friday, 9am – 5pm EST</p><h2>Visit Us</h2><p>123 Fashion Avenue<br>New York, NY 10001<br>United States</p>',
            'seo' => ['title' => 'Contact Us | Pilot Demo Store', 'description' => 'Get in touch with our team.'],
        ]);

        Page::create([
            'store_id' => 1,
            'title' => 'Frequently Asked Questions',
            'handle' => 'faq',
            'body_html' => '<h2>Orders & Shipping</h2><p><strong>How long does shipping take?</strong><br>Standard shipping takes 5-7 business days within the US. Express shipping (2-3 business days) is available at checkout. International orders typically arrive within 10-14 business days.</p><p><strong>Do you ship internationally?</strong><br>Yes! We ship to over 40 countries. International shipping rates and delivery times vary by destination and are calculated at checkout.</p><p><strong>Can I track my order?</strong><br>Absolutely. You\'ll receive a tracking number via email once your order ships. You can also check your order status in your account dashboard.</p><h2>Returns & Exchanges</h2><p><strong>What is your return policy?</strong><br>We offer free returns within 30 days of delivery. Items must be unworn, unwashed, and in original packaging with tags attached.</p><p><strong>How do I start a return?</strong><br>Log into your account, go to your order history, and select "Start Return" next to the item. You\'ll receive a prepaid shipping label via email.</p><p><strong>Can I exchange an item for a different size?</strong><br>Yes. Start a return for the original item and place a new order for the correct size. This ensures the fastest processing time.</p><h2>Products</h2><p><strong>How do I find my size?</strong><br>Each product page includes a detailed size guide. If you\'re between sizes, we generally recommend sizing up for a more relaxed fit or sizing down for a slimmer fit.</p><p><strong>Are your products sustainable?</strong><br>We\'re committed to sustainability. Over 80% of our products are made from organic, recycled, or responsibly sourced materials. Check individual product pages for specific material information.</p>',
            'seo' => ['title' => 'FAQ | Pilot Demo Store', 'description' => 'Frequently asked questions about orders, shipping, returns, and products.'],
        ]);

        Page::create([
            'store_id' => 1,
            'title' => 'Shipping Information',
            'handle' => 'shipping-info',
            'body_html' => '<h2>Domestic Shipping (United States)</h2><p><strong>Standard Shipping:</strong> Free on orders over $100. Otherwise $8.95. Delivery in 5-7 business days.</p><p><strong>Express Shipping:</strong> $14.95. Delivery in 2-3 business days.</p><p><strong>Next Day Shipping:</strong> $24.95. Order by 2pm EST for next business day delivery.</p><h2>International Shipping</h2><p>We ship to over 40 countries worldwide. International shipping rates are calculated at checkout based on destination and package weight.</p><p><strong>Estimated delivery times:</strong></p><p>Canada: 7-10 business days<br>Europe: 10-14 business days<br>Australia/New Zealand: 12-16 business days<br>Rest of World: 14-21 business days</p><h2>Order Processing</h2><p>Orders placed before 2pm EST Monday-Friday are processed the same day. Orders placed after 2pm or on weekends are processed the next business day.</p><h2>Duties & Taxes</h2><p>International orders may be subject to import duties and taxes, which are the responsibility of the recipient. These charges are determined by your local customs office and are not included in our shipping rates.</p>',
            'seo' => ['title' => 'Shipping Information | Pilot Demo Store', 'description' => 'Shipping rates, delivery times, and international shipping details.'],
        ]);
    }
}
