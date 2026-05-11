<?php

namespace App\Filament\Resources\AboutSections\Pages;

use App\Filament\Resources\AboutSections\AboutSectionResource;
use App\Filament\Support\AboutSectionFormHydrator;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutSection extends CreateRecord
{
    protected static string $resource = AboutSectionResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return AboutSectionFormHydrator::beforeSave($data, null);
    }
}
