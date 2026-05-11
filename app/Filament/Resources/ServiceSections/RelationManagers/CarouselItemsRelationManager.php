<?php

namespace App\Filament\Resources\ServiceSections\RelationManagers;

use App\Models\ServiceCarouselItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
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

class CarouselItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'carouselItems';

    protected static ?string $title = 'Horizontal image strip';

    /** Without policies on {@see ServiceCarouselItem}, Filament hides this manager unless skipped. */
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
                FileUpload::make('image_file')
                    ->label('Upload image')
                    ->image()
                    ->disk('webroot')
                    ->directory('service-carousel')
                    ->preserveFilenames()
                    ->previewable(false)
                    ->fetchFileInformation(false)
                    ->maxSize(12288)
                    ->helperText('Stored under public/service-carousel/ with the original filename. Optional if you use an external image URL below.')
                    ->nullable(),
                TextInput::make('external_image_url')
                    ->label('External image URL')
                    ->url()
                    ->maxLength(2048)
                    ->helperText('Optional. If set, this overrides the uploaded file (e.g. Unsplash).')
                    ->nullable(),
                TextInput::make('caption')
                    ->required()
                    ->maxLength(255),
                TextInput::make('image_alt')
                    ->label('Image alt text')
                    ->maxLength(255)
                    ->helperText('Describe the image for accessibility.')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        /** @var self $rm */
        $rm = $this;

        return $table
            ->recordTitleAttribute('caption')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('image_path')
                    ->label('Preview')
                    ->height(40)
                    ->checkFileExistence(false)
                    ->getStateUsing(fn (ServiceCarouselItem $record): string => $record->resolvedImageUrl()),
                TextColumn::make('caption')
                    ->searchable(),
                TextColumn::make('image_alt')
                    ->toggleable(isToggledHiddenByDefault: true),
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
        $path = (string) ($data['image_path'] ?? '');

        if ($path === '') {
            $data['image_file'] = null;
            $data['external_image_url'] = null;

            return $data;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            $data['external_image_url'] = $path;
            $data['image_file'] = null;
        } else {
            $data['image_file'] = $path;
            $data['external_image_url'] = null;
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function hydrateImagePathForSave(array $data): array
    {
        $external = trim((string) ($data['external_image_url'] ?? ''));
        $file = $data['image_file'] ?? null;

        if ($external !== '') {
            $data['image_path'] = $external;
        } elseif ($file instanceof UploadedFile) {
            $data['image_path'] = $file->store('service-carousel', 'webroot');
        } elseif (is_string($file) && $file !== '') {
            $data['image_path'] = $file;
        } elseif (is_array($file) && $file !== []) {
            $data['image_path'] = (string) reset($file);
        }

        return Arr::except($data, ['image_file', 'external_image_url']);
    }
}
