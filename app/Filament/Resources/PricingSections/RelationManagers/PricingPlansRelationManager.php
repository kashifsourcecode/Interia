<?php

namespace App\Filament\Resources\PricingSections\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PricingPlansRelationManager extends RelationManager
{
    protected static string $relationship = 'plans';

    protected static ?string $title = 'Pricing plans';

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
                TextInput::make('name')
                    ->required()
                    ->maxLength(120),
                TextInput::make('tagline')
                    ->maxLength(255)
                    ->nullable(),
                TextInput::make('currency_symbol')
                    ->default('$')
                    ->maxLength(8)
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->maxLength(32)
                    ->helperText('Display amount only, e.g. 499 or 1,299'),
                TextInput::make('period')
                    ->default('/month')
                    ->maxLength(32)
                    ->required(),
                Repeater::make('features')
                    ->label('Feature list')
                    ->schema([
                        TextInput::make('line')
                            ->required()
                            ->maxLength(512),
                    ])
                    ->default([])
                    ->collapsible()
                    ->columnSpanFull()
                    ->minItems(1)
                    ->addActionLabel('Add feature'),
                TextInput::make('cta_label')
                    ->required()
                    ->maxLength(120),
                TextInput::make('cta_url')
                    ->maxLength(2048)
                    ->helperText('e.g. #contact')
                    ->nullable(),
                Toggle::make('is_featured')
                    ->label('Featured plan (“Most Popular”, filled button)')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('amount'),
                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->using(function (array $data, HasActions&HasSchemas $livewire): Model {
                        $payload = self::normalizeFeaturesPayload($data);

                        return $livewire->getRelationship()->create($payload);
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->using(function (array $data, HasActions&HasSchemas $livewire, Model $record, ?Table $table): void {
                        $record->update(self::normalizeFeaturesPayload($data));
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
    protected static function normalizeFeaturesPayload(array $data): array
    {
        $features = $data['features'] ?? [];
        if (! is_array($features)) {
            $data['features'] = [];

            return $data;
        }

        $data['features'] = collect($features)
            ->map(fn (mixed $row): ?array => is_array($row) ? ['line' => trim((string) ($row['line'] ?? ''))] : null)
            ->filter(fn (?array $row): bool => $row !== null && $row['line'] !== '')
            ->values()
            ->all();

        return $data;
    }
}
