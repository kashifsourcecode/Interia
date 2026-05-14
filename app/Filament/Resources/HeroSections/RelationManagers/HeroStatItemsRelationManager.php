<?php

namespace App\Filament\Resources\HeroSections\RelationManagers;

use App\Models\HeroStatItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class HeroStatItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'statItems';

    protected static ?string $title = 'Stats bar';

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
                TextInput::make('label')
                    ->required()
                    ->maxLength(255),
                TextInput::make('count_target')
                    ->label('Animated number')
                    ->numeric()
                    ->step(0.01)
                    ->helperText('Used for the counting animation. Leave empty if you use “Static number” below.')
                    ->nullable(),
                Toggle::make('count_as_decimal')
                    ->label('Animate as decimal')
                    ->helperText('Enable for values like 99.9.')
                    ->default(false),
                TextInput::make('suffix_after_count')
                    ->label('Suffix after number')
                    ->maxLength(32)
                    ->helperText('Shown after the animated digits on the same line (e.g. min, +).')
                    ->nullable(),
                TextInput::make('static_display')
                    ->label('Static number')
                    ->maxLength(64)
                    ->helperText('Optional. When set, replaces the animated value (no counter), e.g. “24/7”.')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('label')
                    ->searchable(),
                TextColumn::make('count_target')
                    ->label('Target')
                    ->placeholder('—'),
                TextColumn::make('static_display')
                    ->label('Static')
                    ->placeholder('—'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->using(function (array $data, HasActions&HasSchemas $livewire): Model {
                        self::assertStatPayload($data);

                        return $livewire->getRelationship()->create(self::normalizeStatPayload($data));
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->using(function (array $data, HasActions&HasSchemas $livewire, Model $record, ?Table $table): void {
                        self::assertStatPayload($data);
                        /** @var HeroStatItem $record */
                        $record->update(self::normalizeStatPayload($data));
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
     */
    private static function assertStatPayload(array $data): void
    {
        $static = trim((string) ($data['static_display'] ?? ''));
        $rawTarget = $data['count_target'] ?? null;
        $hasTarget = $rawTarget !== null && $rawTarget !== '';

        if ($static === '' && ! $hasTarget) {
            throw ValidationException::withMessages([
                'count_target' => 'Set an animated number or a static number.',
            ]);
        }
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private static function normalizeStatPayload(array $data): array
    {
        $static = trim((string) ($data['static_display'] ?? ''));
        if ($static !== '') {
            $data['static_display'] = $static;
            $data['count_target'] = null;
            $data['count_as_decimal'] = false;
            $data['suffix_after_count'] = null;
        } else {
            $data['static_display'] = null;
        }

        $rawTarget = $data['count_target'] ?? null;
        if ($rawTarget === null || $rawTarget === '') {
            $data['count_target'] = null;
        }

        $suffix = trim((string) ($data['suffix_after_count'] ?? ''));
        $data['suffix_after_count'] = $suffix === '' ? null : $suffix;

        return $data;
    }
}
