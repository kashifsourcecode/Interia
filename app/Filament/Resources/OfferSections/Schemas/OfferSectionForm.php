<?php

namespace App\Filament\Resources\OfferSections\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OfferSectionForm
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
                    ->helperText('Use "home" for the homepage free assessments block.'),
                TextInput::make('label')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Small label above the heading (e.g. “Complimentary”).'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(512)
                    ->helperText('Main heading. Use a line break for a second line if needed.'),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->helperText('Subheading under the title.'),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
