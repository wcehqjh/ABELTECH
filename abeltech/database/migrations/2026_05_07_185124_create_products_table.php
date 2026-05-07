<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('category', [
                'laptop', 'desktop', 'gaming', 'console', 'tv', 'accessory', 'component'
            ]);
            $table->decimal('price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable(); // pour badge Promo
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->longText('full_description')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('is_new')->default(false);    // badge Nouveau
            $table->boolean('is_promo')->default(false);  // badge Promo
            $table->boolean('is_active')->default(true);
            $table->string('brand')->nullable();
            $table->json('specs')->nullable(); // ex: {"RAM":"16Go","SSD":"512Go"}
            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
    }
};