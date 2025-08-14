<?php

namespace App\Filament\Resources\Vehicles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class VehiclesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('deleted_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_make_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_model_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_type_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_use_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_activity_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_loan_type_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_utility_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_loan_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('chassis')
                    ->searchable(),
                TextColumn::make('license_plate')
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
