<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // CMS page layouts — each row is a page's section composition
        Schema::create('theme_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // INDEX, PRODUCT, COLLECTION, BLOG, ARTICLE, PAGE, CUSTOM
            $table->string('handle')->nullable(); // null for type-level defaults, or specific handle
            $table->json('items'); // flat array of section items with children refs
            $table->timestamps();

            $table->unique(['store_id', 'type', 'handle']);
        });

        // Global theme settings — one row per store
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->json('settings'); // full theme settings JSON
            $table->timestamps();

            $table->unique(['store_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('theme_settings');
        Schema::dropIfExists('theme_pages');
    }
};
