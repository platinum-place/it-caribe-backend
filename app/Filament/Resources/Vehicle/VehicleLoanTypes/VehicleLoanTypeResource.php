<?php

namespace App\Filament\Resources\Vehicle\VehicleLoanTypes;

use App\Filament\Resources\Vehicle\VehicleLoanTypes\Pages\CreateVehicleLoanType;
use App\Filament\Resources\Vehicle\VehicleLoanTypes\Pages\EditVehicleLoanType;
use App\Filament\Resources\Vehicle\VehicleLoanTypes\Pages\ListVehicleLoanTypes;
use App\Filament\Resources\Vehicle\VehicleLoanTypes\Pages\ViewVehicleLoanType;
use App\Filament\Resources\Vehicle\VehicleLoanTypes\Schemas\VehicleLoanTypeForm;
use App\Filament\Resources\Vehicle\VehicleLoanTypes\Schemas\VehicleLoanTypeInfolist;
use App\Filament\Resources\Vehicle\VehicleLoanTypes\Tables\VehicleLoanTypesTable;
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

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

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
