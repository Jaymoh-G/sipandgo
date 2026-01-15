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
        // Check if products table exists
        if (!Schema::hasTable('products')) {
            throw new \Exception('Products table does not exist. Please run products migration first.');
        }

        // Create table without foreign keys first
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->integer('rating')->default(5);
            $table->text('review')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            // Add indexes
            $table->index('product_id');
            $table->index('customer_id');
            $table->index('is_approved');
        });

        // Add foreign keys using raw SQL for better compatibility
        try {
            // Check if products table uses InnoDB engine (required for foreign keys)
            $productsEngine = DB::selectOne("SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'products'");

            if ($productsEngine && strtolower($productsEngine->ENGINE) === 'innodb') {
                // Add product_id foreign key
                DB::statement('ALTER TABLE product_reviews ADD CONSTRAINT product_reviews_product_id_foreign FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE');
            }
        } catch (\Exception $e) {
            // Foreign key creation failed, but table is created - continue
            \Log::warning('Could not create product_id foreign key constraint: ' . $e->getMessage());
        }

        // Add customer foreign key if customers table exists
        if (Schema::hasTable('customers')) {
            try {
                $customersEngine = DB::selectOne("SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'customers'");

                if ($customersEngine && strtolower($customersEngine->ENGINE) === 'innodb') {
                    DB::statement('ALTER TABLE product_reviews ADD CONSTRAINT product_reviews_customer_id_foreign FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL');
                }
            } catch (\Exception $e) {
                \Log::warning('Could not create customer_id foreign key constraint: ' . $e->getMessage());
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('product_reviews')) {
            // Drop foreign keys if they exist
            $foreignKeys = DB::select(
                "SELECT CONSTRAINT_NAME
                 FROM information_schema.KEY_COLUMN_USAGE
                 WHERE TABLE_SCHEMA = DATABASE()
                 AND TABLE_NAME = 'product_reviews'
                 AND CONSTRAINT_NAME IN ('product_reviews_product_id_foreign', 'product_reviews_customer_id_foreign')"
            );

            foreach ($foreignKeys as $fk) {
                try {
                    DB::statement("ALTER TABLE product_reviews DROP FOREIGN KEY {$fk->CONSTRAINT_NAME}");
                } catch (\Exception $e) {
                    // Continue if drop fails
                }
            }

            Schema::dropIfExists('product_reviews');
        }
    }
};
