<?php

namespace App\Filament\Resources\Vehicle\VehicleColors;

use App\Filament\Resources\Vehicle\VehicleColors\Pages\CreateVehicleColor;
use App\Filament\Resources\Vehicle\VehicleColors\Pages\EditVehicleColor;
use App\Filament\Resources\Vehicle\VehicleColors\Pages\ListVehicleColors;
use App\Filament\Resources\Vehicle\VehicleColors\Pages\ViewVehicleColor;
use App\Filament\Resources\Vehicle\VehicleColors\Schemas\VehicleColorForm;
use App\Filament\Resources\Vehicle\VehicleColors\Schemas\VehicleColorInfolist;
use App\Filament\Resources\Vehicle\VehicleColors\Tables\VehicleColorsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Models\VehicleColor;

class VehicleColorResource extends Resource
{
    protected static ?string $model = VehicleColor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

    public static function form(Schema $schema): Schema
    {
        return VehicleColorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleColorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleColorsTable::configure($table);
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
            'index' => ListVehicleColors::route('/'),
            'create' => CreateVehicleColor::route('/create'),
            'view' => ViewVehicleColor::route('/{record}'),
            'edit' => EditVehicleColor::route('/{record}/edit'),
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
