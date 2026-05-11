<?php

namespace App\Filament\Resources\GallerySections\RelationManagers;

use App\Models\GalleryItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Mosaic images';

    protected static bool $shouldSkipAuthorization = true;

    protected static bool $shouldCheckPolicyExistence = false;

    public function form(Schema $schema): Schema
    {
        $slotOptions = collect(GalleryItem::layoutSlotKeys())
            ->mapWithKeys(fn (string $key): array => [$key => (string) str($key)->replace('-', ' ')->title()])
            ->all();

        return $schema
            ->components([
                Select::make('shape_key')
                    ->label('Layout slot')
                    ->options($slotOptions)
                    ->required()
                    ->native(false)
                    ->helperText('Each slot matches a fixed position in the collage.'),
                FileUpload::make('image_file')
                    ->label('Upload image')
                    ->image()
                    ->disk('webroot')
                    ->directory('gallery-mosaic')
                    ->preserveFilenames()
                    ->previewable(false)
                    ->fetchFileInformation(false)
                    ->maxSize(12288)
                    ->nullable(),
                TextInput::make('external_image_url')
                    ->label('External image URL')
                    ->url()
                    ->maxLength(2048)
                    ->helperText('Optional. Overrides upload when set.')
                    ->nullable(),
                TextInput::make('image_alt')
                    ->label('Alt text')
                    ->maxLength(255)
                    ->nullable(),
                Toggle::make('tone_muted')
                    ->label('Muted / grayscale')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        /** @var self $rm */
        $rm = $this;

        return $table
            ->recordTitleAttribute('shape_key')
            ->columns([
                TextColumn::make('shape_key')
                    ->label('Slot')
                    ->formatStateUsing(fn (?string $state): string => $state ? (string) str($state)->replace('-', ' ')->title() : '')
                    ->searchable(),
                ImageColumn::make('image_path')
                    ->label('Preview')
                    ->height(40)
                    ->checkFileExistence(false)
                    ->getStateUsing(fn (GalleryItem $record): string => $record->resolvedImageUrl()),
                TextColumn::make('image_alt')
                    ->limit(40)
                    ->toggleable(),
                IconColumn::make('tone_muted')
                    ->boolean(),
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
            $data['image_path'] = $file->store('gallery-mosaic', 'webroot');
        } elseif (is_string($file) && $file !== '') {
            $data['image_path'] = $file;
        } elseif (is_array($file) && $file !== []) {
            $data['image_path'] = (string) reset($file);
        }

        return Arr::except($data, ['image_file', 'external_image_url']);
    }
}
