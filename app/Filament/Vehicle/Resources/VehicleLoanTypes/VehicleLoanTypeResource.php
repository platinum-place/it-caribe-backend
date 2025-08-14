<?php

namespace App\Filament\Vehicle\Resources\VehicleLoanTypes;

use App\Filament\Vehicle\Resources\VehicleLoanTypes\Pages\CreateVehicleLoanType;
use App\Filament\Vehicle\Resources\VehicleLoanTypes\Pages\EditVehicleLoanType;
use App\Filament\Vehicle\Resources\VehicleLoanTypes\Pages\ListVehicleLoanTypes;
use App\Filament\Vehicle\Resources\VehicleLoanTypes\Pages\ViewVehicleLoanType;
use App\Filament\Vehicle\Resources\VehicleLoanTypes\Schemas\VehicleLoanTypeForm;
use App\Filament\Vehicle\Resources\VehicleLoanTypes\Schemas\VehicleLoanTypeInfolist;
use App\Filament\Vehicle\Resources\VehicleLoanTypes\Tables\VehicleLoanTypesTable;
use App\Models\Vehicle\VehicleLoanType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleLoanTypeResource extends Resource
{
    protected static ?string $model = VehicleLoanType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VehicleLoanTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleLoanTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleLoanTypesTable::configure($table);
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
            'index' => ListVehicleLoanTypes::route('/'),
            'create' => CreateVehicleLoanType::route('/create'),
            'view' => ViewVehicleLoanType::route('/{record}'),
            'edit' => EditVehicleLoanType::route('/{record}/edit'),
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
