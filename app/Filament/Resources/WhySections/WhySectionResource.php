<?php

namespace App\Filament\Resources\WhySections;

use App\Filament\Resources\WhySections\Pages\CreateWhySection;
use App\Filament\Resources\WhySections\Pages\EditWhySection;
use App\Filament\Resources\WhySections\Pages\ListWhySections;
use App\Filament\Resources\WhySections\RelationManagers\FeaturesRelationManager;
use App\Filament\Resources\WhySections\Schemas\WhySectionForm;
use App\Filament\Resources\WhySections\Tables\WhySectionsTable;
use App\Models\WhySection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class WhySectionResource extends Resource
{
    protected static ?string $model = WhySection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Why Interia';

    protected static ?int $navigationSort = 13;

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return WhySectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WhySectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            FeaturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWhySections::route('/'),
            'create' => CreateWhySection::route('/create'),
            'edit' => EditWhySection::route('/{record}/edit'),
        ];
    }
}
