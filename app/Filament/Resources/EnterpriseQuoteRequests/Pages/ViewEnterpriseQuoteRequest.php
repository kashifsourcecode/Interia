<?php

namespace App\Filament\Resources\EnterpriseQuoteRequests\Pages;

use App\Filament\Resources\EnterpriseQuoteRequests\EnterpriseQuoteRequestResource;
use App\Models\EnterpriseQuoteRequest;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEnterpriseQuoteRequest extends ViewRecord
{
    protected static string $resource = EnterpriseQuoteRequestResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        /** @var EnterpriseQuoteRequest $submission */
        $submission = $this->getRecord();
        $submission->markAsRead();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('replyByEmail')
                ->label('Reply by email')
                ->icon('heroicon-o-envelope')
                ->url(fn (EnterpriseQuoteRequest $record): string => 'mailto:'.$record->email)
                ->openUrlInNewTab(),
            Action::make('markQuoted')
                ->label('Mark as Quoted')
                ->icon('heroicon-o-document-currency-dollar')
                ->color('info')
                ->visible(fn (EnterpriseQuoteRequest $record): bool => ! in_array($record->status, [
                    EnterpriseQuoteRequest::STATUS_QUOTED,
                    EnterpriseQuoteRequest::STATUS_WON,
                    EnterpriseQuoteRequest::STATUS_LOST,
                    EnterpriseQuoteRequest::STATUS_ARCHIVED,
                ], true))
                ->action(fn (EnterpriseQuoteRequest $record) => $record->update(['status' => EnterpriseQuoteRequest::STATUS_QUOTED])),
            Action::make('markWon')
                ->label('Mark as Won')
                ->icon('heroicon-o-trophy')
                ->color('success')
                ->visible(fn (EnterpriseQuoteRequest $record): bool => $record->status !== EnterpriseQuoteRequest::STATUS_WON)
                ->action(fn (EnterpriseQuoteRequest $record) => $record->update(['status' => EnterpriseQuoteRequest::STATUS_WON])),
            Action::make('markLost')
                ->label('Mark as Lost')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn (EnterpriseQuoteRequest $record): bool => $record->status !== EnterpriseQuoteRequest::STATUS_LOST)
                ->action(fn (EnterpriseQuoteRequest $record) => $record->update(['status' => EnterpriseQuoteRequest::STATUS_LOST])),
            Action::make('archive')
                ->label('Archive')
                ->icon('heroicon-o-archive-box')
                ->color('gray')
                ->visible(fn (EnterpriseQuoteRequest $record): bool => $record->status !== EnterpriseQuoteRequest::STATUS_ARCHIVED)
                ->action(fn (EnterpriseQuoteRequest $record) => $record->update(['status' => EnterpriseQuoteRequest::STATUS_ARCHIVED])),
            DeleteAction::make(),
        ];
    }
}
