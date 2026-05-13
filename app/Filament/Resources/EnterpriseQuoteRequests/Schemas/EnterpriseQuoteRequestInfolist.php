<?php

namespace App\Filament\Resources\EnterpriseQuoteRequests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EnterpriseQuoteRequestInfolist
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
                        TextEntry::make('job_title')->placeholder('—'),
                        TextEntry::make('preferred_contact')->label('Preferred contact')->placeholder('—')->badge(),
                    ]),

                Section::make('Company')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('company'),
                        TextEntry::make('website')
                            ->placeholder('—')
                            ->url(fn ($record): ?string => $record->website ? (str_starts_with($record->website, 'http') ? $record->website : 'https://'.$record->website) : null)
                            ->openUrlInNewTab(),
                        TextEntry::make('industry')->placeholder('—'),
                        TextEntry::make('current_it_setup')->label('Current IT setup')->placeholder('—'),
                        TextEntry::make('employee_count')->label('Employees')->placeholder('—'),
                        TextEntry::make('endpoint_count')->label('Endpoints / devices')->placeholder('—'),
                        TextEntry::make('location_count')->label('Locations / sites')->placeholder('—'),
                    ]),

                Section::make('Scope')
                    ->schema([
                        TextEntry::make('services_needed')
                            ->label('Services needed')
                            ->placeholder('—')
                            ->badge()
                            ->separator(',')
                            ->columnSpanFull(),
                        TextEntry::make('cloud_platforms')
                            ->label('Cloud platforms')
                            ->placeholder('—')
                            ->badge()
                            ->separator(',')
                            ->columnSpanFull(),
                        TextEntry::make('compliance_needs')
                            ->label('Compliance requirements')
                            ->placeholder('—')
                            ->badge()
                            ->separator(',')
                            ->columnSpanFull(),
                    ]),

                Section::make('Budget & timeline')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('budget_range')->label('Budget range')->placeholder('—')->badge(),
                        TextEntry::make('timeline')->placeholder('—')->badge(),
                    ]),

                Section::make('Additional details')
                    ->schema([
                        TextEntry::make('details')
                            ->placeholder('— no additional details —')
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
                                'contacted' => 'info',
                                'quoted' => 'primary',
                                'won' => 'success',
                                'lost' => 'danger',
                                'archived' => 'gray',
                                default => 'gray',
                            }),
                        TextEntry::make('created_at')->label('Received')->dateTime(),
                        TextEntry::make('read_at')->label('Read at')->dateTime()->placeholder('—'),
                        TextEntry::make('ip_address')->label('IP address')->placeholder('—'),
                        TextEntry::make('user_agent')
                            ->label('User agent')
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
