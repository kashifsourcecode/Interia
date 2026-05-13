<?php

namespace App\Filament\Resources\EnterpriseQuoteRequests;

use App\Filament\Resources\EnterpriseQuoteRequests\Pages\ListEnterpriseQuoteRequests;
use App\Filament\Resources\EnterpriseQuoteRequests\Pages\ViewEnterpriseQuoteRequest;
use App\Filament\Resources\EnterpriseQuoteRequests\Schemas\EnterpriseQuoteRequestInfolist;
use App\Filament\Resources\EnterpriseQuoteRequests\Tables\EnterpriseQuoteRequestsTable;
use App\Models\EnterpriseQuoteRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EnterpriseQuoteRequestResource extends Resource
{
    protected static ?string $model = EnterpriseQuoteRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static string|UnitEnum|null $navigationGroup = 'Submissions';

    protected static ?string $navigationLabel = 'Enterprise Quote Requests';

    protected static ?string $pluralModelLabel = 'Enterprise quote requests';

    protected static ?string $modelLabel = 'Enterprise quote request';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'company';

    public static function getNavigationBadge(): ?string
    {
        $count = EnterpriseQuoteRequest::query()
            ->where('status', EnterpriseQuoteRequest::STATUS_NEW)
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function infolist(Schema $schema): Schema
    {
        return EnterpriseQuoteRequestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EnterpriseQuoteRequestsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEnterpriseQuoteRequests::route('/'),
            'view' => ViewEnterpriseQuoteRequest::route('/{record}'),
        ];
    }
}
