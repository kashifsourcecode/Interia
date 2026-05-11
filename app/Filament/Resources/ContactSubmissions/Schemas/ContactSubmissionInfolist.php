<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('first_name')->label('First name'),
                        TextEntry::make('last_name')->label('Last name'),
                        TextEntry::make('email')
                            ->copyable()
                            ->url(fn ($record): string => 'mailto:'.$record->email),
                        TextEntry::make('phone')
                            ->placeholder('—')
                            ->copyable()
                            ->url(fn ($record): ?string => $record->phone ? 'tel:'.preg_replace('/\s+/', '', $record->phone) : null),
                        TextEntry::make('company')->placeholder('—'),
                        TextEntry::make('service')
                            ->placeholder('—')
                            ->badge(),
                    ]),
                Section::make('Message')
                    ->schema([
                        TextEntry::make('message')
                            ->placeholder('— no message —')
                            ->columnSpanFull()
                            ->extraAttributes(['style' => 'white-space: pre-wrap;']),
                    ]),
                Section::make('Submission details')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'new' => 'warning',
                                'read' => 'success',
                                'archived' => 'gray',
                                default => 'gray',
                            }),
                        TextEntry::make('created_at')
                            ->label('Received')
                            ->dateTime(),
                        TextEntry::make('read_at')
                            ->label('Read at')
                            ->dateTime()
                            ->placeholder('—'),
                        TextEntry::make('ip_address')
                            ->label('IP address')
                            ->placeholder('—'),
                        TextEntry::make('user_agent')
                            ->label('User agent')
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
