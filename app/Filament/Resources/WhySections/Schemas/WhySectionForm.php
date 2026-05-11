<?php

namespace App\Filament\Resources\WhySections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WhySectionForm
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
                    ->helperText('Use "home" for the homepage “Why Interia” block.'),
                TextInput::make('label')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Small label above the heading (e.g. “Why Interia”).'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(512)
                    ->helperText('Main heading. Use a line break in the text field if you want two lines.'),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->helperText('Introductory paragraph under the title.'),
                FileUpload::make('hero_image_file')
                    ->label('Side image upload')
                    ->disk('webroot')
                    ->directory('why-section')
                    ->preserveFilenames()
                    ->previewable(false)
                    ->fetchFileInformation(false)
                    ->maxSize(20480)
                    ->acceptedFileTypes([
                        'image/png',
                        'image/jpeg',
                        'image/webp',
                        'image/svg+xml',
                    ])
                    ->helperText('Optional if you set a public path or URL below.')
                    ->nullable(),
                TextInput::make('hero_external')
                    ->label('Side image path or URL')
                    ->maxLength(2048)
                    ->helperText('Example: images/best-of-both-worlds.png or https://...')
                    ->nullable(),
                TextInput::make('hero_image_alt')
                    ->label('Side image alt text')
                    ->maxLength(255)
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
