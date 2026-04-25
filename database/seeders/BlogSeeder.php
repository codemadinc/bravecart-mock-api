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
            [
                'title' => 'How to Care for Leather Goods',
                'handle' => 'how-to-care-for-leather-goods',
                'excerpt' => 'A complete guide to maintaining, cleaning, and conditioning your leather products so they last a lifetime.',
                'content_html' => '<h2>Why Leather Care Matters</h2><p>Quality leather is an investment. With proper care, your leather goods will develop a rich patina and actually improve with age. Neglect them, and they\'ll dry out, crack, and deteriorate.</p><h2>Daily Habits</h2><p>Keep leather away from direct sunlight and heat sources. When not in use, stuff bags with tissue paper to maintain their shape. Wipe down with a soft, dry cloth after each use.</p><h2>Deep Cleaning</h2><p>Every few months, clean your leather with a damp cloth and mild soap. Let it air dry completely before applying conditioner. Never use harsh chemicals or submerge leather in water.</p><h2>Conditioning</h2><p>Apply a quality leather conditioner every 3-6 months. Use a small amount on a soft cloth and work it into the leather in circular motions. This keeps the leather supple and prevents cracking.</p>',
                'author_name' => 'Sarah Chen',
                'image_url' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Leather care products and bag',
                'tags' => ['care', 'leather', 'guide', 'maintenance'],
                'seo' => ['title' => 'How to Care for Leather Goods', 'description' => 'Complete guide to leather care and maintenance.'],
                'published_at' => '2026-03-15 11:00:00',
            ],
            [
                'title' => 'The Rise of Quiet Luxury',
                'handle' => 'the-rise-of-quiet-luxury',
                'excerpt' => 'Why understated elegance is replacing logo-heavy fashion, and how to embrace the quiet luxury movement.',
                'content_html' => '<h2>What is Quiet Luxury?</h2><p>Quiet luxury — also known as stealth wealth — is a fashion philosophy that prioritizes quality, craftsmanship, and subtlety over visible branding and logos. It\'s about knowing the value of what you wear without needing to broadcast it.</p><h2>The Shift</h2><p>After years of maximalist fashion and logo mania, consumers are gravitating toward timeless pieces that speak through fabric quality, perfect tailoring, and thoughtful design details rather than brand names.</p><h2>Building a Quiet Luxury Wardrobe</h2><p>Focus on neutral tones, premium fabrics like cashmere and silk, and impeccable fit. Invest in fewer pieces that can be styled multiple ways. Look for details like hand-stitched seams, quality hardware, and natural materials.</p>',
                'author_name' => 'James Park',
                'image_url' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Minimalist fashion editorial',
                'tags' => ['style', 'luxury', 'trends', 'editorial'],
                'seo' => ['title' => 'The Rise of Quiet Luxury', 'description' => 'Understanding the quiet luxury fashion movement.'],
                'published_at' => '2026-03-05 08:00:00',
            ],
            [
                'title' => 'Behind the Scenes: Our Portugal Factory',
                'handle' => 'behind-the-scenes-portugal-factory',
                'excerpt' => 'Take a look inside the family-run factory in Porto where many of our garments are made.',
                'content_html' => '<h2>A Family Tradition</h2><p>The Ferreira family has been making garments in Porto for three generations. When we first visited their factory in 2021, we knew immediately that this was the kind of partnership we wanted to build.</p><h2>The Process</h2><p>Every shirt starts with pattern cutting by hand. The fabric is laid out on long tables, and experienced cutters use templates that have been refined over decades. From there, each piece moves through a series of specialized stations — collar construction, button placement, seam finishing.</p><h2>Quality at Every Step</h2><p>What sets this factory apart is the inspection process. Every garment is checked at three stages: after cutting, after assembly, and before packaging. The rejection rate is less than 1%, which speaks to the skill of the workers.</p>',
                'author_name' => 'Maria Santos',
                'image_url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Garment factory in Porto',
                'tags' => ['behind-the-scenes', 'manufacturing', 'craftsmanship'],
                'seo' => ['title' => 'Behind the Scenes: Our Portugal Factory', 'description' => 'Inside the family-run factory where our garments are made.'],
                'published_at' => '2026-02-20 10:00:00',
            ],
            [
                'title' => '5 Ways to Style a White Oxford Shirt',
                'handle' => '5-ways-to-style-a-white-oxford-shirt',
                'excerpt' => 'The white oxford shirt is the most versatile piece in any wardrobe. Here are five ways to wear it.',
                'content_html' => '<h2>1. The Classic Business Casual</h2><p>Tuck it into slim-fit chinos with a leather belt and loafers. Roll the sleeves once for a relaxed touch. This look works for the office, client meetings, or a smart dinner.</p><h2>2. Weekend Layering</h2><p>Wear it unbuttoned over a crew neck t-shirt with jeans and sneakers. Leave the tails untucked for an effortless weekend vibe.</p><h2>3. Under a Sweater</h2><p>Layer under a crew neck or V-neck sweater with the collar poking out. This preppy-meets-modern look is perfect for autumn and winter.</p><h2>4. Beach to Bar</h2><p>Pair with linen shorts and sandals during the day, then swap to chinos and loafers for evening. The oxford transitions seamlessly.</p><h2>5. Dressed Up</h2><p>Button it all the way up, tuck into tailored trousers, and add a blazer. No tie needed — the oxford collar provides enough structure on its own.</p>',
                'author_name' => 'Sarah Chen',
                'image_url' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=1200&h=600&fit=crop',
                'image_alt_text' => 'White oxford shirt styling',
                'tags' => ['style', 'guide', 'shirts', 'how-to'],
                'seo' => ['title' => '5 Ways to Style a White Oxford Shirt', 'description' => 'Five versatile ways to wear the classic white oxford.'],
                'published_at' => '2026-02-10 09:00:00',
            ],
            [
                'title' => 'Understanding Fabric: A Beginner\'s Guide',
                'handle' => 'understanding-fabric-beginners-guide',
                'excerpt' => 'Cotton, linen, wool, cashmere — learn what makes each fabric unique and when to wear them.',
                'content_html' => '<h2>Cotton</h2><p>The most versatile fabric in fashion. Cotton is breathable, durable, and easy to care for. Look for organic cotton and higher thread counts for better quality. Our oxford shirts and t-shirts use premium long-staple cotton for a softer hand feel.</p><h2>Linen</h2><p>The ultimate summer fabric. Linen is made from flax fibers and is incredibly breathable. Yes, it wrinkles — but that\'s part of its charm. Embrace the natural texture rather than fighting it.</p><h2>Wool</h2><p>Not just for winter. Merino wool is temperature-regulating, moisture-wicking, and naturally odor-resistant. Fine merino can be worn year-round, while heavier wool blends are ideal for outerwear.</p><h2>Cashmere</h2><p>The luxury fiber. Cashmere comes from the undercoat of cashmere goats and is incredibly soft and warm. It\'s more delicate than wool, so hand washing or dry cleaning is recommended.</p><h2>Leather</h2><p>A material that improves with age. Full-grain leather — where the entire grain surface is intact — is the highest quality. It develops a unique patina over time that tells the story of how it\'s been used.</p>',
                'author_name' => 'James Park',
                'image_url' => 'https://images.unsplash.com/photo-1558171814-2e56aeaa850a?w=1200&h=600&fit=crop',
                'image_alt_text' => 'Various fabric swatches',
                'tags' => ['education', 'fabric', 'guide', 'materials'],
                'seo' => ['title' => 'Understanding Fabric: A Beginner\'s Guide', 'description' => 'Learn about cotton, linen, wool, cashmere, and leather.'],
                'published_at' => '2026-01-25 12:00:00',
            ],
        ];

        foreach ($articles as $articleData) {
            $articleData['blog_id'] = $blog->id;
            Article::create($articleData);
        }
    }
}
