<?php

namespace App\Filament\Resources\ServiceSections;

use App\Filament\Resources\ServiceSections\Pages\CreateServiceSection;
use App\Filament\Resources\ServiceSections\Pages\EditServiceSection;
use App\Filament\Resources\ServiceSections\Pages\ListServiceSections;
use App\Filament\Resources\ServiceSections\RelationManagers\CardsRelationManager;
use App\Filament\Resources\ServiceSections\RelationManagers\CarouselItemsRelationManager;
use App\Filament\Resources\ServiceSections\Schemas\ServiceSectionForm;
use App\Filament\Resources\ServiceSections\Tables\ServiceSectionsTable;
use App\Models\ServiceSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ServiceSectionResource extends Resource
{
    protected static ?string $model = ServiceSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Homepage Services';

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return ServiceSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceSectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            CarouselItemsRelationManager::class,
            CardsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceSections::route('/'),
            'create' => CreateServiceSection::route('/create'),
            'edit' => EditServiceSection::route('/{record}/edit'),
        ];
    }
}
