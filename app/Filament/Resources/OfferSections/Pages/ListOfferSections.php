<?php

namespace App\Filament\Resources\OfferSections\Pages;

use App\Filament\Resources\OfferSections\OfferSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOfferSections extends ListRecords
{
    protected static string $resource = OfferSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
