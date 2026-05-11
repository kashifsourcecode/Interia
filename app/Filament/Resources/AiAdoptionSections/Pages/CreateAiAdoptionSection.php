<?php

namespace App\Filament\Resources\AiAdoptionSections\Pages;

use App\Filament\Resources\AiAdoptionSections\AiAdoptionSectionResource;
use App\Filament\Support\AiAdoptionDashboardFormHydrator;
use Filament\Resources\Pages\CreateRecord;

class CreateAiAdoptionSection extends CreateRecord
{
    protected static string $resource = AiAdoptionSectionResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return AiAdoptionDashboardFormHydrator::beforeSave($data, null);
    }
}
