<?php

namespace App\Filament\Resources\ContactSections\RelationManagers;

use App\Models\ContactInfoCard;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class InfoCardsRelationManager extends RelationManager
{
    protected static string $relationship = 'infoCards';

    protected static ?string $title = 'Contact info cards';

    protected static bool $shouldSkipAuthorization = true;

    protected static bool $shouldCheckPolicyExistence = false;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                TextInput::make('heading')
                    ->required()
                    ->maxLength(120)
                    ->helperText('Card title (shown in small caps via site CSS).'),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('icon_file')
                    ->label('Upload icon')
                    ->disk('webroot')
                    ->directory('contact-section-icons')
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
                    ->helperText('Optional if you set a public path or URL below.')
                    ->nullable(),
                TextInput::make('external_icon')
                    ->label('Icon path or URL')
                    ->maxLength(2048)
                    ->helperText('Example: images/icon-phone.svg')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        /** @var self $rm */
        $rm = $this;

        return $table
            ->recordTitleAttribute('heading')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('icon_path')
                    ->label('Icon')
                    ->square()
                    ->height(36)
                    ->checkFileExistence(false)
                    ->getStateUsing(function (ContactInfoCard $record): ?string {
                        $url = $record->resolvedIconUrl();

                        return $url !== '' ? $url : null;
                    }),
                TextColumn::make('heading'),
                TextColumn::make('body')
                    ->limit(40),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->using(function (array $data, HasActions&HasSchemas $livewire) use ($rm): Model {
                        $payload = $rm->hydrateIconPathForSave($data);

                        return $livewire->getRelationship()->create($payload);
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->mutateRecordDataUsing(fn (array $data): array => $rm->hydrateIconPathForForm($data))
                    ->using(function (array $data, HasActions&HasSchemas $livewire, Model $record, ?Table $table) use ($rm): void {
                        $record->update($rm->hydrateIconPathForSave($data));
                    }),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function hydrateIconPathForForm(array $data): array
    {
        $path = trim((string) ($data['icon_path'] ?? ''));

        if ($path === '') {
            $data['icon_file'] = null;
            $data['external_icon'] = null;

            return $data;
        }

        if (
            Str::startsWith($path, ['http://', 'https://'])
            || Str::startsWith(ltrim($path, '/'), 'images/')
        ) {
            $data['external_icon'] = $path;
            $data['icon_file'] = null;
        } else {
            $data['icon_file'] = $path;
            $data['external_icon'] = null;
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function hydrateIconPathForSave(array $data): array
    {
        $external = trim((string) ($data['external_icon'] ?? ''));
        $file = $data['icon_file'] ?? null;

        if ($external !== '') {
            $data['icon_path'] = $external;
        } elseif ($file instanceof UploadedFile) {
            $data['icon_path'] = $file->store('contact-section-icons', 'webroot');
        } elseif (is_string($file) && $file !== '') {
            $data['icon_path'] = $file;
        } elseif (is_array($file) && $file !== []) {
            $data['icon_path'] = (string) reset($file);
        }

        return Arr::except($data, ['icon_file', 'external_icon']);
    }
}
