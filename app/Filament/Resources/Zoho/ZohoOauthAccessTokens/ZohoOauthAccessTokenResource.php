<?php

namespace App\Filament\Resources\Zoho\ZohoOauthAccessTokens;

use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Pages\CreateZohoOauthAccessToken;
use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Pages\EditZohoOauthAccessToken;
use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Pages\ListZohoOauthAccessTokens;
use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Pages\ViewZohoOauthAccessToken;
use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Schemas\ZohoOauthAccessTokenForm;
use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Schemas\ZohoOauthAccessTokenInfolist;
use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Tables\ZohoOauthAccessTokensTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Zoho\Models\ZohoOauthAccessToken;

class ZohoOauthAccessTokenResource extends Resource
{
    protected static ?string $model = ZohoOauthAccessToken::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationGroup(): ?string
    {
        return __('Zoho');
    }

    public static function form(Schema $schema): Schema
    {
        return ZohoOauthAccessTokenForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ZohoOauthAccessTokenInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ZohoOauthAccessTokensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListZohoOauthAccessTokens::route('/'),
            'create' => CreateZohoOauthAccessToken::route('/create'),
            'view' => ViewZohoOauthAccessToken::route('/{record}'),
            'edit' => EditZohoOauthAccessToken::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
