<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                DatePicker::make('date_of_birth')
                    ->label('Date of Birth')
                    ->required()
                    ->maxDate(now()->subYears(18))
                    ->helperText('Must be 18+ years old'),
                Toggle::make('age_verified')
                    ->label('Age Verified')
                    ->default(false),
                TextInput::make('password')
                    ->password()
                    ->required(fn ($record) => $record === null)
                    ->minLength(8)
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Leave blank to keep current password'),
                TextInput::make('address_line_1')
                    ->label('Address Line 1')
                    ->maxLength(255),
                TextInput::make('address_line_2')
                    ->label('Address Line 2')
                    ->maxLength(255),
                TextInput::make('city')
                    ->maxLength(255),
                TextInput::make('state')
                    ->maxLength(255),
                TextInput::make('postal_code')
                    ->label('Postal Code')
                    ->maxLength(255),
                TextInput::make('country')
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
                Toggle::make('email_verified')
                    ->label('Email Verified')
                    ->default(false),
                Select::make('preferred_language')
                    ->label('Preferred Language')
                    ->options([
                        'en' => 'English',
                        'es' => 'Spanish',
                        'fr' => 'French',
                        'de' => 'German',
                    ])
                    ->default('en'),
                KeyValue::make('preferences')
                    ->label('Preferences')
                    ->keyLabel('Key')
                    ->valueLabel('Value')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
