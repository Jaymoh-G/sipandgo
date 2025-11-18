<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Site Information
                TextInput::make('site_name')
                    ->label('Site Name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),
                Textarea::make('site_description')
                    ->label('Site Description')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->imageEditor()
                    ->helperText('Upload your site logo')
                    ->columnSpan(1),
                FileUpload::make('favicon')
                    ->label('Favicon')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->imageEditor()
                    ->maxSize(512)
                    ->helperText('Upload your site favicon (recommended: 32x32 or 16x16 pixels)')
                    ->columnSpan(1),
                FileUpload::make('payment_methods_image')
                    ->label('Payment Methods Image')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->helperText('Payment methods image displayed in footer (recommended: 300x50px or similar). Accepted formats: JPG, PNG, GIF, WebP, SVG (max 2MB)')
                    ->columnSpanFull(),

                // Contact Information
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255)
                    ->columnSpan(1),
                TextInput::make('phone')
                    ->label('Phone')
                    ->tel()
                    ->maxLength(255)
                    ->columnSpan(1),
                TextInput::make('mobile')
                    ->label('Mobile')
                    ->tel()
                    ->maxLength(255)
                    ->columnSpan(1),
                Textarea::make('address')
                    ->label('Address')
                    ->rows(2)
                    ->columnSpan(1),
                TextInput::make('city')
                    ->label('City')
                    ->maxLength(255)
                    ->columnSpan(1),
                TextInput::make('state')
                    ->label('State/Province')
                    ->maxLength(255)
                    ->columnSpan(1),
                TextInput::make('postal_code')
                    ->label('Postal Code')
                    ->maxLength(255)
                    ->columnSpan(1),
                TextInput::make('country')
                    ->label('Country')
                    ->maxLength(255)
                    ->default('Kenya')
                    ->columnSpan(1),

                // Social Media Links
                TextInput::make('facebook_url')
                    ->label('Facebook URL')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://facebook.com/yourpage')
                    ->columnSpan(1),
                TextInput::make('twitter_url')
                    ->label('Twitter/X URL')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://twitter.com/yourhandle')
                    ->columnSpan(1),
                TextInput::make('instagram_url')
                    ->label('Instagram URL')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://instagram.com/yourhandle')
                    ->columnSpan(1),
                TextInput::make('linkedin_url')
                    ->label('LinkedIn URL')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://linkedin.com/company/yourcompany')
                    ->columnSpan(1),
                TextInput::make('youtube_url')
                    ->label('YouTube URL')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://youtube.com/@yourchannel')
                    ->columnSpan(1),
                TextInput::make('tiktok_url')
                    ->label('TikTok URL')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://tiktok.com/@yourhandle')
                    ->columnSpan(1),
                TextInput::make('whatsapp_number')
                    ->label('WhatsApp Number')
                    ->tel()
                    ->maxLength(255)
                    ->placeholder('+254712345678')
                    ->helperText('Include country code, e.g., +254712345678')
                    ->columnSpanFull(),

                // Maintenance Mode
                Toggle::make('maintenance_mode')
                    ->label('Enable Maintenance Mode')
                    ->helperText('When enabled, the site will be unavailable to visitors')
                    ->columnSpanFull(),
                Textarea::make('maintenance_message')
                    ->label('Maintenance Message')
                    ->rows(3)
                    ->maxLength(500)
                    ->helperText('Message to display when maintenance mode is active')
                    ->visible(fn ($get) => $get('maintenance_mode'))
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
