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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('store_id')->nullable()->after('id')->constrained()->onDelete('cascade');
            $table->index('store_id');
            $table->index(['store_id', 'customer_id']);
            $table->index(['store_id', 'status']);
            $table->index(['store_id', 'order_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->dropIndex(['store_id']);
            $table->dropIndex(['store_id', 'customer_id']);
            $table->dropIndex(['store_id', 'status']);
            $table->dropIndex(['store_id', 'order_number']);
            $table->dropColumn('store_id');
        });
    }
};

