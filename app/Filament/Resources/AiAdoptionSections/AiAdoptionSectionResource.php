<?php

namespace App\Filament\Resources\AiAdoptionSections;

use App\Filament\Resources\AiAdoptionSections\Pages\CreateAiAdoptionSection;
use App\Filament\Resources\AiAdoptionSections\Pages\EditAiAdoptionSection;
use App\Filament\Resources\AiAdoptionSections\Pages\ListAiAdoptionSections;
use App\Filament\Resources\AiAdoptionSections\RelationManagers\ChecklistItemsRelationManager;
use App\Filament\Resources\AiAdoptionSections\RelationManagers\StepsRelationManager;
use App\Filament\Resources\AiAdoptionSections\Schemas\AiAdoptionSectionForm;
use App\Filament\Resources\AiAdoptionSections\Tables\AiAdoptionSectionsTable;
use App\Models\AiAdoptionSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AiAdoptionSectionResource extends Resource
{
    protected static ?string $model = AiAdoptionSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCpuChip;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Homepage AI Adoption';

    protected static ?int $navigationSort = 12;

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return AiAdoptionSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AiAdoptionSectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            StepsRelationManager::class,
            ChecklistItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAiAdoptionSections::route('/'),
            'create' => CreateAiAdoptionSection::route('/create'),
            'edit' => EditAiAdoptionSection::route('/{record}/edit'),
        ];
    }
}
