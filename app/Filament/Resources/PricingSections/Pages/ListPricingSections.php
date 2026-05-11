<?php

namespace App\Filament\Resources\PricingSections\Pages;

use App\Filament\Resources\PricingSections\PricingSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPricingSections extends ListRecords
{
    protected static string $resource = PricingSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
