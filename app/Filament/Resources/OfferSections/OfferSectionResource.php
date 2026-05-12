<?php

namespace App\Filament\Resources\OfferSections;

use App\Filament\Resources\OfferSections\Pages\CreateOfferSection;
use App\Filament\Resources\OfferSections\Pages\EditOfferSection;
use App\Filament\Resources\OfferSections\Pages\ListOfferSections;
use App\Filament\Resources\OfferSections\RelationManagers\OfferCardsRelationManager;
use App\Filament\Resources\OfferSections\Schemas\OfferSectionForm;
use App\Filament\Resources\OfferSections\Tables\OfferSectionsTable;
use App\Models\OfferSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OfferSectionResource extends Resource
{
    protected static ?string $model = OfferSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGift;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Free Assessments';

    protected static ?int $navigationSort = 14;

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return OfferSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OfferSectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            OfferCardsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOfferSections::route('/'),
            'create' => CreateOfferSection::route('/create'),
            'edit' => EditOfferSection::route('/{record}/edit'),
        ];
    }
}
