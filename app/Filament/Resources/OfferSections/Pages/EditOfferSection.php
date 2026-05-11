<?php

namespace App\Filament\Resources\OfferSections\Pages;

use App\Filament\Resources\OfferSections\OfferSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOfferSection extends EditRecord
{
    protected static string $resource = OfferSectionResource::class;

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return 'Section heading';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
