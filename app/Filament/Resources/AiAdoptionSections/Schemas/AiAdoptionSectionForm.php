<?php

namespace App\Filament\Resources\AiAdoptionSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AiAdoptionSectionForm
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
                    ->helperText('Use "home" for the homepage AI adoption block.'),
                TextInput::make('label')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Small label above the main title (e.g. “AI Adoption”).'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(512),
                Textarea::make('subtitle')
                    ->columnSpanFull()
                    ->helperText('Supporting paragraph under the title.'),
                TextInput::make('framework_heading')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Heading in the lower section (e.g. “The Executive IT Framework”).'),
                Textarea::make('framework_description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('dashboard_image_file')
                    ->label('Dashboard image upload')
                    ->disk('webroot')
                    ->directory('ai-adoption')
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
                TextInput::make('dashboard_external')
                    ->label('Dashboard image path or URL')
                    ->maxLength(2048)
                    ->helperText('Example: images/ai-system-dashboard.png or https://...')
                    ->nullable(),
                TextInput::make('dashboard_image_alt')
                    ->label('Dashboard image alt text')
                    ->maxLength(255)
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
