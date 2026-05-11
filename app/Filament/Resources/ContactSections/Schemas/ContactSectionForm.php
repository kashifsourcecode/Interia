<?php

namespace App\Filament\Resources\ContactSections\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactSectionForm
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
                    ->helperText('Use "home" for the homepage contact intro.'),
                TextInput::make('label')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Small label (e.g. “Get In Touch”).'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(512)
                    ->helperText('Main heading; use a line break for a second line if needed.'),
                Textarea::make('subtitle')
                    ->columnSpanFull()
                    ->helperText('Intro paragraph above the layout.')
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
