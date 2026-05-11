<?php

namespace App\Filament\Resources\GallerySections\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GallerySectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->alphaDash()
                    ->maxLength(191)
                    ->helperText('Use "home" for the main site gallery collage.'),
                TextInput::make('headline_line_1')
                    ->maxLength(255),
                TextInput::make('headline_line_2')
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
