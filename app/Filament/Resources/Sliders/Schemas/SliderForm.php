<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Main heading text for the slider')
                    ->columnSpanFull(),
                TextInput::make('subtitle')
                    ->label('Subtitle/Badge')
                    ->maxLength(255)
                    ->helperText('Small text above the title (e.g., "Save up to 50% off")')
                    ->columnSpanFull(),
                TextInput::make('button_text')
                    ->label('Button Text')
                    ->maxLength(255)
                    ->placeholder('e.g., Explore Shop, Shop Now')
                    ->columnSpan(1),
                TextInput::make('button_link')
                    ->label('Button Link')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('e.g., /shop, /categories/whiskey')
                    ->helperText('URL or route for the button')
                    ->columnSpan(1),
                TextInput::make('price_text')
                    ->label('Price Text')
                    ->maxLength(255)
                    ->placeholder('e.g., Starting at Ksh 29.99')
                    ->helperText('Price or promotional text to display')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Slider Image')
                    ->image()
                    ->disk('public')
                    ->directory('sliders')
                    ->imageEditor()
                    ->helperText('Main image displayed on the slider (recommended: 500x500px, max 500px height)')
                    ->columnSpan(1),
                FileUpload::make('background_image')
                    ->label('Background Image')
                    ->image()
                    ->disk('public')
                    ->directory('sliders')
                    ->imageEditor()
                    ->helperText('Background image for the slider (recommended: 1920x600px for desktop, will be cropped to fit)')
                    ->columnSpan(1),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Lower numbers appear first')
                    ->columnSpan(1),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required()
                    ->columnSpan(1),
            ])
            ->columns(2);
    }
}
