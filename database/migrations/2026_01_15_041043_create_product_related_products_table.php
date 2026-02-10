<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_related_products', function (Blueprint $table) {
            $table->id();
            // Use plain integer columns without foreign key constraints to avoid
            // issues when the existing `products` table uses a different key type
            // or engine in some environments (e.g. production).
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('related_product_id');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Prevent duplicate relationships
            $table->unique(['product_id', 'related_product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_related_products');
    }
};
