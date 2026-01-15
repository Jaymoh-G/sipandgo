<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        // Sync the related products relationship after creation
        $data = $this->form->getState();
        if (isset($data['relatedProducts']) && is_array($data['relatedProducts'])) {
            $this->record->relatedProducts()->sync($data['relatedProducts']);
        }
    }
}
