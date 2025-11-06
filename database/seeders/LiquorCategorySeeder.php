<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LiquorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds liquor categories and types without duplicating existing records.
     */
    public function run(): void
    {
        // Define the hierarchical structure
        $categories = [
            // Top-level Categories
            'Spirits' => [
                'name' => 'Spirits (Hard Liquor)',
                'description' => 'Distilled beverages with higher alcohol content (usually 35–50% ABV)',
                'sort_order' => 1,
            ],
            'Liqueurs' => [
                'name' => 'Liqueurs',
                'description' => 'Sweet or flavored spirits',
                'sort_order' => 2,
            ],
            'Wines' => [
                'name' => 'Wines',
                'description' => 'Red, white, rosé, sparkling, and dessert wines',
                'sort_order' => 3,
            ],
            'Beer' => [
                'name' => 'Beer',
                'description' => 'Lager, ale, stout, and wheat beers',
                'sort_order' => 4,
            ],
            'RTD' => [
                'name' => 'Ready-to-Drink (RTD) / Premixed',
                'description' => 'Convenient premixed cocktails and ready-to-drink beverages',
                'sort_order' => 5,
            ],
        ];

        // Types under Spirits
        $spiritsTypes = [
            'Whisky / Whiskey' => [
                'name' => 'Whisky / Whiskey',
                'description' => 'Premium whisky and whiskey collection',
                'sort_order' => 1,
                'children' => [
                    'Scotch Whisky' => ['description' => 'Premium Scotch whisky from Scotland', 'sort_order' => 1],
                    'Irish Whiskey' => ['description' => 'Smooth Irish whiskey', 'sort_order' => 2],
                    'Bourbon' => ['description' => 'American bourbon whiskey', 'sort_order' => 3],
                    'Tennessee Whiskey' => ['description' => 'Tennessee whiskey', 'sort_order' => 4],
                    'Rye Whiskey' => ['description' => 'Rye whiskey', 'sort_order' => 5],
                    'Blended Whisky' => ['description' => 'Blended whisky varieties', 'sort_order' => 6],
                ],
            ],
            'Vodka' => [
                'name' => 'Vodka',
                'description' => 'High-quality vodka brands',
                'sort_order' => 2,
                'children' => [
                    'Plain Vodka' => ['description' => 'Classic unflavored vodka', 'sort_order' => 1],
                    'Flavored Vodka' => ['description' => 'Flavored vodka varieties', 'sort_order' => 2],
                    'Premium Vodka' => ['description' => 'Premium vodka brands', 'sort_order' => 3],
                ],
            ],
            'Rum' => [
                'name' => 'Rum',
                'description' => 'Caribbean and premium rum selections',
                'sort_order' => 3,
                'children' => [
                    'White Rum' => ['description' => 'Light white rum', 'sort_order' => 1],
                    'Dark Rum' => ['description' => 'Aged dark rum', 'sort_order' => 2],
                    'Gold / Amber Rum' => ['description' => 'Gold or amber rum', 'sort_order' => 3],
                    'Spiced Rum' => ['description' => 'Spiced rum varieties', 'sort_order' => 4],
                    'Overproof Rum' => ['description' => 'High-proof rum', 'sort_order' => 5],
                ],
            ],
            'Gin' => [
                'name' => 'Gin',
                'description' => 'Craft gin and traditional varieties',
                'sort_order' => 4,
                'children' => [
                    'London Dry Gin' => ['description' => 'Classic London dry gin', 'sort_order' => 1],
                    'Old Tom Gin' => ['description' => 'Old Tom gin', 'sort_order' => 2],
                    'Sloe Gin' => ['description' => 'Sloe gin liqueur', 'sort_order' => 3],
                    'Flavored or Botanical Gin' => ['description' => 'Flavored and botanical gins', 'sort_order' => 4],
                ],
            ],
            'Tequila & Mezcal' => [
                'name' => 'Tequila & Mezcal',
                'description' => 'Authentic Mexican tequila and mezcal',
                'sort_order' => 5,
                'children' => [
                    'Blanco (Silver) Tequila' => ['description' => 'Unaged silver tequila', 'sort_order' => 1],
                    'Reposado' => ['description' => 'Aged reposado tequila', 'sort_order' => 2],
                    'Añejo' => ['description' => 'Aged añejo tequila', 'sort_order' => 3],
                    'Extra Añejo' => ['description' => 'Extra aged tequila', 'sort_order' => 4],
                    'Mezcal' => ['description' => 'Authentic Mexican mezcal', 'sort_order' => 5],
                ],
            ],
            'Brandy & Cognac' => [
                'name' => 'Brandy & Cognac',
                'description' => 'Premium brandy and cognac collection',
                'sort_order' => 6,
                'children' => [
                    'Brandy' => ['description' => 'General brandy category', 'sort_order' => 1],
                    'Cognac' => ['description' => 'French Cognac', 'sort_order' => 2],
                    'Armagnac' => ['description' => 'French Armagnac', 'sort_order' => 3],
                ],
            ],
        ];

        // Liqueurs types
        $liqueursTypes = [
            'Baileys Irish Cream' => ['description' => 'Baileys Irish Cream liqueur', 'sort_order' => 1],
            'Kahlúa' => ['description' => 'Coffee liqueur', 'sort_order' => 2],
            'Amarula' => ['description' => 'Cream liqueur', 'sort_order' => 3],
            'Malibu' => ['description' => 'Coconut rum liqueur', 'sort_order' => 4],
            'Cointreau / Triple Sec' => ['description' => 'Orange liqueur', 'sort_order' => 5],
            'Grand Marnier' => ['description' => 'Premium orange liqueur', 'sort_order' => 6],
            'Jägermeister' => ['description' => 'Herbal liqueur', 'sort_order' => 7],
            'Sambuca' => ['description' => 'Anise-flavored liqueur', 'sort_order' => 8],
            'Amaretto' => ['description' => 'Almond-flavored liqueur', 'sort_order' => 9],
        ];

        // Wine types
        $wineTypes = [
            'Red Wine' => ['description' => 'Cabernet Sauvignon, Merlot, Shiraz', 'sort_order' => 1],
            'White Wine' => ['description' => 'Chardonnay, Sauvignon Blanc, Pinot Grigio', 'sort_order' => 2],
            'Rosé Wine' => ['description' => 'Rosé wine varieties', 'sort_order' => 3],
            'Sparkling Wine' => ['description' => 'Champagne, Prosecco, Cava', 'sort_order' => 4],
            'Dessert Wine' => ['description' => 'Port, Sherry, Moscato', 'sort_order' => 5],
        ];

        // Beer types
        $beerTypes = [
            'Lager' => ['description' => 'Lager beer', 'sort_order' => 1],
            'Pilsner' => ['description' => 'Pilsner beer', 'sort_order' => 2],
            'Ale' => ['description' => 'Pale Ale, IPA, Brown Ale', 'sort_order' => 3],
            'Stout' => ['description' => 'Stout beer including Guinness', 'sort_order' => 4],
            'Wheat Beer' => ['description' => 'Wheat beer varieties', 'sort_order' => 5],
        ];

        // RTD types
        $rtdTypes = [
            'Breezer' => ['description' => 'Rum-based breezer', 'sort_order' => 1],
            'Smirnoff Ice' => ['description' => 'Vodka-based RTD', 'sort_order' => 2],
            'Gin & Tonic' => ['description' => 'Gin & Tonic cans', 'sort_order' => 3],
            'Whisky & Cola' => ['description' => 'Whisky & Cola mix', 'sort_order' => 4],
            'Cocktails' => ['description' => 'Cocktails in bottles or cans (Mojito, Margarita, etc.)', 'sort_order' => 5],
        ];

        // Create top-level categories
        $parentCategories = [];
        foreach ($categories as $key => $data) {
            $slug = Str::slug($data['name']);
            $parentCategories[$key] = Category::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'is_active' => true,
                    'sort_order' => $data['sort_order'],
                    'parent_id' => null,
                ]
            );
        }

        // Create Spirits types and their sub-types
        foreach ($spiritsTypes as $typeKey => $typeData) {
            $typeSlug = Str::slug($typeData['name']);
            $typeCategory = Category::firstOrCreate(
                ['slug' => $typeSlug],
                [
                    'name' => $typeData['name'],
                    'description' => $typeData['description'],
                    'is_active' => true,
                    'sort_order' => $typeData['sort_order'],
                    'parent_id' => $parentCategories['Spirits']->id,
                ]
            );

            // Create sub-types if they exist
            if (isset($typeData['children'])) {
                foreach ($typeData['children'] as $subTypeKey => $subTypeData) {
                    $subTypeSlug = Str::slug($subTypeKey);
                    Category::firstOrCreate(
                        ['slug' => $subTypeSlug],
                        [
                            'name' => $subTypeKey,
                            'description' => $subTypeData['description'],
                            'is_active' => true,
                            'sort_order' => $subTypeData['sort_order'],
                            'parent_id' => $typeCategory->id,
                        ]
                    );
                }
            }
        }

        // Create Liqueurs types
        foreach ($liqueursTypes as $typeName => $typeData) {
            $typeSlug = Str::slug($typeName);
            Category::firstOrCreate(
                ['slug' => $typeSlug],
                [
                    'name' => $typeName,
                    'description' => $typeData['description'],
                    'is_active' => true,
                    'sort_order' => $typeData['sort_order'],
                    'parent_id' => $parentCategories['Liqueurs']->id,
                ]
            );
        }

        // Create Wine types
        foreach ($wineTypes as $typeName => $typeData) {
            $typeSlug = Str::slug($typeName);
            Category::firstOrCreate(
                ['slug' => $typeSlug],
                [
                    'name' => $typeName,
                    'description' => $typeData['description'],
                    'is_active' => true,
                    'sort_order' => $typeData['sort_order'],
                    'parent_id' => $parentCategories['Wines']->id,
                ]
            );
        }

        // Create Beer types
        foreach ($beerTypes as $typeName => $typeData) {
            $typeSlug = Str::slug($typeName);
            Category::firstOrCreate(
                ['slug' => $typeSlug],
                [
                    'name' => $typeName,
                    'description' => $typeData['description'],
                    'is_active' => true,
                    'sort_order' => $typeData['sort_order'],
                    'parent_id' => $parentCategories['Beer']->id,
                ]
            );
        }

        // Create RTD types
        foreach ($rtdTypes as $typeName => $typeData) {
            $typeSlug = Str::slug($typeName);
            Category::firstOrCreate(
                ['slug' => $typeSlug],
                [
                    'name' => $typeName,
                    'description' => $typeData['description'],
                    'is_active' => true,
                    'sort_order' => $typeData['sort_order'],
                    'parent_id' => $parentCategories['RTD']->id,
                ]
            );
        }

        $this->command?->info('Liquor categories and types seeded successfully!');
    }
}

