<?php

namespace App\Filament\Resources\HeroSections\Pages;

use App\Filament\Resources\HeroSections\HeroSectionResource;
use App\Filament\Support\HeroSectionFormHydrator;
use Filament\Resources\Pages\CreateRecord;

class CreateHeroSection extends CreateRecord
{
    protected static string $resource = HeroSectionResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return HeroSectionFormHydrator::beforeSave($data, null);
    }
}
