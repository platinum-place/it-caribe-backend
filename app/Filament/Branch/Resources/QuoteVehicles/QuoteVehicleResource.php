<?php

namespace App\Filament\Branch\Resources\QuoteVehicles;

use App\Filament\Branch\Resources\QuoteVehicles\Pages\CreateQuoteVehicle;
use App\Filament\Branch\Resources\QuoteVehicles\Pages\EditQuoteVehicle;
use App\Filament\Branch\Resources\QuoteVehicles\Pages\ListQuoteVehicles;
use App\Filament\Branch\Resources\QuoteVehicles\Pages\ViewQuoteVehicle;
use App\Filament\Branch\Resources\QuoteVehicles\Schemas\QuoteVehicleForm;
use App\Filament\Branch\Resources\QuoteVehicles\Schemas\QuoteVehicleInfolist;
use App\Filament\Branch\Resources\QuoteVehicles\Tables\QuoteVehiclesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Infrastructure\Quotations\Products\Vehicle\Persistence\Models\QuoteVehicle;

class QuoteVehicleResource extends Resource
{
    protected static ?string $model = QuoteVehicle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getModelLabel(): string
    {
        return 'Cotización Plan Auto';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Cotizaciones Plan Auto';
    }

    public static function form(Schema $schema): Schema
    {
        return QuoteVehicleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteVehicleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteVehiclesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LinesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuoteVehicles::route('/'),
            'create' => CreateQuoteVehicle::route('/create'),
            'view' => ViewQuoteVehicle::route('/{record}'),
            'edit' => EditQuoteVehicle::route('/{record}/edit'),
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
