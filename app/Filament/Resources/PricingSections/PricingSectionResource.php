<?php

namespace App\Filament\Resources\PricingSections;

use App\Filament\Resources\PricingSections\Pages\CreatePricingSection;
use App\Filament\Resources\PricingSections\Pages\EditPricingSection;
use App\Filament\Resources\PricingSections\Pages\ListPricingSections;
use App\Filament\Resources\PricingSections\RelationManagers\PricingAddonCardsRelationManager;
use App\Filament\Resources\PricingSections\RelationManagers\PricingPlansRelationManager;
use App\Filament\Resources\PricingSections\Schemas\PricingSectionForm;
use App\Filament\Resources\PricingSections\Tables\PricingSectionsTable;
use App\Models\PricingSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PricingSectionResource extends Resource
{
    protected static ?string $model = PricingSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Pricing & Add-ons';

    protected static ?int $navigationSort = 15;

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return PricingSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PricingSectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            PricingPlansRelationManager::class,
            PricingAddonCardsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPricingSections::route('/'),
            'create' => CreatePricingSection::route('/create'),
            'edit' => EditPricingSection::route('/{record}/edit'),
        ];
    }
}
