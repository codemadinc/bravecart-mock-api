<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Article;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blog = Blog::create([
            'store_id' => 1,
            'title' => 'Journal',
            'handle' => 'journal',
            'seo' => ['title' => 'Journal | Pilot Demo Store', 'description' => 'Stories, guides, and inspiration.'],
        ]);

        $articles = [
            [
                'title' => 'The Art of Capsule Wardrobes',
                'handle' => 'the-art-of-capsule-wardrobes',
                'excerpt' => 'Learn how to build a versatile wardrobe with fewer, better pieces that work together effortlessly.',
                'content_html' => '<h2>Less is More</h2><p>A capsule wardrobe is a curated collection of essential items that don\'t go out of fashion. The idea is to have a small number of versatile pieces that can be mixed and matched to create a variety of outfits.</p><h2>Getting Started</h2><p>Start by identifying your personal style. Look at what you wear most often and what makes you feel confident. Then, invest in quality basics that form the foundation of your wardrobe.</p><h2>The Essential Pieces</h2><p>Every capsule wardrobe should include: a well-fitted white shirt, quality denim, a versatile blazer, comfortable sneakers, and a leather bag that ages beautifully.</p>',
                'author_name' => 'Sarah Chen',
                'image_url' => 'https://images.unsplash.com/photo-1558171813-4c088753af8f?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Capsule wardrobe essentials laid out',
                'tags' => ['style', 'wardrobe', 'guide'],
                'seo' => ['title' => 'The Art of Capsule Wardrobes', 'description' => 'Build a versatile wardrobe with fewer, better pieces.'],
                'published_at' => '2026-04-10 10:00:00',
            ],
            [
                'title' => 'Sustainable Fashion: Our Commitment',
                'handle' => 'sustainable-fashion-our-commitment',
                'excerpt' => 'How we\'re working to reduce our environmental impact while creating beautiful, lasting products.',
                'content_html' => '<h2>Our Journey</h2><p>Sustainability isn\'t a destination — it\'s a journey. At Pilot Demo Store, we\'re committed to making better choices at every step of our supply chain.</p><h2>Materials Matter</h2><p>We source organic cotton, responsibly harvested wool, and vegetable-tanned leather. Each material is chosen not just for quality, but for its environmental footprint.</p><h2>Looking Ahead</h2><p>By 2027, we aim to have 100% of our products made from sustainable or recycled materials. We\'re also investing in circular fashion programs to give our products a second life.</p>',
                'author_name' => 'James Park',
                'image_url' => 'https://images.unsplash.com/photo-1532453288672-3a27e9be9efd?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Sustainable fashion materials',
                'tags' => ['sustainability', 'environment', 'values'],
                'seo' => ['title' => 'Sustainable Fashion: Our Commitment', 'description' => 'Our approach to sustainable and ethical fashion.'],
                'published_at' => '2026-03-28 14:00:00',
            ],
            [
                'title' => 'Spring/Summer 2026 Lookbook',
                'handle' => 'spring-summer-2026-lookbook',
                'excerpt' => 'Explore our latest collection inspired by Mediterranean summers and coastal living.',
                'content_html' => '<h2>Mediterranean Inspiration</h2><p>This season, we drew inspiration from the sun-drenched coastlines of southern Europe. Think relaxed silhouettes, natural fabrics, and a palette of sand, sea, and sky.</p><h2>Key Pieces</h2><p>The linen camp collar shirt is the hero of this collection, paired with our new slim-fit chinos in olive and khaki. For cooler evenings, layer with the lightweight merino wool sweater.</p>',
                'author_name' => 'Maria Santos',
                'image_url' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Spring Summer 2026 Lookbook',
                'tags' => ['lookbook', 'spring', 'summer', 'collection'],
                'seo' => ['title' => 'Spring/Summer 2026 Lookbook', 'description' => 'Our latest collection inspired by Mediterranean summers.'],
                'published_at' => '2026-04-01 09:00:00',
            ],
        ];

        foreach ($articles as $articleData) {
            $articleData['blog_id'] = $blog->id;
            Article::create($articleData);
        }
    }
}
