<?php

namespace App\Filament\Resources\IndustrySections\Pages;

use App\Filament\Resources\IndustrySections\IndustrySectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIndustrySections extends ListRecords
{
    protected static string $resource = IndustrySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
