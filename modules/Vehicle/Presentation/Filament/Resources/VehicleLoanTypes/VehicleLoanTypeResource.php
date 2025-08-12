<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleLoanType;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Pages\CreateVehicleLoanType;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Pages\EditVehicleLoanType;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Pages\ListVehicleLoanTypes;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Pages\ViewVehicleLoanType;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Schemas\VehicleLoanTypeForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Schemas\VehicleLoanTypeInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypes\Tables\VehicleLoanTypesTable;

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
