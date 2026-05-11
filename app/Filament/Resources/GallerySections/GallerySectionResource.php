<?php

namespace App\Filament\Resources\GallerySections;

use App\Filament\Resources\GallerySections\Pages\CreateGallerySection;
use App\Filament\Resources\GallerySections\Pages\EditGallerySection;
use App\Filament\Resources\GallerySections\Pages\ListGallerySections;
use App\Filament\Resources\GallerySections\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\GallerySections\Schemas\GallerySectionForm;
use App\Filament\Resources\GallerySections\Tables\GallerySectionsTable;
use App\Models\GallerySection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class GallerySectionResource extends Resource
{
    protected static ?string $model = GallerySection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Gallery Section';

    protected static ?int $navigationSort = 11;

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return GallerySectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GallerySectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGallerySections::route('/'),
            'create' => CreateGallerySection::route('/create'),
            'edit' => EditGallerySection::route('/{record}/edit'),
        ];
    }
}
