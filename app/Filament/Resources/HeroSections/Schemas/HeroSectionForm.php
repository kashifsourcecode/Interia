<?php

namespace App\Filament\Resources\HeroSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeroSectionForm
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
                    ->helperText('Use "home" for the main landing page hero.'),
                TextInput::make('badge_text')
                    ->maxLength(255)
                    ->helperText('Optional pill above the headline. Leave empty to hide.')
                    ->nullable(),
                TextInput::make('headline_line_1')
                    ->required()
                    ->maxLength(255)
                    ->helperText('First line of the headline (e.g. “Technology solutions”).'),
                TextInput::make('headline_line_2_lead')
                    ->maxLength(255)
                    ->helperText('Text before the blue accent on the second line (e.g. “that ”).')
                    ->nullable(),
                TextInput::make('headline_line_2_accent')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Accent portion in brand blue (e.g. “power your business.”).'),
                Textarea::make('subheadline')
                    ->required()
                    ->columnSpanFull(),
                Select::make('background_mode')
                    ->options([
                        'video' => 'Background video',
                        'image' => 'Background image',
                    ])
                    ->required()
                    ->native(false),
                TextInput::make('background_video_path')
                    ->label('Background video path or URL')
                    ->maxLength(2048)
                    ->helperText('Relative to public/ (e.g. videos/it-video.mp4) or a full URL.')
                    ->nullable(),
                FileUpload::make('background_image_file')
                    ->label('Background image upload')
                    ->disk('webroot')
                    ->directory('hero-section')
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
                    ->helperText('Used when mode is “Background image”. Optional if you set a path or URL below.')
                    ->nullable(),
                TextInput::make('background_image_external')
                    ->label('Background image path or URL')
                    ->maxLength(2048)
                    ->helperText('Example: images/hero-bg.jpg or https://...')
                    ->nullable(),
                TextInput::make('primary_cta_label')
                    ->required()
                    ->maxLength(255),
                TextInput::make('primary_cta_url')
                    ->required()
                    ->maxLength(2048)
                    ->helperText('Internal path (e.g. /contact) or full URL.'),
                FileUpload::make('primary_cta_icon_file')
                    ->label('Primary CTA icon upload')
                    ->disk('webroot')
                    ->directory('hero-section-cta-icons')
                    ->preserveFilenames()
                    ->previewable(false)
                    ->fetchFileInformation(false)
                    ->maxSize(4096)
                    ->acceptedFileTypes([
                        'image/svg+xml',
                        'image/png',
                        'image/jpeg',
                        'image/webp',
                    ])
                    ->helperText('Optional. Defaults to the built-in assessment icon when empty.')
                    ->nullable(),
                TextInput::make('primary_cta_icon_external')
                    ->label('Primary CTA icon path or URL')
                    ->maxLength(2048)
                    ->nullable(),
                TextInput::make('secondary_cta_label')
                    ->required()
                    ->maxLength(255),
                TextInput::make('secondary_cta_url')
                    ->required()
                    ->maxLength(2048)
                    ->helperText('Internal path (e.g. /offers) or full URL.'),
                FileUpload::make('secondary_cta_icon_file')
                    ->label('Secondary CTA icon upload')
                    ->disk('webroot')
                    ->directory('hero-section-cta-icons')
                    ->preserveFilenames()
                    ->previewable(false)
                    ->fetchFileInformation(false)
                    ->maxSize(4096)
                    ->acceptedFileTypes([
                        'image/svg+xml',
                        'image/png',
                        'image/jpeg',
                        'image/webp',
                    ])
                    ->helperText('Optional. Defaults to the built-in workshop icon when empty.')
                    ->nullable(),
                TextInput::make('secondary_cta_icon_external')
                    ->label('Secondary CTA icon path or URL')
                    ->maxLength(2048)
                    ->nullable(),
                Toggle::make('secondary_cta_show_arrow')
                    ->label('Show arrow on secondary CTA')
                    ->default(true),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
