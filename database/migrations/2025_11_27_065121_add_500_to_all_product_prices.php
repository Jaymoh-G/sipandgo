<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 500 KSH to all product prices
        DB::table('products')->update([
            'price' => DB::raw('price + 500'),
            'compare_price' => DB::raw('CASE WHEN compare_price IS NOT NULL THEN compare_price + 500 ELSE NULL END'),
        ]);

        // Add 500 KSH to all product variant prices if the table exists
        if (Schema::hasTable('product_variants')) {
            DB::table('product_variants')->update([
                'price' => DB::raw('price + 500'),
                'compare_price' => DB::raw('CASE WHEN compare_price IS NOT NULL THEN compare_price + 500 ELSE NULL END'),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Subtract 500 KSH from all product prices
        DB::table('products')->update([
            'price' => DB::raw('price - 500'),
            'compare_price' => DB::raw('CASE WHEN compare_price IS NOT NULL THEN compare_price - 500 ELSE NULL END'),
        ]);

        // Subtract 500 KSH from all product variant prices if the table exists
        if (Schema::hasTable('product_variants')) {
            DB::table('product_variants')->update([
                'price' => DB::raw('price - 500'),
                'compare_price' => DB::raw('CASE WHEN compare_price IS NOT NULL THEN compare_price - 500 ELSE NULL END'),
            ]);
        }
    }
};
