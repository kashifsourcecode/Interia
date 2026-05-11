<?php

namespace App\Filament\Resources\WhySections\Pages;

use App\Filament\Resources\WhySections\WhySectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWhySections extends ListRecords
{
    protected static string $resource = WhySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
