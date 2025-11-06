<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some products to add variants to
        $macallan = Product::where('name', 'Macallan 18 Year Old Single Malt Scotch')->first();
        $greyGoose = Product::where('name', 'Grey Goose Vodka')->first();
        $bacardi = Product::where('name', 'Bacardi Superior White Rum')->first();
        $hendricks = Product::where('name', 'Hendrick\'s Gin')->first();
        $patron = Product::where('name', 'Patrón Silver Tequila')->first();
        $hennessy = Product::where('name', 'Hennessy VS Cognac')->first();

        $variants = [
            // Macallan variants (different bottle sizes)
            [
                'product_id' => $macallan->id,
                'name' => 'Macallan 18 Year Old - 375ml',
                'sku' => 'MAC18-375',
                'price' => 159.99,
                'compare_price' => 179.99,
                'cost_price' => 95.00,
                'size' => '375ml',
                'alcohol_content' => '43%',
                'volume' => '375ml',
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 1,
            ],
            [
                'product_id' => $macallan->id,
                'name' => 'Macallan 18 Year Old - 1.75L',
                'sku' => 'MAC18-1750',
                'price' => 599.99,
                'compare_price' => 699.99,
                'cost_price' => 360.00,
                'size' => '1.75L',
                'alcohol_content' => '43%',
                'volume' => '1.75L',
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 2,
            ],

            // Grey Goose variants (different flavors)
            [
                'product_id' => $greyGoose->id,
                'name' => 'Grey Goose La Poire',
                'sku' => 'GG-PEAR-750',
                'price' => 34.99,
                'compare_price' => 39.99,
                'cost_price' => 22.00,
                'size' => '750ml',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'attributes' => json_encode(['flavor' => 'Pear', 'type' => 'Flavored Vodka']),
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 1,
            ],
            [
                'product_id' => $greyGoose->id,
                'name' => 'Grey Goose L\'Orange',
                'sku' => 'GG-ORANGE-750',
                'price' => 34.99,
                'compare_price' => 39.99,
                'cost_price' => 22.00,
                'size' => '750ml',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'attributes' => json_encode(['flavor' => 'Orange', 'type' => 'Flavored Vodka']),
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 2,
            ],

            // Bacardi variants (different rum types)
            [
                'product_id' => $bacardi->id,
                'name' => 'Bacardi Gold Rum',
                'sku' => 'BACARDI-GOLD-750',
                'price' => 19.99,
                'compare_price' => 22.99,
                'cost_price' => 12.00,
                'size' => '750ml',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'attributes' => json_encode(['type' => 'Gold Rum', 'aged' => '1-3 years']),
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 1,
            ],
            [
                'product_id' => $bacardi->id,
                'name' => 'Bacardi Dark Rum',
                'sku' => 'BACARDI-DARK-750',
                'price' => 19.99,
                'compare_price' => 22.99,
                'cost_price' => 12.00,
                'size' => '750ml',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'attributes' => json_encode(['type' => 'Dark Rum', 'aged' => '3-5 years']),
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 2,
            ],

            // Hendrick's variants (different botanical profiles)
            [
                'product_id' => $hendricks->id,
                'name' => 'Hendrick\'s Midsummer Solstice',
                'sku' => 'HENDRICKS-MIDSUMMER-750',
                'price' => 34.99,
                'compare_price' => 39.99,
                'cost_price' => 21.00,
                'size' => '750ml',
                'alcohol_content' => '43.4%',
                'volume' => '750ml',
                'attributes' => json_encode(['type' => 'Limited Edition', 'botanicals' => 'Floral and citrus']),
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 1,
            ],

            // Patrón variants (different aging)
            [
                'product_id' => $patron->id,
                'name' => 'Patrón Reposado Tequila',
                'sku' => 'PATRON-REPOSADO-750',
                'price' => 54.99,
                'compare_price' => 59.99,
                'cost_price' => 33.00,
                'size' => '750ml',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'attributes' => json_encode(['type' => 'Reposado', 'aged' => '2-12 months']),
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 1,
            ],
            [
                'product_id' => $patron->id,
                'name' => 'Patrón Añejo Tequila',
                'sku' => 'PATRON-ANEJO-750',
                'price' => 64.99,
                'compare_price' => 69.99,
                'cost_price' => 39.00,
                'size' => '750ml',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'attributes' => json_encode(['type' => 'Añejo', 'aged' => '1-3 years']),
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 2,
            ],

            // Hennessy variants (different quality levels)
            [
                'product_id' => $hennessy->id,
                'name' => 'Hennessy VSOP Cognac',
                'sku' => 'HENNESSY-VSOP-750',
                'price' => 64.99,
                'compare_price' => 69.99,
                'cost_price' => 39.00,
                'size' => '750ml',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'attributes' => json_encode(['type' => 'VSOP', 'aged' => '4-7 years']),
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 1,
            ],
            [
                'product_id' => $hennessy->id,
                'name' => 'Hennessy XO Cognac',
                'sku' => 'HENNESSY-XO-750',
                'price' => 199.99,
                'compare_price' => 229.99,
                'cost_price' => 120.00,
                'size' => '750ml',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'attributes' => json_encode(['type' => 'XO', 'aged' => '10+ years']),
                'is_active' => true,
                'track_inventory' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($variants as $variant) {
            ProductVariant::create($variant);
        }
    }
}
