<?php

namespace App\Filament\Resources\ContactSections\Pages;

use App\Filament\Resources\ContactSections\ContactSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactSection extends EditRecord
{
    protected static string $resource = ContactSectionResource::class;

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return 'Heading & intro';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
