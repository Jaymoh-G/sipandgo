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
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('store_id')->nullable()->after('id')->constrained()->onDelete('cascade');
            $table->index('store_id');
            $table->index(['store_id', 'email']);
            $table->index(['store_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->dropIndex(['store_id']);
            $table->dropIndex(['store_id', 'email']);
            $table->dropIndex(['store_id', 'is_active']);
            $table->dropColumn('store_id');
        });
    }
};

