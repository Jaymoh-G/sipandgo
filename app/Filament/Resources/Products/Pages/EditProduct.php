<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Handle relatedProducts sync manually since we're using options() instead of relationship()
        if (isset($data['relatedProducts'])) {
            $relatedProductIds = $data['relatedProducts'];
            unset($data['relatedProducts']); // Remove from data so it doesn't try to save as attribute

            // Sync will happen in afterSave
            $this->relatedProductIds = $relatedProductIds;
        }

        return $data;
    }

    protected function afterSave(): void
    {
        // Sync the related products relationship
        if (isset($this->relatedProductIds)) {
            $this->record->relatedProducts()->sync($this->relatedProductIds);
        }
    }
}
