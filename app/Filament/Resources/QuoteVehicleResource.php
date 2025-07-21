<?php

namespace App\Filament\Resources;

use App\Filament\Exports\QuoteVehicleExporter;
use App\Models\QuoteVehicle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteVehicleResource extends Resource
{
    protected static ?string $model = QuoteVehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('Quote vehicle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Quote vehicles');
    }

    public static function getNavigationGroup(): string
    {
        return __('Estimate');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('quote.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicleMake.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicleModel.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicleType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicleUse.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicleActivity.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_amount')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->exporter(QuoteVehicleExporter::class),
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
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
            'index' => \App\Filament\Resources\QuoteVehicleResource\Pages\ListQuoteVehicles::route('/'),
            'create' => \App\Filament\Resources\QuoteVehicleResource\Pages\CreateQuoteVehicle::route('/create'),
            'view' => \App\Filament\Resources\QuoteVehicleResource\Pages\ViewQuoteVehicle::route('/{record}'),
            'edit' => \App\Filament\Resources\QuoteVehicleResource\Pages\EditQuoteVehicle::route('/{record}/edit'),
            'emit' => \App\Filament\Resources\QuoteVehicleResource\Pages\EmitQuoteVehicle::route('/{record}/emit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
