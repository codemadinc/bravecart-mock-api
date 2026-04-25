<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Header menu
        Menu::create([
            'store_id' => 1,
            'handle' => 'header',
            'title' => 'Main Menu',
            'items' => [
                [
                    'id' => 'gid://bravecart/MenuItem/1',
                    'title' => 'Shop',
                    'type' => 'HTTP',
                    'url' => '/collections',
                    'items' => [
                        [
                            'id' => 'gid://bravecart/MenuItem/2',
                            'title' => 'New Arrivals',
                            'type' => 'HTTP',
                            'url' => '/collections/new-arrivals',
                            'items' => [],
                        ],
                        [
                            'id' => 'gid://bravecart/MenuItem/3',
                            'title' => 'Bestsellers',
                            'type' => 'HTTP',
                            'url' => '/collections/bestsellers',
                            'items' => [],
                        ],
                        [
                            'id' => 'gid://bravecart/MenuItem/4',
                            'title' => 'Tops',
                            'type' => 'HTTP',
                            'url' => '/collections/tops',
                            'items' => [],
                        ],
                        [
                            'id' => 'gid://bravecart/MenuItem/5',
                            'title' => 'Bottoms',
                            'type' => 'HTTP',
                            'url' => '/collections/bottoms',
                            'items' => [],
                        ],
                        [
                            'id' => 'gid://bravecart/MenuItem/6',
                            'title' => 'Outerwear',
                            'type' => 'HTTP',
                            'url' => '/collections/outerwear',
                            'items' => [],
                        ],
                        [
                            'id' => 'gid://bravecart/MenuItem/7',
                            'title' => 'Footwear',
                            'type' => 'HTTP',
                            'url' => '/collections/footwear',
                            'items' => [],
                        ],
                        [
                            'id' => 'gid://bravecart/MenuItem/8',
                            'title' => 'Accessories',
                            'type' => 'HTTP',
                            'url' => '/collections/accessories',
                            'items' => [],
                        ],
                        [
                            'id' => 'gid://bravecart/MenuItem/9',
                            'title' => 'Sale',
                            'type' => 'HTTP',
                            'url' => '/collections/sale',
                            'items' => [],
                        ],
                    ],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/10',
                    'title' => 'Collections',
                    'type' => 'HTTP',
                    'url' => '/collections',
                    'items' => [],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/11',
                    'title' => 'About',
                    'type' => 'HTTP',
                    'url' => '/pages/about',
                    'items' => [],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/12',
                    'title' => 'Journal',
                    'type' => 'HTTP',
                    'url' => '/blogs/journal',
                    'items' => [],
                ],
            ],
        ]);

        // Footer menu
        Menu::create([
            'store_id' => 1,
            'handle' => 'footer',
            'title' => 'Footer Menu',
            'items' => [
                [
                    'id' => 'gid://bravecart/MenuItem/20',
                    'title' => 'About Us',
                    'type' => 'HTTP',
                    'url' => '/pages/about',
                    'items' => [],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/21',
                    'title' => 'Contact',
                    'type' => 'HTTP',
                    'url' => '/pages/contact',
                    'items' => [],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/22',
                    'title' => 'FAQ',
                    'type' => 'HTTP',
                    'url' => '/pages/faq',
                    'items' => [],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/23',
                    'title' => 'Shipping Info',
                    'type' => 'HTTP',
                    'url' => '/pages/shipping-info',
                    'items' => [],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/24',
                    'title' => 'Shipping Policy',
                    'type' => 'HTTP',
                    'url' => '/policies/shipping-policy',
                    'items' => [],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/25',
                    'title' => 'Return Policy',
                    'type' => 'HTTP',
                    'url' => '/policies/refund-policy',
                    'items' => [],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/26',
                    'title' => 'Privacy Policy',
                    'type' => 'HTTP',
                    'url' => '/policies/privacy-policy',
                    'items' => [],
                ],
                [
                    'id' => 'gid://bravecart/MenuItem/27',
                    'title' => 'Terms of Service',
                    'type' => 'HTTP',
                    'url' => '/policies/terms-of-service',
                    'items' => [],
                ],
            ],
        ]);
    }
}
