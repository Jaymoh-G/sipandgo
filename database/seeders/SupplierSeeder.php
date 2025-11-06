<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Premium Spirits Distributors',
                'contact_person' => 'John Smith',
                'email' => 'john@premiumspirits.com',
                'phone' => '+1-555-0123',
                'address_line_1' => '123 Distribution Blvd',
                'city' => 'New York',
                'state' => 'NY',
                'postal_code' => '10001',
                'country' => 'USA',
                'payment_terms' => 'Net 30',
                'credit_limit' => 50000.00,
                'is_active' => true,
            ],
            [
                'name' => 'International Wine & Spirits',
                'contact_person' => 'Maria Garcia',
                'email' => 'maria@intlwinespirits.com',
                'phone' => '+1-555-0456',
                'address_line_1' => '456 Import Street',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'postal_code' => '90210',
                'country' => 'USA',
                'payment_terms' => 'Net 15',
                'credit_limit' => 75000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Craft Beverage Co.',
                'contact_person' => 'David Johnson',
                'email' => 'david@craftbeverage.com',
                'phone' => '+1-555-0789',
                'address_line_1' => '789 Artisan Way',
                'city' => 'Portland',
                'state' => 'OR',
                'postal_code' => '97201',
                'country' => 'USA',
                'payment_terms' => 'Net 30',
                'credit_limit' => 30000.00,
                'is_active' => true,
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
