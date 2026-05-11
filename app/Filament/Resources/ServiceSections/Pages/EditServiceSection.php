<?php

namespace App\Filament\Resources\ServiceSections\Pages;

use App\Filament\Resources\ServiceSections\ServiceSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceSection extends EditRecord
{
    protected static string $resource = ServiceSectionResource::class;

    /**
     * Put the main form and relation managers in one tab row so the image strip is visible without scrolling past the form.
     */
    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return 'Heading & description';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
