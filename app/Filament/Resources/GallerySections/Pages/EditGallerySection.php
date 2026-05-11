<?php

namespace App\Filament\Resources\GallerySections\Pages;

use App\Filament\Resources\GallerySections\GallerySectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGallerySection extends EditRecord
{
    protected static string $resource = GallerySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
