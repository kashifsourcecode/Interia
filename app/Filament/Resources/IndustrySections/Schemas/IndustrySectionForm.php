<?php

namespace App\Filament\Resources\IndustrySections\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class IndustrySectionForm
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
                    ->helperText('Use "home" for the homepage Industries block.'),
                TextInput::make('label')
                    ->maxLength(255)
                    ->helperText('Optional small label above the main heading (leave empty to hide).')
                    ->nullable(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Main heading (e.g. "Industries").'),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->helperText('Paragraph under the main heading.')
                    ->nullable(),
                TextInput::make('sub_heading')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Center column headline (e.g. "Empowering Diverse Industries").'),
                Textarea::make('sub_lead')
                    ->columnSpanFull()
                    ->helperText('Supporting text under the center headline.')
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
