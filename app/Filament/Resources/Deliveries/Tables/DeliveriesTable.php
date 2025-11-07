<?php

namespace App\Filament\Resources\Deliveries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DeliveriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.order_number')
                    ->label('Order #')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->fontFamily('mono'),
                TextColumn::make('tracking_number')
                    ->label('Tracking #')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono')
                    ->placeholder('Not assigned'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'preparing' => 'warning',
                        'ready' => 'info',
                        'in_transit' => 'primary',
                        'out_for_delivery' => 'success',
                        'delivered' => 'success',
                        'failed' => 'danger',
                        'returned' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('carrier')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('service_type')
                    ->label('Service Type')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('recipient_name')
                    ->label('Recipient')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('shipping_cost')
                    ->label('Shipping Cost')
                    ->money('USD')
                    ->sortable()
                    ->alignEnd()
                    ->toggleable(),
                TextColumn::make('estimated_delivery_date')
                    ->label('Est. Delivery')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('delivered_at')
                    ->label('Delivered At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'preparing' => 'Preparing',
                        'ready' => 'Ready',
                        'in_transit' => 'In Transit',
                        'out_for_delivery' => 'Out for Delivery',
                        'delivered' => 'Delivered',
                        'failed' => 'Failed',
                        'returned' => 'Returned',
                    ]),
                SelectFilter::make('carrier')
                    ->label('Carrier')
                    ->options(fn () => \App\Models\Delivery::query()
                        ->whereNotNull('carrier')
                        ->distinct()
                        ->pluck('carrier', 'carrier')
                        ->toArray())
                    ->searchable(),
                SelectFilter::make('order_id')
                    ->label('Order')
                    ->relationship('order', 'order_number')
                    ->searchable()
                    ->preload(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

