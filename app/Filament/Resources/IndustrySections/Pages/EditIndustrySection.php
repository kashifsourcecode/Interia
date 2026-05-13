<?php

namespace App\Filament\Resources\IndustrySections\Pages;

use App\Filament\Resources\IndustrySections\IndustrySectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIndustrySection extends EditRecord
{
    protected static string $resource = IndustrySectionResource::class;

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return 'Section copy';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
