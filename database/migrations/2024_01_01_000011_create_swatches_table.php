<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('swatches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // "Red", "Ocean Blue"
            $table->string('color')->nullable(); // hex color "#FF0000"
            $table->string('image_url')->nullable(); // pattern/texture image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('swatches');
    }
};
