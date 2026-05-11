<?php

namespace App\Filament\Resources\WhySections\Pages;

use App\Filament\Resources\WhySections\WhySectionResource;
use App\Filament\Support\WhySectionHeroFormHydrator;
use Filament\Resources\Pages\CreateRecord;

class CreateWhySection extends CreateRecord
{
    protected static string $resource = WhySectionResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return WhySectionHeroFormHydrator::beforeSave($data, null);
    }
}
