<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingsResource;
use App\Models\Settings;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingsResource::class;

    public function mount(): void
    {
        // Redirect to edit page since this is a singleton resource
        $settings = Settings::getSettings();
        $this->redirect(SettingsResource::getUrl('edit', ['record' => $settings]));
    }
}

