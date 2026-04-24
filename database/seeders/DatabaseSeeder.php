<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StoreSeeder::class,
            ProductSeeder::class,
            CollectionSeeder::class,
            MenuSeeder::class,
            BlogSeeder::class,
            PageSeeder::class,
            PolicySeeder::class,
            SwatchSeeder::class,
            ThemeSeeder::class,
        ]);
    }
}
