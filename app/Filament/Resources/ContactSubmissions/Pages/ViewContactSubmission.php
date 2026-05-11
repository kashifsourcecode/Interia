<?php

namespace App\Filament\Resources\ContactSubmissions\Pages;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Models\ContactSubmission;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

class ViewContactSubmission extends ViewRecord
{
    protected static string $resource = ContactSubmissionResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        /** @var ContactSubmission $submission */
        $submission = $this->getRecord();
        $submission->markAsRead();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('replyByEmail')
                ->label('Reply by email')
                ->icon('heroicon-o-envelope')
                ->url(fn (ContactSubmission $record): string => 'mailto:'.$record->email)
                ->openUrlInNewTab(),
            Action::make('archive')
                ->label('Archive')
                ->icon('heroicon-o-archive-box')
                ->color('gray')
                ->visible(fn (ContactSubmission $record): bool => $record->status !== ContactSubmission::STATUS_ARCHIVED)
                ->action(function (ContactSubmission $record): void {
                    $record->update(['status' => ContactSubmission::STATUS_ARCHIVED]);
                }),
            DeleteAction::make(),
        ];
    }
}
