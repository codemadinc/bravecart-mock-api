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
    }
}
