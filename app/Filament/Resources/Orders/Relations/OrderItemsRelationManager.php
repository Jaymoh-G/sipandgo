<?php

namespace App\Filament\Resources\Orders\Relations;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'product_name';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('product_sku')
                    ->label('SKU')
                    ->searchable()
                    ->fontFamily('mono'),
                TextColumn::make('quantity')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('unit_price')
                    ->label('Unit Price')
                    ->formatStateUsing(fn ($state) => 'Ksh ' . number_format($state, 2))
                    ->sortable()
                    ->alignEnd(),
                TextColumn::make('total_price')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => 'Ksh ' . number_format($state, 2))
                    ->sortable()
                    ->alignEnd()
                    ->weight('bold'),
            ])
            ->defaultSort('id', 'asc');
    }
}

