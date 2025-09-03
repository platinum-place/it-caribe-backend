<?php

namespace App\Filament\Branch\Resources\QuoteVehicles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class QuoteVehicleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->columns()
                    ->activeTab(3)
                    ->tabs([
                        Tab::make('Cotización')
                            ->schema([
                                TextEntry::make('quote.start_date')
                                    ->label('Fecha de inicio'),
                                TextEntry::make('quote.end_date')
                                    ->label('Fecha de fin'),
                                TextEntry::make('quote.status.name')
                                    ->label('Estado'),
                                TextEntry::make('quote.type.name')
                                    ->label('Tipo de cotización'),
                            ]),
                        Tab::make('Deudor')
                            ->schema([
                                TextEntry::make('quote.lead.first_name')
                                    ->label('Nombre'),
                                TextEntry::make('quote.lead.last_name')
                                    ->label('Apellido'),
                                TextEntry::make('quote.lead.identity_number')
                                    ->label('Cédula'),
                                TextEntry::make('quote.lead.birth_date')
                                    ->label('Fecha de nacimiento'),
                                TextEntry::make('quote.lead.email')
                                    ->label('Correo electrónico'),
                                TextEntry::make('quote.lead.mobile_phone')
                                    ->label('Celular'),
                                TextEntry::make('quote.lead.home_phone')
                                    ->label('Teléfono residencial'),
                                TextEntry::make('quote.lead.work_phone')
                                    ->label('Teléfono laboral'),
                                TextEntry::make('quote.lead.address')
                                    ->label('Dirección'),
                                TextEntry::make('quote.lead.type.name')
                                    ->label('Tipo de cliente'),
                            ]),
                        Tab::make('Vehículo')
                            ->schema([
                                TextEntry::make('vehicle.vehicleMake.name')
                                    ->label('Marca del vehículo'),
                                TextEntry::make('vehicle.vehicleModel.name')
                                    ->label('Modelo del vehículo'),
                                TextEntry::make('vehicle.vehicleType.name')
                                    ->label('Tipo de vehículo'),
                                TextEntry::make('vehicle.vehicleUse.name')
                                    ->label('Uso del vehículo'),
                                TextEntry::make('vehicle.vehicleUtility.name')
                                    ->label('Utilidad del vehículo'),
                                TextEntry::make('vehicle_amount')
                                    ->label('Suma asegurada')
                                    ->state(fn ($record) => number_format($record->vehicle_amount, 2))
                                    ->prefix('RD$'),
                            ]),
                    ]),
            ]);
    }
}
