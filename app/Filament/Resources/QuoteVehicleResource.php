<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteVehicleResource\Pages;
use App\Models\QuoteVehicle;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteVehicleResource extends Resource
{
    protected static ?string $model = QuoteVehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListQuoteVehicles::route('/'),
            'create' => Pages\CreateQuoteVehicle::route('/create'),
            'view' => Pages\ViewQuoteVehicle::route('/{record}'),
            'edit' => Pages\EditQuoteVehicle::route('/{record}/edit'),
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
