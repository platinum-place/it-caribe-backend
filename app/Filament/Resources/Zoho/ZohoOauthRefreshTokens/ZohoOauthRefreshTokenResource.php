<?php

namespace App\Filament\Resources\Zoho\ZohoOauthRefreshTokens;

use App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Pages\CreateZohoOauthRefreshToken;
use App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Pages\EditZohoOauthRefreshToken;
use App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Pages\ListZohoOauthRefreshTokens;
use App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Pages\ViewZohoOauthRefreshToken;
use App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Schemas\ZohoOauthRefreshTokenForm;
use App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Schemas\ZohoOauthRefreshTokenInfolist;
use App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Tables\ZohoOauthRefreshTokensTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Zoho\Models\ZohoOauthRefreshToken;

class ZohoOauthRefreshTokenResource extends Resource
{
    protected static ?string $model = ZohoOauthRefreshToken::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationGroup(): ?string
    {
        return __('Zoho');
    }

    public static function form(Schema $schema): Schema
    {
        return ZohoOauthRefreshTokenForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ZohoOauthRefreshTokenInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ZohoOauthRefreshTokensTable::configure($table);
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
            'index' => ListZohoOauthRefreshTokens::route('/'),
            'create' => CreateZohoOauthRefreshToken::route('/create'),
            'view' => ViewZohoOauthRefreshToken::route('/{record}'),
            'edit' => EditZohoOauthRefreshToken::route('/{record}/edit'),
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
