<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('primary_image')
                    ->label('Image')
                    ->circular()
                    ->size(50)
                    ->getStateUsing(function ($record) {
                        if (!$record->images || empty($record->images)) {
                            return null;
                        }

                        $firstImage = is_array($record->images) ? $record->images[0] : $record->images;

                        if (filter_var($firstImage, FILTER_VALIDATE_URL)) {
                            return $firstImage;
                        }

                        return asset('storage/' . ltrim($firstImage, '/'));
                    })
                    ->placeholder('No image'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono'),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('brand')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->money('USD')
                    ->sortable()
                    ->alignEnd(),
                TextColumn::make('compare_price')
                    ->label('Compare Price')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->alignEnd(),
                TextColumn::make('discount_percentage')
                    ->label('Discount')
                    ->getStateUsing(function ($record) {
                        if ($record->is_on_sale) {
                            return $record->discount_percentage . '%';
                        }
                        return null;
                    })
                    ->badge()
                    ->color('success')
                    ->toggleable(),
                TextColumn::make('stock_status')
                    ->label('Stock')
                    ->getStateUsing(function ($record) {
                        if (!$record->track_inventory) {
                            return 'N/A';
                        }
                        // Add inventory logic here if you have inventory table
                        return 'In Stock';
                    })
                    ->badge()
                    ->color('success')
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('brand')
                    ->label('Brand')
                    ->options(fn () => \App\Models\Product::query()
                        ->whereNotNull('brand')
                        ->where('brand', '!=', '')
                        ->distinct()
                        ->pluck('brand', 'brand')
                        ->toArray())
                    ->searchable(),
                TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->placeholder('All products')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),
                TernaryFilter::make('is_featured')
                    ->label('Featured')
                    ->placeholder('All products')
                    ->trueLabel('Featured only')
                    ->falseLabel('Not featured'),
                TernaryFilter::make('track_inventory')
                    ->label('Track Inventory')
                    ->placeholder('All products')
                    ->trueLabel('Track inventory')
                    ->falseLabel('Don\'t track inventory'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
