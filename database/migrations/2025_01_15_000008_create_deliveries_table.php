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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('tracking_number')->unique()->nullable();
            $table->enum('status', ['pending', 'preparing', 'ready', 'in_transit', 'out_for_delivery', 'delivered', 'failed', 'returned'])->default('pending');
            $table->string('carrier')->nullable();
            $table->string('service_type')->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->json('shipping_address');
            $table->string('recipient_name');
            $table->string('recipient_phone')->nullable();
            $table->text('delivery_notes')->nullable();
            $table->text('special_instructions')->nullable();
            $table->timestamp('estimated_delivery_date')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('out_for_delivery_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->string('delivered_to')->nullable();
            $table->text('delivery_failure_reason')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('store_id');
            $table->index('order_id');
            $table->index(['store_id', 'order_id']);
            $table->index(['store_id', 'status']);
            $table->index('tracking_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};

