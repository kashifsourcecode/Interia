<?php

namespace App\Filament\Resources\IndustrySections\RelationManagers;

use App\Models\IndustryCard;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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

class IndustryCardsRelationManager extends RelationManager
{
    protected static string $relationship = 'cards';

    protected static ?string $title = 'Industry cards';

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
                Select::make('mosaic_column')
                    ->label('Column')
                    ->options([
                        'left' => 'Left',
                        'center' => 'Center',
                        'right' => 'Right',
                    ])
                    ->required()
                    ->native(false),
                Select::make('media_position')
                    ->label('Image position')
                    ->options([
                        'image_first' => 'Image above text',
                        'text_first' => 'Text above image',
                    ])
                    ->required()
                    ->native(false),
                Select::make('aspect_preset')
                    ->label('Image frame')
                    ->options([
                        'default' => 'Default',
                        'gaming' => 'Wide (gaming style)',
                    ])
                    ->default('default')
                    ->required()
                    ->native(false),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_file')
                    ->label('Upload image')
                    ->disk('webroot')
                    ->directory('industry-section-cards')
                    ->preserveFilenames()
                    ->previewable(false)
                    ->fetchFileInformation(false)
                    ->maxSize(20480)
                    ->acceptedFileTypes([
                        'image/png',
                        'image/jpeg',
                        'image/webp',
                    ])
                    ->helperText('Optional if you set a public path or URL below.')
                    ->nullable(),
                TextInput::make('external_image')
                    ->label('Image path or URL')
                    ->maxLength(2048)
                    ->helperText('Example: images/industries/small-business.png')
                    ->nullable(),
                TextInput::make('image_alt')
                    ->label('Image alt text')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        /** @var self $rm */
        $rm = $this;

        return $table
            ->recordTitleAttribute('title')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('mosaic_column')
                    ->badge(),
                TextColumn::make('media_position')
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->height(40)
                    ->checkFileExistence(false)
                    ->getStateUsing(function (IndustryCard $record): ?string {
                        $url = $record->resolvedImageUrl();

                        return $url !== '' ? $url : null;
                    }),
                TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->using(function (array $data, HasActions&HasSchemas $livewire) use ($rm): Model {
                        $payload = $rm->hydrateImagePathForSave($data);

                        return $livewire->getRelationship()->create($payload);
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->mutateRecordDataUsing(fn (array $data): array => $rm->hydrateImagePathForForm($data))
                    ->using(function (array $data, HasActions&HasSchemas $livewire, Model $record, ?Table $table) use ($rm): void {
                        $record->update($rm->hydrateImagePathForSave($data));
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
    protected function hydrateImagePathForForm(array $data): array
    {
        $path = trim((string) ($data['image_path'] ?? ''));

        if ($path === '') {
            $data['image_file'] = null;
            $data['external_image'] = null;

            return $data;
        }

        if (
            Str::startsWith($path, ['http://', 'https://'])
            || Str::startsWith(ltrim($path, '/'), 'images/')
        ) {
            $data['external_image'] = $path;
            $data['image_file'] = null;
        } else {
            $data['image_file'] = $path;
            $data['external_image'] = null;
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function hydrateImagePathForSave(array $data): array
    {
        $external = trim((string) ($data['external_image'] ?? ''));
        $file = $data['image_file'] ?? null;

        if ($external !== '') {
            $data['image_path'] = $external;
        } elseif ($file instanceof UploadedFile) {
            $data['image_path'] = $file->store('industry-section-cards', 'webroot');
        } elseif (is_string($file) && $file !== '') {
            $data['image_path'] = $file;
        } elseif (is_array($file) && $file !== []) {
            $data['image_path'] = (string) reset($file);
        }

        return Arr::except($data, ['image_file', 'external_image']);
    }
}
