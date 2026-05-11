<?php

namespace App\Filament\Resources\PricingSections\Pages;

use App\Filament\Resources\PricingSections\PricingSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPricingSection extends EditRecord
{
    protected static string $resource = PricingSectionResource::class;

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
