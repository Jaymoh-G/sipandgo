<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Categories first (LiquorCategorySeeder creates hierarchical categories)
            LiquorCategorySeeder::class,
            // Optional: Keep old CategorySeeder if you want flat categories too
            // CategorySeeder::class,

            // Products need categories, so they come after
            ProductSeeder::class,

            // Product variants need products
            ProductVariantSeeder::class,

            // Suppliers (independent)
            SupplierSeeder::class,
        ]);

        // Create admin user for Filament
        User::firstOrCreate(
            ['email' => 'james.mbatia@breezetech.co.ke'],
            [
                'name' => 'Admin',
                'email' => 'james.mbatia@breezetech.co.ke',
                'password' => Hash::make('GichaneS1/'),
                'email_verified_at' => now(),
            ]
        );

        // Create test user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // User::factory(10)->create();
    }
}
