<?php

namespace App\Filament\Resources\AiAdoptionSections\Pages;

use App\Filament\Resources\AiAdoptionSections\AiAdoptionSectionResource;
use App\Filament\Support\AiAdoptionDashboardFormHydrator;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAiAdoptionSection extends EditRecord
{
    protected static string $resource = AiAdoptionSectionResource::class;

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return 'Section copy & dashboard';
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return AiAdoptionDashboardFormHydrator::beforeFill($data);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return AiAdoptionDashboardFormHydrator::beforeSave($data, $this->record);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
