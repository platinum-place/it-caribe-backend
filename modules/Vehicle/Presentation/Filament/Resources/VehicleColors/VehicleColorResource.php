<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleColors;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleColor;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\Pages\CreateVehicleColor;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\Pages\EditVehicleColor;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\Pages\ListVehicleColors;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\Pages\ViewVehicleColor;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\Schemas\VehicleColorForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\Schemas\VehicleColorInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColors\Tables\VehicleColorsTable;

class VehicleColorResource extends Resource
{
    protected static ?string $model = VehicleColor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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
