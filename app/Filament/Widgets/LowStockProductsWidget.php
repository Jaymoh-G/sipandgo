<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LowStockProductsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::where('track_inventory', true)
                    ->where('is_active', true)
                    ->whereHas('inventory', function ($query) {
                        $query->whereColumn('quantity_available', '<=', 'low_stock_threshold');
                    })
                    ->with(['category', 'inventory'])
                    ->orderBy('name')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Product')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50),

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('info')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('inventory.quantity_available')
                    ->label('Available Stock')
                    ->numeric()
                    ->sortable()
                    ->getStateUsing(function (Product $record) {
                        $inventory = $record->inventory()->first();
                        return $inventory ? $inventory->quantity_available : 0;
                    })
                    ->badge()
                    ->color(fn ($state) => $state <= 5 ? 'danger' : ($state <= 10 ? 'warning' : 'success')),

                Tables\Columns\TextColumn::make('inventory.low_stock_threshold')
                    ->label('Threshold')
                    ->numeric()
                    ->sortable()
                    ->getStateUsing(function (Product $record) {
                        $inventory = $record->inventory()->first();
                        return $inventory ? $inventory->low_stock_threshold : 10;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name', 'asc')
            ->poll('60s') // Refresh every 60 seconds
            ->heading('Low Stock Products')
            ->recordUrl(fn (Product $record): string => \App\Filament\Resources\Products\ProductResource::getUrl('view', ['record' => $record]));
    }
}

