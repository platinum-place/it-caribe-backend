<?php

namespace App\Filament\Resources\Vehicle\Vehicles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VehicleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('updated_by')
                    ->numeric(),
                TextEntry::make('deleted_by')
                    ->numeric(),
                TextEntry::make('vehicleMake.name'),
                TextEntry::make('vehicleModel.name'),
                TextEntry::make('vehicleType.name'),
                TextEntry::make('vehicleUse.name'),
                TextEntry::make('vehicleActivity.name'),
                TextEntry::make('vehicleLoanType.name'),
                TextEntry::make('vehicleUtility.name'),
                TextEntry::make('vehicle_year')
                    ->numeric(),
                TextEntry::make('chassis'),
                TextEntry::make('license_plate'),
            ]);
    }
}
