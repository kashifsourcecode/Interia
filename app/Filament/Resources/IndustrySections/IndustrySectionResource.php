<?php

namespace App\Filament\Resources\IndustrySections;

use App\Filament\Resources\IndustrySections\Pages\CreateIndustrySection;
use App\Filament\Resources\IndustrySections\Pages\EditIndustrySection;
use App\Filament\Resources\IndustrySections\Pages\ListIndustrySections;
use App\Filament\Resources\IndustrySections\RelationManagers\IndustryCardsRelationManager;
use App\Filament\Resources\IndustrySections\Schemas\IndustrySectionForm;
use App\Filament\Resources\IndustrySections\Tables\IndustrySectionsTable;
use App\Models\IndustrySection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class IndustrySectionResource extends Resource
{
    protected static ?string $model = IndustrySection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Industries';

    protected static ?int $navigationSort = 11;

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return IndustrySectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IndustrySectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            IndustryCardsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIndustrySections::route('/'),
            'create' => CreateIndustrySection::route('/create'),
            'edit' => EditIndustrySection::route('/{record}/edit'),
        ];
    }
}
