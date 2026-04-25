<?php

namespace Database\Seeders;

use App\Models\Swatch;
use Illuminate\Database\Seeder;

class SwatchSeeder extends Seeder
{
    public function run(): void
    {
        $swatches = [
            ['name' => 'White', 'color' => '#FFFFFF'],
            ['name' => 'Black', 'color' => '#000000'],
            ['name' => 'Navy', 'color' => '#1B2A4A'],
            ['name' => 'Light Blue', 'color' => '#A4C8E1'],
            ['name' => 'Sky Blue', 'color' => '#87CEEB'],
            ['name' => 'Charcoal', 'color' => '#36454F'],
            ['name' => 'Oatmeal', 'color' => '#D4C5A9'],
            ['name' => 'Forest Green', 'color' => '#228B22'],
            ['name' => 'Olive', 'color' => '#808000'],
            ['name' => 'Khaki', 'color' => '#C3B091'],
            ['name' => 'Sand', 'color' => '#C2B280'],
            ['name' => 'Cognac', 'color' => '#9A463D'],
            ['name' => 'Brown', 'color' => '#8B4513'],
            ['name' => 'Camel', 'color' => '#C19A6B'],
            ['name' => 'Sage', 'color' => '#BCB88A'],
            ['name' => 'Dusty Rose', 'color' => '#DCAE96'],
            ['name' => 'Burgundy', 'color' => '#800020'],
            ['name' => 'Heather Gray', 'color' => '#B6B6B4'],
            ['name' => 'Green', 'color' => '#006400'],
            ['name' => 'Gray', 'color' => '#808080'],
            // New colors for expanded product range
            ['name' => 'Cream', 'color' => '#FFFDD0'],
            ['name' => 'Slate', 'color' => '#708090'],
            ['name' => 'Washed Black', 'color' => '#3B3B3B'],
            ['name' => 'Dark Brown', 'color' => '#4A2C2A'],
        ];

        foreach ($swatches as $swatchData) {
            $swatchData['store_id'] = 1;
            Swatch::create($swatchData);
        }
    }
}
