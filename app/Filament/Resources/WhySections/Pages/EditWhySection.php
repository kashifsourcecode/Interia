<?php

namespace App\Filament\Resources\WhySections\Pages;

use App\Filament\Resources\WhySections\WhySectionResource;
use App\Filament\Support\WhySectionHeroFormHydrator;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWhySection extends EditRecord
{
    protected static string $resource = WhySectionResource::class;

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return 'Heading & hero image';
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return WhySectionHeroFormHydrator::beforeFill($data);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return WhySectionHeroFormHydrator::beforeSave($data, $this->record);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
