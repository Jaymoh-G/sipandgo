<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingsResource;
use App\Models\Settings;
use Filament\Resources\Pages\EditRecord;

class EditSettings extends EditRecord
{
    protected static string $resource = SettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Get or create the settings record
        $settings = Settings::getSettings();
        $this->record = $settings;

        return $settings->toArray();
    }

    public function mount(int | string $record = null): void
    {
        // Always use the singleton settings record
        $settings = Settings::getSettings();
        $this->record = $settings;

        parent::mount($settings->id);
    }
}
