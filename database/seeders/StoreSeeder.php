<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        Store::create([
            'id' => 1,
            'name' => 'Pilot Demo Store',
            'handle' => 'pilot-demo',
            'description' => 'A modern fashion and lifestyle store powered by BraveCart.',
            'domain' => 'localhost',
            'logo_url' => 'https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=200&h=60&fit=crop',
            'currency_code' => 'USD',
            'language_code' => 'en',
        ]);
    }
}
