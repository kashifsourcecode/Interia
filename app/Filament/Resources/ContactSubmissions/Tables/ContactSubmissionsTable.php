<?php

namespace App\Filament\Resources\ContactSubmissions\Tables;

use App\Models\ContactSubmission;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactSubmissionsTable
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
                TextColumn::make('first_name')
                    ->label('Name')
                    ->formatStateUsing(fn (ContactSubmission $record): string => $record->fullName())
                    ->searchable(['first_name', 'last_name']),
                TextColumn::make('email')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('company')
                    ->toggleable()
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('service')
                    ->badge()
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'read' => 'success',
                        'archived' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        ContactSubmission::STATUS_NEW => 'New',
                        ContactSubmission::STATUS_READ => 'Read',
                        ContactSubmission::STATUS_ARCHIVED => 'Archived',
                    ]),
                SelectFilter::make('service')
                    ->options(function (): array {
                        return ContactSubmission::query()
                            ->whereNotNull('service')
                            ->distinct()
                            ->pluck('service', 'service')
                            ->toArray();
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('markRead')
                    ->label('Mark read')
                    ->icon('heroicon-o-check')
                    ->visible(fn (ContactSubmission $record): bool => $record->status === ContactSubmission::STATUS_NEW)
                    ->action(fn (ContactSubmission $record) => $record->markAsRead()),
                Action::make('archive')
                    ->label('Archive')
                    ->icon('heroicon-o-archive-box')
                    ->color('gray')
                    ->visible(fn (ContactSubmission $record): bool => $record->status !== ContactSubmission::STATUS_ARCHIVED)
                    ->action(function (ContactSubmission $record): void {
                        $record->update(['status' => ContactSubmission::STATUS_ARCHIVED]);
                    }),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
