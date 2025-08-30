<?php

namespace App\Filament\Resources\Vehicle\VehicleModels\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VehicleModelInfolist
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
                TextEntry::make('name'),
                TextEntry::make('code'),
                TextEntry::make('vehicle_utility_id')
                    ->numeric(),
                TextEntry::make('vehicle_make_id')
                    ->numeric(),
                TextEntry::make('vehicle_type_id')
                    ->numeric(),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('updated_by')
                    ->numeric(),
                TextEntry::make('deleted_by')
                    ->numeric(),
            ]);
    }
}
