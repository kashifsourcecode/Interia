<?php

namespace App\Filament\Resources\EnterpriseQuoteRequests\Tables;

use App\Models\EnterpriseQuoteRequest;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EnterpriseQuoteRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('company')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('first_name')
                    ->label('Contact')
                    ->formatStateUsing(fn (EnterpriseQuoteRequest $record): string => $record->fullName())
                    ->searchable(['first_name', 'last_name']),
                TextColumn::make('email')
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('industry')
                    ->badge()
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('employee_count')
                    ->label('Employees')
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('endpoint_count')
                    ->label('Endpoints')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('—'),
                TextColumn::make('budget_range')
                    ->label('Budget')
                    ->badge()
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('timeline')
                    ->badge()
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'contacted' => 'info',
                        'quoted' => 'primary',
                        'won' => 'success',
                        'lost' => 'danger',
                        'archived' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        EnterpriseQuoteRequest::STATUS_NEW => 'New',
                        EnterpriseQuoteRequest::STATUS_CONTACTED => 'Contacted',
                        EnterpriseQuoteRequest::STATUS_QUOTED => 'Quoted',
                        EnterpriseQuoteRequest::STATUS_WON => 'Won',
                        EnterpriseQuoteRequest::STATUS_LOST => 'Lost',
                        EnterpriseQuoteRequest::STATUS_ARCHIVED => 'Archived',
                    ]),
                SelectFilter::make('industry')
                    ->options(function (): array {
                        return EnterpriseQuoteRequest::query()
                            ->whereNotNull('industry')
                            ->distinct()
                            ->pluck('industry', 'industry')
                            ->toArray();
                    }),
                SelectFilter::make('budget_range')
                    ->label('Budget range')
                    ->options(function (): array {
                        return EnterpriseQuoteRequest::query()
                            ->whereNotNull('budget_range')
                            ->distinct()
                            ->pluck('budget_range', 'budget_range')
                            ->toArray();
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('markContacted')
                    ->label('Mark Contacted')
                    ->icon('heroicon-o-check')
                    ->visible(fn (EnterpriseQuoteRequest $record): bool => $record->status === EnterpriseQuoteRequest::STATUS_NEW)
                    ->action(fn (EnterpriseQuoteRequest $record) => $record->markAsRead()),
                Action::make('archive')
                    ->label('Archive')
                    ->icon('heroicon-o-archive-box')
                    ->color('gray')
                    ->visible(fn (EnterpriseQuoteRequest $record): bool => $record->status !== EnterpriseQuoteRequest::STATUS_ARCHIVED)
                    ->action(fn (EnterpriseQuoteRequest $record) => $record->update(['status' => EnterpriseQuoteRequest::STATUS_ARCHIVED])),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
