<?php

namespace App\Filament\Resources\PricingSections\RelationManagers;

use App\Models\PricingAddonCard;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
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

class PricingAddonCardsRelationManager extends RelationManager
{
    protected static string $relationship = 'addonCards';

    protected static ?string $title = 'Infrastructure add-on cards';

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
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('footer_description')
                    ->columnSpanFull()
                    ->nullable(),
                FileUpload::make('icon_file')
                    ->label('Upload icon')
                    ->disk('webroot')
                    ->directory('pricing-addon-icons')
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
                    ->helperText('Example: images/icon-server-pricing.svg')
                    ->nullable(),
                Repeater::make('rows')
                    ->label('Price rows')
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('amount')
                            ->required()
                            ->maxLength(64)
                            ->helperText('Bold part, e.g. $150 or 5–10%'),
                        TextInput::make('unit')
                            ->maxLength(32)
                            ->helperText('Smaller suffix, e.g. /mo or /spend')
                            ->nullable(),
                    ])
                    ->default([])
                    ->collapsible()
                    ->columnSpanFull()
                    ->minItems(1)
                    ->addActionLabel('Add row'),
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
                ImageColumn::make('icon_path')
                    ->label('Icon')
                    ->square()
                    ->height(36)
                    ->checkFileExistence(false)
                    ->getStateUsing(function (PricingAddonCard $record): ?string {
                        $url = $record->resolvedIconUrl();

                        return $url !== '' ? $url : null;
                    }),
                TextColumn::make('title')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->using(function (array $data, HasActions&HasSchemas $livewire) use ($rm): Model {
                        $payload = $rm->hydrateIconAndRowsForSave($data);

                        return $livewire->getRelationship()->create($payload);
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->mutateRecordDataUsing(fn (array $data): array => $rm->hydrateIconPathForForm($data))
                    ->using(function (array $data, HasActions&HasSchemas $livewire, Model $record, ?Table $table) use ($rm): void {
                        $record->update($rm->hydrateIconAndRowsForSave($data));
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
    protected function hydrateIconAndRowsForSave(array $data): array
    {
        $external = trim((string) ($data['external_icon'] ?? ''));
        $file = $data['icon_file'] ?? null;

        if ($external !== '') {
            $data['icon_path'] = $external;
        } elseif ($file instanceof UploadedFile) {
            $data['icon_path'] = $file->store('pricing-addon-icons', 'webroot');
        } elseif (is_string($file) && $file !== '') {
            $data['icon_path'] = $file;
        } elseif (is_array($file) && $file !== []) {
            $data['icon_path'] = (string) reset($file);
        }

        $rows = $data['rows'] ?? [];
        if (is_array($rows)) {
            $data['rows'] = collect($rows)
                ->map(function (mixed $row): ?array {
                    if (! is_array($row)) {
                        return null;
                    }
                    $label = trim((string) ($row['label'] ?? ''));
                    $amount = trim((string) ($row['amount'] ?? ''));
                    $unit = trim((string) ($row['unit'] ?? ''));

                    if ($label === '' && $amount === '') {
                        return null;
                    }

                    return [
                        'label' => $label,
                        'amount' => $amount,
                        'unit' => $unit !== '' ? $unit : null,
                    ];
                })
                ->filter()
                ->values()
                ->all();
        } else {
            $data['rows'] = [];
        }

        return Arr::except($data, ['icon_file', 'external_icon']);
    }
}
