<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('handle')->index();
            $table->json('seo')->nullable();
            $table->timestamps();

            $table->unique(['store_id', 'handle']);
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('handle')->index();
            $table->text('excerpt')->nullable();
            $table->text('content_html')->nullable();
            $table->string('author_name')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->json('tags')->nullable();
            $table->json('seo')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('blogs');
    }
};
