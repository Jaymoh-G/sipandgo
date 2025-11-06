<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Spirits (Hard Liquor)
            [
                'name' => 'Whisky & Whiskey',
                'slug' => 'whisky-whiskey',
                'description' => 'Premium whisky and whiskey collection including Scotch, Irish, Bourbon, Tennessee, Rye, and Blended varieties',
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'Premium Whisky & Whiskey Collection',
                'meta_description' => 'Discover our curated selection of premium whiskies and whiskeys from around the world',
            ],
            [
                'name' => 'Vodka',
                'slug' => 'vodka',
                'description' => 'High-quality vodka brands including plain, flavored, and premium varieties from top distilleries',
                'is_active' => true,
                'sort_order' => 2,
                'meta_title' => 'Premium Vodka Collection',
                'meta_description' => 'Explore our selection of premium vodkas from top distilleries worldwide',
            ],
            [
                'name' => 'Rum',
                'slug' => 'rum',
                'description' => 'Caribbean and premium rum selections including white, dark, gold, spiced, and overproof varieties',
                'is_active' => true,
                'sort_order' => 3,
                'meta_title' => 'Premium Rum Collection',
                'meta_description' => 'Taste the finest rums from the Caribbean and beyond',
            ],
            [
                'name' => 'Gin',
                'slug' => 'gin',
                'description' => 'Craft gin and traditional varieties including London Dry, Old Tom, Sloe Gin, and botanical gins',
                'is_active' => true,
                'sort_order' => 4,
                'meta_title' => 'Craft Gin Collection',
                'meta_description' => 'Discover craft gin and traditional London dry gin varieties',
            ],
            [
                'name' => 'Tequila & Mezcal',
                'slug' => 'tequila-mezcal',
                'description' => 'Authentic Mexican tequila and mezcal including Blanco, Reposado, Añejo, Extra Añejo varieties',
                'is_active' => true,
                'sort_order' => 5,
                'meta_title' => 'Authentic Tequila & Mezcal Collection',
                'meta_description' => 'Experience authentic Mexican tequila and mezcal from premium distilleries',
            ],
            [
                'name' => 'Brandy & Cognac',
                'slug' => 'brandy-cognac',
                'description' => 'Premium brandy and cognac collection including French Cognac, Armagnac, and fine brandies',
                'is_active' => true,
                'sort_order' => 6,
                'meta_title' => 'Premium Brandy & Cognac Collection',
                'meta_description' => 'Explore our selection of premium brandies and cognacs',
            ],
            [
                'name' => 'Liqueurs',
                'slug' => 'liqueurs',
                'description' => 'Premium liqueurs and cordials including cream liqueurs, coffee liqueurs, herbal liqueurs, and flavored spirits',
                'is_active' => true,
                'sort_order' => 7,
                'meta_title' => 'Premium Liqueurs Collection',
                'meta_description' => 'Enhance your cocktails with our premium liqueurs and cordials',
            ],
            [
                'name' => 'Wine',
                'slug' => 'wine',
                'description' => 'Red, white, rosé, sparkling, and dessert wines from renowned vineyards worldwide',
                'is_active' => true,
                'sort_order' => 8,
                'meta_title' => 'Premium Wine Collection',
                'meta_description' => 'Explore our curated selection of premium wines from around the world',
            ],
            [
                'name' => 'Beer',
                'slug' => 'beer',
                'description' => 'Craft beer, imported beer, and local favorites including lagers, ales, stouts, and wheat beers',
                'is_active' => true,
                'sort_order' => 9,
                'meta_title' => 'Craft Beer Collection',
                'meta_description' => 'Discover craft beers, imports, and local favorites',
            ],
            [
                'name' => 'Ready-to-Drink (RTD)',
                'slug' => 'ready-to-drink',
                'description' => 'Convenient premixed cocktails and ready-to-drink beverages including breezers, gin & tonic, and cocktail mixes',
                'is_active' => true,
                'sort_order' => 10,
                'meta_title' => 'Ready-to-Drink Cocktails',
                'meta_description' => 'Enjoy convenient premixed cocktails and ready-to-drink beverages',
            ],
            [
                'name' => 'Cocktail Mixers',
                'slug' => 'cocktail-mixers',
                'description' => 'Mixers, syrups, bitters, and cocktail ingredients to complete your home bar',
                'is_active' => true,
                'sort_order' => 11,
                'meta_title' => 'Cocktail Mixers & Ingredients',
                'meta_description' => 'Complete your bar with our cocktail mixers and ingredients',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
