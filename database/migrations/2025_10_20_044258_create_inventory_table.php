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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_variant_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('quantity_on_hand')->default(0);
            $table->integer('quantity_reserved')->default(0);
            $table->integer('quantity_available')->storedAs('quantity_on_hand - quantity_reserved');
            $table->integer('low_stock_threshold')->default(10);
            $table->integer('reorder_point')->default(5);
            $table->integer('reorder_quantity')->default(50);
            $table->decimal('cost_per_unit', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->string('bin_location')->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'product_variant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
