<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Basic Information
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                        TextInput::make('slug')->required(),
                    ]),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true)
                    ->alphaDash(),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true)
                    ->alphaDash(),
                Textarea::make('short_description')
                    ->label('Short Description')
                    ->rows(2)
                    ->maxLength(500)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(4)
                    ->columnSpanFull(),

                // Pricing
                TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->step(0.01)
                    ->minValue(0),
                TextInput::make('compare_price')
                    ->label('Compare at Price')
                    ->numeric()
                    ->prefix('$')
                    ->step(0.01)
                    ->minValue(0)
                    ->helperText('Original price before discount'),
                TextInput::make('cost_price')
                    ->label('Cost Price')
                    ->numeric()
                    ->prefix('$')
                    ->step(0.01)
                    ->minValue(0)
                    ->helperText('Wholesale/cost price for profit calculation'),

                // Product Details
                TextInput::make('brand')
                    ->maxLength(255),
                TextInput::make('alcohol_content')
                    ->label('Alcohol Content')
                    ->maxLength(50)
                    ->placeholder('e.g., 40%, 43% ABV')
                    ->helperText('Alcohol by volume'),
                TextInput::make('volume')
                    ->maxLength(255)
                    ->placeholder('e.g., 750ml, 1L'),
                TextInput::make('origin_country')
                    ->label('Origin Country')
                    ->maxLength(255),
                TextInput::make('weight')
                    ->numeric()
                    ->suffix('kg')
                    ->step(0.01)
                    ->minValue(0),
                TextInput::make('dimensions')
                    ->maxLength(255)
                    ->placeholder('e.g., 10 x 5 x 25 cm'),

                // Age Verification & Compliance
                TextInput::make('min_age')
                    ->label('Minimum Age')
                    ->numeric()
                    ->default(21)
                    ->required()
                    ->minValue(18)
                    ->maxValue(100),
                Toggle::make('requires_age_verification')
                    ->label('Requires Age Verification')
                    ->default(true)
                    ->required(),
                Toggle::make('is_taxable')
                    ->label('Is Taxable')
                    ->default(true)
                    ->required(),

                // Images
                FileUpload::make('images')
                    ->label('Product Images')
                    ->image()
                    ->multiple()
                    ->maxFiles(10)
                    ->disk('public')
                    ->directory('products')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                        '16:9',
                        '4:3',
                    ])
                    ->columnSpanFull()
                    ->helperText('Upload multiple product images. First image will be the primary image.'),

                // Additional Attributes
                KeyValue::make('attributes')
                    ->label('Custom Attributes')
                    ->keyLabel('Attribute Name')
                    ->valueLabel('Attribute Value')
                    ->columnSpanFull()
                    ->helperText('Add custom attributes like color, size, etc.'),

                // SEO & Metadata
                TextInput::make('meta_title')
                    ->label('Meta Title')
                    ->maxLength(255)
                    ->helperText('SEO title for search engines')
                    ->columnSpanFull(),
                Textarea::make('meta_description')
                    ->label('Meta Description')
                    ->rows(2)
                    ->maxLength(500)
                    ->helperText('SEO description for search engines')
                    ->columnSpanFull(),

                // Status & Settings
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
                Toggle::make('is_featured')
                    ->label('Featured Product')
                    ->default(false)
                    ->helperText('Show on homepage or featured section'),
                Toggle::make('track_inventory')
                    ->label('Track Inventory')
                    ->default(true)
                    ->required(),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Lower numbers appear first'),
            ])
            ->columns(3);
    }
}
