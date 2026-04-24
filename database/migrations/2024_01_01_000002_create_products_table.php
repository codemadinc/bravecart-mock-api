<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('handle')->index();
            $table->text('description')->nullable();
            $table->text('description_html')->nullable();
            $table->string('product_type')->nullable();
            $table->string('vendor')->nullable();
            $table->string('status')->default('ACTIVE'); // ACTIVE, DRAFT, ARCHIVED
            $table->json('tags')->nullable(); // ["tag1","tag2"]
            $table->json('images')->nullable(); // [{id,url,altText,width,height}]
            $table->json('seo')->nullable(); // {title,description}
            $table->json('options')->nullable(); // [{name:"Size",values:["S","M","L"]},{name:"Color",values:[...]}]
            $table->decimal('price_min', 10, 2)->default(0);
            $table->decimal('price_max', 10, 2)->default(0);
            $table->decimal('compare_at_price_min', 10, 2)->nullable();
            $table->decimal('compare_at_price_max', 10, 2)->nullable();
            $table->boolean('available_for_sale')->default(true);
            $table->timestamps();

            $table->unique(['store_id', 'handle']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
