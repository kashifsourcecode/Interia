<?php

namespace App\Filament\Resources\AboutSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AboutSectionForm
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
                    ->helperText('Use "home" for the homepage About block.'),
                TextInput::make('label')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Small label (e.g. “Who We Are”).'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(512)
                    ->helperText('Main heading; use a line break for a second line.'),
                Textarea::make('intro_paragraph_1')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('intro_paragraph_2')
                    ->columnSpanFull()
                    ->nullable(),
                TextInput::make('mission_title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('mission_body')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('vision_title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('vision_body')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('footer_emphasis')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Bold line next to the pin (e.g. “Born and based in Las Vegas, NV.”).'),
                Textarea::make('footer_body')
                    ->columnSpanFull()
                    ->helperText('Supporting sentence after the bold line.')
                    ->nullable(),
                FileUpload::make('hero_image_file')
                    ->label('Main image upload')
                    ->disk('webroot')
                    ->directory('about-section')
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
                    ->helperText('Optional if you set a path or URL below.')
                    ->nullable(),
                TextInput::make('hero_external')
                    ->label('Main image path or URL')
                    ->maxLength(2048)
                    ->helperText('Example: images/about-interia.png')
                    ->nullable(),
                TextInput::make('hero_image_alt')
                    ->label('Main image alt text')
                    ->maxLength(255)
                    ->nullable(),
                FileUpload::make('footer_icon_file')
                    ->label('Location pin icon upload')
                    ->disk('webroot')
                    ->directory('about-section-icons')
                    ->preserveFilenames()
                    ->previewable(false)
                    ->fetchFileInformation(false)
                    ->maxSize(12288)
                    ->acceptedFileTypes([
                        'image/svg+xml',
                        'image/png',
                        'image/jpeg',
                        'image/webp',
                    ])
                    ->helperText('Optional if you set a path or URL below.')
                    ->nullable(),
                TextInput::make('footer_external')
                    ->label('Location icon path or URL')
                    ->maxLength(2048)
                    ->helperText('Example: images/icon-place.svg')
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
