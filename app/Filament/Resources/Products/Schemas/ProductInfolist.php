<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->size('lg')
                            ->weight('bold'),
                        TextEntry::make('sku')
                            ->label('SKU')
                            ->copyable()
                            ->fontFamily('mono'),
                        TextEntry::make('category.name')
                            ->label('Category')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('slug')
                            ->copyable()
                            ->placeholder('-'),
                        TextEntry::make('short_description')
                            ->label('Short Description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('-')
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Pricing')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Price')
                            ->money('USD')
                            ->size('lg')
                            ->weight('bold'),
                        TextEntry::make('compare_price')
                            ->label('Compare at Price')
                            ->money('USD')
                            ->placeholder('-'),
                        TextEntry::make('cost_price')
                            ->label('Cost Price')
                            ->money('USD')
                            ->placeholder('-'),
                        TextEntry::make('discount_percentage')
                            ->label('Discount')
                            ->getStateUsing(function ($record) {
                                if ($record->is_on_sale) {
                                    return $record->discount_percentage . '%';
                                }
                                return null;
                            })
                            ->badge()
                            ->color('success')
                            ->placeholder('-'),
                    ])
                    ->columns(4),

                Section::make('Product Details')
                    ->schema([
                        TextEntry::make('brand')
                            ->placeholder('-'),
                        TextEntry::make('alcohol_content')
                            ->label('Alcohol Content')
                            ->placeholder('-'),
                        TextEntry::make('volume')
                            ->placeholder('-'),
                        TextEntry::make('origin_country')
                            ->label('Origin Country')
                            ->placeholder('-'),
                        TextEntry::make('weight')
                            ->suffix(' kg')
                            ->placeholder('-'),
                        TextEntry::make('dimensions')
                            ->placeholder('-'),
                    ])
                    ->columns(3),

                Section::make('Age Verification & Compliance')
                    ->schema([
                        TextEntry::make('min_age')
                            ->label('Minimum Age')
                            ->suffix(' years')
                            ->placeholder('-'),
                        IconEntry::make('requires_age_verification')
                            ->label('Requires Age Verification')
                            ->boolean(),
                        IconEntry::make('is_taxable')
                            ->label('Is Taxable')
                            ->boolean(),
                    ])
                    ->columns(3),

                Section::make('Images')
                    ->schema([
                        ImageEntry::make('images')
                            ->label('Product Images')
                            ->getStateUsing(function ($record) {
                                return $record->images ?? [];
                            })
                            ->circular()
                            ->stacked()
                            ->limit(5)
                            ->placeholder('No images uploaded')
                            ->columnSpanFull(),
                    ]),

                Section::make('Additional Attributes')
                    ->schema([
                        TextEntry::make('attributes')
                            ->label('Custom Attributes')
                            ->getStateUsing(function ($record) {
                                if (!$record->attributes || empty($record->attributes)) {
                                    return null;
                                }
                                $attributes = [];
                                foreach ($record->attributes as $key => $value) {
                                    $attributes[] = "<strong>{$key}:</strong> {$value}";
                                }
                                return implode('<br>', $attributes);
                            })
                            ->html()
                            ->placeholder('No custom attributes')
                            ->columnSpanFull(),
                    ]),

                Section::make('SEO & Metadata')
                    ->schema([
                        TextEntry::make('meta_title')
                            ->label('Meta Title')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('meta_description')
                            ->label('Meta Description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Status & Settings')
                    ->schema([
                        IconEntry::make('is_active')
                            ->label('Active')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Featured Product')
                            ->boolean(),
                        IconEntry::make('track_inventory')
                            ->label('Track Inventory')
                            ->boolean(),
                        TextEntry::make('sort_order')
                            ->label('Sort Order')
                            ->placeholder('-'),
                    ])
                    ->columns(4),

                Section::make('Timestamps')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime()
                            ->placeholder('-'),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}



