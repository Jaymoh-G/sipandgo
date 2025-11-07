<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('date_of_birth')
                    ->label('Date of Birth')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('age_verified')
                    ->label('Age Verified')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('email_verified')
                    ->label('Email Verified')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('orders_count')
                    ->label('Orders')
                    ->counts('orders')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('city')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('country')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->placeholder('All customers')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),
                TernaryFilter::make('age_verified')
                    ->label('Age Verified')
                    ->placeholder('All customers')
                    ->trueLabel('Verified only')
                    ->falseLabel('Not verified'),
                TernaryFilter::make('email_verified')
                    ->label('Email Verified')
                    ->placeholder('All customers')
                    ->trueLabel('Verified only')
                    ->falseLabel('Not verified'),
                SelectFilter::make('country')
                    ->label('Country')
                    ->options(fn () => \App\Models\Customer::query()
                        ->whereNotNull('country')
                        ->distinct()
                        ->pluck('country', 'country')
                        ->toArray())
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
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
