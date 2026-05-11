<?php

namespace App\Filament\Resources\GallerySections\Pages;

use App\Filament\Resources\GallerySections\GallerySectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGallerySections extends ListRecords
{
    protected static string $resource = GallerySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
