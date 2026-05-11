<?php

namespace App\Filament\Resources\AiAdoptionSections\Pages;

use App\Filament\Resources\AiAdoptionSections\AiAdoptionSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAiAdoptionSections extends ListRecords
{
    protected static string $resource = AiAdoptionSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
