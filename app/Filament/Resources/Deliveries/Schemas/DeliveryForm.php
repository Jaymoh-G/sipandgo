<?php

namespace App\Filament\Resources\Deliveries\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DeliveryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order_id')
                    ->label('Order')
                    ->relationship('order', 'order_number')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                TextInput::make('tracking_number')
                    ->label('Tracking Number')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Unique tracking number from carrier'),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'preparing' => 'Preparing',
                        'ready' => 'Ready',
                        'in_transit' => 'In Transit',
                        'out_for_delivery' => 'Out for Delivery',
                        'delivered' => 'Delivered',
                        'failed' => 'Failed',
                        'returned' => 'Returned',
                    ])
                    ->required()
                    ->default('pending'),
                TextInput::make('carrier')
                    ->label('Carrier')
                    ->maxLength(255)
                    ->placeholder('e.g., UPS, FedEx, DHL'),
                TextInput::make('service_type')
                    ->label('Service Type')
                    ->maxLength(255)
                    ->placeholder('e.g., Standard, Express, Overnight'),
                TextInput::make('shipping_cost')
                    ->label('Shipping Cost')
                    ->numeric()
                    ->prefix('$')
                    ->step(0.01)
                    ->default(0),
                TextInput::make('recipient_name')
                    ->label('Recipient Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('recipient_phone')
                    ->label('Recipient Phone')
                    ->tel()
                    ->maxLength(255),
                KeyValue::make('shipping_address')
                    ->label('Shipping Address')
                    ->keyLabel('Field')
                    ->valueLabel('Value')
                    ->columnSpanFull(),
                Textarea::make('delivery_notes')
                    ->label('Delivery Notes')
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('special_instructions')
                    ->label('Special Instructions')
                    ->rows(2)
                    ->columnSpanFull(),
                DateTimePicker::make('estimated_delivery_date')
                    ->label('Estimated Delivery Date'),
                DateTimePicker::make('shipped_at')
                    ->label('Shipped At'),
                DateTimePicker::make('out_for_delivery_at')
                    ->label('Out for Delivery At'),
                DateTimePicker::make('delivered_at')
                    ->label('Delivered At'),
                TextInput::make('delivered_to')
                    ->label('Delivered To')
                    ->maxLength(255)
                    ->helperText('Name of person who received the delivery'),
                Textarea::make('delivery_failure_reason')
                    ->label('Failure Reason')
                    ->rows(2)
                    ->columnSpanFull()
                    ->helperText('Reason if delivery failed'),
            ])
            ->columns(2);
    }
}

