<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds products without duplicating existing records.
     */
    public function run(): void
    {
        // Try to find categories - support both old flat structure and new hierarchical structure
        $whiskyCategory = Category::where('name', 'Whisky / Whiskey')->orWhere('name', 'Whisky & Whiskey')->first();
        $vodkaCategory = Category::where('name', 'Vodka')->first();
        $rumCategory = Category::where('name', 'Rum')->first();
        $ginCategory = Category::where('name', 'Gin')->first();
        $tequilaCategory = Category::where('name', 'Tequila & Mezcal')->first();
        $brandyCategory = Category::where('name', 'Brandy & Cognac')->first();
        $liqueursCategory = Category::where('name', 'Liqueurs')->first();
        $wineCategory = Category::where('name', 'Wine')->orWhere('name', 'Wines')->first();
        $beerCategory = Category::where('name', 'Beer')->first();
        $rtdCategory = Category::where('name', 'Ready-to-Drink (RTD) / Premixed')->orWhere('name', 'Ready-to-Drink (RTD)')->first();

        // Find sub-categories for more specific product placement
        $scotchCategory = Category::where('name', 'Scotch Whisky')->first();
        $bourbonCategory = Category::where('name', 'Bourbon')->first();
        $irishWhiskeyCategory = Category::where('name', 'Irish Whiskey')->first();
        $baileysCategory = Category::where('name', 'Baileys Irish Cream')->first();
        $redWineCategory = Category::where('name', 'Red Wine')->first();
        $whiteWineCategory = Category::where('name', 'White Wine')->first();
        $sparklingWineCategory = Category::where('name', 'Sparkling Wine')->first();
        $stoutCategory = Category::where('name', 'Stout')->first();

        $products = [
            // Whisky & Whiskey Products
            [
                'category_id' => $scotchCategory?->id ?? $whiskyCategory?->id,
                'name' => 'Macallan 18 Year Old Single Malt Scotch',
                'slug' => 'macallan-18-year-old-single-malt-scotch',
                'sku' => 'MAC18-750',
                'price' => 299.99,
                'compare_price' => 349.99,
                'cost_price' => 180.00,
                'brand' => 'Macallan',
                'alcohol_content' => '43%',
                'volume' => '750ml',
                'origin_country' => 'Scotland',
                'description' => 'Aged for 18 years in sherry-seasoned oak casks, this single malt offers rich flavors of dried fruit, spice, and oak.',
                'short_description' => 'Premium 18-year-old single malt Scotch whisky',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $bourbonCategory?->id ?? $whiskyCategory?->id,
                'name' => 'Woodford Reserve Bourbon',
                'slug' => 'woodford-reserve-bourbon',
                'sku' => 'WR-BOURBON-750',
                'price' => 39.99,
                'compare_price' => 45.99,
                'cost_price' => 25.00,
                'brand' => 'Woodford Reserve',
                'alcohol_content' => '45.2%',
                'volume' => '750ml',
                'origin_country' => 'USA',
                'description' => 'Small batch bourbon with rich, full-bodied flavor and a long, smooth finish.',
                'short_description' => 'Premium small batch bourbon',
                'images' => [
                    'https://images.unsplash.com/photo-1569529465841-dfecdab7503b?w=800&h=800&fit=crop',
                    'https://images.unsplash.com/photo-1569529465841-dfecdab7503b?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $irishWhiskeyCategory?->id ?? $whiskyCategory?->id,
                'name' => 'Jameson Irish Whiskey',
                'slug' => 'jameson-irish-whiskey',
                'sku' => 'JAMESON-750',
                'price' => 29.99,
                'compare_price' => 34.99,
                'cost_price' => 18.00,
                'brand' => 'Jameson',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'origin_country' => 'Ireland',
                'description' => 'Triple-distilled Irish whiskey with smooth, balanced flavor and hints of vanilla and spice.',
                'short_description' => 'Classic triple-distilled Irish whiskey',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => false,
                'track_inventory' => true,
                'sort_order' => 3,
            ],

            // Vodka Products
            [
                'category_id' => $vodkaCategory?->id,
                'name' => 'Grey Goose Vodka',
                'slug' => 'grey-goose-vodka',
                'sku' => 'GG-VODKA-750',
                'price' => 34.99,
                'compare_price' => 39.99,
                'cost_price' => 22.00,
                'brand' => 'Grey Goose',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'origin_country' => 'France',
                'description' => 'Premium French vodka made from soft winter wheat and pure spring water.',
                'short_description' => 'Premium French vodka',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 4,
            ],
            [
                'category_id' => $vodkaCategory?->id,
                'name' => 'Beluga Gold Line Vodka',
                'slug' => 'beluga-gold-line-vodka',
                'sku' => 'BELUGA-GOLD-750',
                'price' => 89.99,
                'compare_price' => 99.99,
                'cost_price' => 55.00,
                'brand' => 'Beluga',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'origin_country' => 'Russia',
                'description' => 'Ultra-premium Russian vodka with exceptional smoothness and purity.',
                'short_description' => 'Ultra-premium Russian vodka',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => false,
                'track_inventory' => true,
                'sort_order' => 5,
            ],
            [
                'category_id' => $vodkaCategory?->id,
                'name' => 'Absolut Vodka',
                'slug' => 'absolut-vodka',
                'sku' => 'ABSOLUT-750',
                'price' => 24.99,
                'compare_price' => 28.99,
                'cost_price' => 15.00,
                'brand' => 'Absolut',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'origin_country' => 'Sweden',
                'description' => 'Premium Swedish vodka made from winter wheat with a clean, smooth taste.',
                'short_description' => 'Premium Swedish vodka',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => false,
                'track_inventory' => true,
                'sort_order' => 6,
            ],

            // Rum Products
            [
                'category_id' => $rumCategory?->id,
                'name' => 'Appleton Estate 21 Year Old Rum',
                'slug' => 'appleton-estate-21-year-old-rum',
                'sku' => 'AE21-750',
                'price' => 79.99,
                'compare_price' => 89.99,
                'cost_price' => 50.00,
                'brand' => 'Appleton Estate',
                'alcohol_content' => '43%',
                'volume' => '750ml',
                'origin_country' => 'Jamaica',
                'description' => 'Aged for 21 years in oak barrels, this premium rum offers complex flavors of spice, oak, and tropical fruit.',
                'short_description' => 'Premium 21-year-old Jamaican rum',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 7,
            ],
            [
                'category_id' => $rumCategory?->id,
                'name' => 'Bacardi Superior White Rum',
                'slug' => 'bacardi-superior-white-rum',
                'sku' => 'BACARDI-WHITE-750',
                'price' => 19.99,
                'compare_price' => 22.99,
                'cost_price' => 12.00,
                'brand' => 'Bacardi',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'origin_country' => 'Puerto Rico',
                'description' => 'Classic white rum with smooth, clean taste perfect for cocktails.',
                'short_description' => 'Classic white rum for cocktails',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => false,
                'track_inventory' => true,
                'sort_order' => 8,
            ],

            // Gin Products
            [
                'category_id' => $ginCategory?->id,
                'name' => 'Hendrick\'s Gin',
                'slug' => 'hendricks-gin',
                'sku' => 'HENDRICKS-750',
                'price' => 29.99,
                'compare_price' => 34.99,
                'cost_price' => 18.00,
                'brand' => 'Hendrick\'s',
                'alcohol_content' => '44%',
                'volume' => '750ml',
                'origin_country' => 'Scotland',
                'description' => 'Uniquely infused with cucumber and rose petals for a distinctive flavor profile.',
                'short_description' => 'Cucumber and rose-infused gin',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 9,
            ],
            [
                'category_id' => $ginCategory?->id,
                'name' => 'Tanqueray London Dry Gin',
                'slug' => 'tanqueray-london-dry-gin',
                'sku' => 'TANQUERAY-750',
                'price' => 24.99,
                'compare_price' => 28.99,
                'cost_price' => 15.00,
                'brand' => 'Tanqueray',
                'alcohol_content' => '47.3%',
                'volume' => '750ml',
                'origin_country' => 'England',
                'description' => 'Classic London Dry Gin with juniper-forward flavor and citrus notes.',
                'short_description' => 'Classic London Dry Gin',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => false,
                'track_inventory' => true,
                'sort_order' => 10,
            ],

            // Tequila & Mezcal Products
            [
                'category_id' => $tequilaCategory?->id,
                'name' => 'Don Julio 1942 Tequila',
                'slug' => 'don-julio-1942-tequila',
                'sku' => 'DJ1942-750',
                'price' => 149.99,
                'compare_price' => 169.99,
                'cost_price' => 90.00,
                'brand' => 'Don Julio',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'origin_country' => 'Mexico',
                'description' => 'Ultra-premium añejo tequila aged for 2.5 years in American white oak barrels.',
                'short_description' => 'Ultra-premium añejo tequila',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 11,
            ],
            [
                'category_id' => $tequilaCategory?->id,
                'name' => 'Patrón Silver Tequila',
                'slug' => 'patron-silver-tequila',
                'sku' => 'PATRON-SILVER-750',
                'price' => 49.99,
                'compare_price' => 54.99,
                'cost_price' => 30.00,
                'brand' => 'Patrón',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'origin_country' => 'Mexico',
                'description' => 'Premium blanco tequila with clean, crisp flavor and hints of citrus.',
                'short_description' => 'Premium blanco tequila',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => false,
                'track_inventory' => true,
                'sort_order' => 12,
            ],

            // Brandy & Cognac Products
            [
                'category_id' => $brandyCategory?->id,
                'name' => 'Hennessy VS Cognac',
                'slug' => 'hennessy-vs-cognac',
                'sku' => 'HENNESSY-VS-750',
                'price' => 44.99,
                'compare_price' => 49.99,
                'cost_price' => 28.00,
                'brand' => 'Hennessy',
                'alcohol_content' => '40%',
                'volume' => '750ml',
                'origin_country' => 'France',
                'description' => 'Classic VS Cognac with rich, complex flavors of fruit and oak.',
                'short_description' => 'Classic VS Cognac',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 13,
            ],

            // Liqueurs Products
            [
                'category_id' => $baileysCategory?->id ?? $liqueursCategory?->id,
                'name' => 'Baileys Original Irish Cream',
                'slug' => 'baileys-original-irish-cream',
                'sku' => 'BAILEYS-750',
                'price' => 24.99,
                'compare_price' => 28.99,
                'cost_price' => 15.00,
                'brand' => 'Baileys',
                'alcohol_content' => '17%',
                'volume' => '750ml',
                'origin_country' => 'Ireland',
                'description' => 'Creamy Irish cream liqueur with rich chocolate and vanilla flavors.',
                'short_description' => 'Creamy Irish cream liqueur',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 14,
            ],
            [
                'category_id' => $liqueursCategory?->id,
                'name' => 'Kahlúa Coffee Liqueur',
                'slug' => 'kahlua-coffee-liqueur',
                'sku' => 'KAHLUA-750',
                'price' => 22.99,
                'compare_price' => 25.99,
                'cost_price' => 14.00,
                'brand' => 'Kahlúa',
                'alcohol_content' => '20%',
                'volume' => '750ml',
                'origin_country' => 'Mexico',
                'description' => 'Rich coffee liqueur with smooth, sweet flavor perfect for cocktails.',
                'short_description' => 'Rich coffee liqueur',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => false,
                'track_inventory' => true,
                'sort_order' => 15,
            ],

            // Wine Products
            [
                'category_id' => $redWineCategory?->id ?? $wineCategory?->id,
                'name' => 'Caymus Cabernet Sauvignon 2020',
                'slug' => 'caymus-cabernet-sauvignon-2020',
                'sku' => 'CAYMUS-CAB-2020',
                'price' => 69.99,
                'compare_price' => 79.99,
                'cost_price' => 45.00,
                'brand' => 'Caymus',
                'alcohol_content' => '14.5%',
                'volume' => '750ml',
                'origin_country' => 'USA',
                'description' => 'Rich, full-bodied Cabernet Sauvignon with notes of dark fruit, vanilla, and oak.',
                'short_description' => 'Premium Napa Valley Cabernet Sauvignon',
                'images' => [
                    'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 16,
            ],
            [
                'category_id' => $sparklingWineCategory?->id ?? $wineCategory?->id,
                'name' => 'Dom Pérignon Vintage 2013',
                'slug' => 'dom-perignon-vintage-2013',
                'sku' => 'DOM-PERIGNON-2013',
                'price' => 199.99,
                'compare_price' => 229.99,
                'cost_price' => 120.00,
                'brand' => 'Dom Pérignon',
                'alcohol_content' => '12.5%',
                'volume' => '750ml',
                'origin_country' => 'France',
                'description' => 'Prestigious champagne with fine bubbles and complex flavors of citrus and toast.',
                'short_description' => 'Prestigious vintage champagne',
                'images' => [
                    'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 17,
            ],

            // Beer Products
            [
                'category_id' => $stoutCategory?->id ?? $beerCategory?->id,
                'name' => 'Guinness Draught Stout',
                'slug' => 'guinness-draught-stout',
                'sku' => 'GUINNESS-DRAUGHT-6PK',
                'price' => 9.99,
                'compare_price' => 11.99,
                'cost_price' => 6.00,
                'brand' => 'Guinness',
                'alcohol_content' => '4.2%',
                'volume' => '6 x 440ml',
                'origin_country' => 'Ireland',
                'description' => 'Classic Irish stout with rich, creamy texture and roasted malt flavor.',
                'short_description' => 'Classic Irish stout',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => true,
                'track_inventory' => true,
                'sort_order' => 18,
            ],

            // Ready-to-Drink Products
            [
                'category_id' => $rtdCategory?->id,
                'name' => 'Smirnoff Ice Original',
                'slug' => 'smirnoff-ice-original',
                'sku' => 'SMIRNOFF-ICE-6PK',
                'price' => 8.99,
                'compare_price' => 10.99,
                'cost_price' => 5.50,
                'brand' => 'Smirnoff',
                'alcohol_content' => '4.5%',
                'volume' => '6 x 330ml',
                'origin_country' => 'USA',
                'description' => 'Refreshing vodka-based ready-to-drink beverage with lemon-lime flavor.',
                'short_description' => 'Vodka-based ready-to-drink',
                'images' => [
                    'https://images.unsplash.com/photo-1608270586621-ec9c8c4d1d7c?w=800&h=800&fit=crop',
                ],
                'is_active' => true,
                'is_featured' => false,
                'track_inventory' => true,
                'sort_order' => 19,
            ],
        ];

        foreach ($products as $product) {
            // Skip if category doesn't exist
            if (!$product['category_id']) {
                continue;
            }

            // Use firstOrCreate to prevent duplicates based on SKU
            Product::firstOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }

        $this->command?->info('Products seeded successfully!');
    }
}
