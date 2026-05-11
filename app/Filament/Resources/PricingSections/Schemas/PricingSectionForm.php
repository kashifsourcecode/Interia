<?php

namespace App\Filament\Resources\PricingSections\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PricingSectionForm
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
                    ->helperText('Use "home" for the homepage pricing block.'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(512)
                    ->helperText('Main pricing heading (e.g. “Simple, Transparent Pricing”).'),
                Textarea::make('subtitle')
                    ->columnSpanFull()
                    ->helperText('Paragraph under the main heading.'),
                TextInput::make('addons_title')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Infrastructure add-ons block title.'),
                Textarea::make('addons_subtitle')
                    ->columnSpanFull()
                    ->helperText('Paragraph under the add-ons title.'),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
