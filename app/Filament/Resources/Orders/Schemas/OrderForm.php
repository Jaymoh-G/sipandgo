<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_number')
                    ->label('Order Number')
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true)
                    ->disabled(fn ($record) => $record !== null)
                    ->helperText('Auto-generated if not provided'),
                Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'email')
                    ->searchable(['email', 'first_name', 'last_name'])
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                    ])
                    ->required()
                    ->default('pending'),
                TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->prefix('Ksh')
                    ->step(0.01)
                    ->required(),
                TextInput::make('tax_amount')
                    ->label('Tax Amount')
                    ->numeric()
                    ->prefix('Ksh')
                    ->step(0.01)
                    ->default(0),
                TextInput::make('shipping_amount')
                    ->label('Shipping Amount')
                    ->numeric()
                    ->prefix('Ksh')
                    ->step(0.01)
                    ->default(0),
                TextInput::make('discount_amount')
                    ->label('Discount Amount')
                    ->numeric()
                    ->prefix('Ksh')
                    ->step(0.01)
                    ->default(0),
                TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->numeric()
                    ->prefix('Ksh')
                    ->step(0.01)
                    ->required()
                    ->disabled(),
                Select::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->default('pending'),
                Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'credit_card' => 'Credit Card',
                        'debit_card' => 'Debit Card',
                        'paypal' => 'PayPal',
                        'bank_transfer' => 'Bank Transfer',
                        'cash_on_delivery' => 'Cash on Delivery',
                    ])
                    ->searchable(),
                TextInput::make('shipping_method')
                    ->label('Shipping Method')
                    ->maxLength(255),
                TextInput::make('tracking_number')
                    ->label('Tracking Number')
                    ->maxLength(255),
                KeyValue::make('billing_address')
                    ->label('Billing Address')
                    ->keyLabel('Field')
                    ->valueLabel('Value')
                    ->columnSpanFull(),
                KeyValue::make('shipping_address')
                    ->label('Shipping Address')
                    ->keyLabel('Field')
                    ->valueLabel('Value')
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->label('Notes')
                    ->rows(3)
                    ->columnSpanFull(),
                DateTimePicker::make('shipped_at')
                    ->label('Shipped At'),
                DateTimePicker::make('delivered_at')
                    ->label('Delivered At'),
            ])
            ->columns(3);
    }
}
