<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteVehicleResource\Pages;
use App\Filament\Resources\QuoteVehicleResource\RelationManagers;
use App\Models\QuoteVehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteVehicleResource extends Resource
{
    protected static ?string $model = QuoteVehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('quote_id')
                    ->relationship('quote', 'id')
                    ->required(),
                Forms\Components\Select::make('vehicle_id')
                    ->relationship('vehicle', 'id')
                    ->required(),
                Forms\Components\Select::make('vehicle_make_id')
                    ->relationship('vehicleMake', 'name')
                    ->required(),
                Forms\Components\Select::make('vehicle_model_id')
                    ->relationship('vehicleModel', 'name')
                    ->required(),
                Forms\Components\Select::make('vehicle_type_id')
                    ->relationship('vehicleType', 'name')
                    ->required(),
                Forms\Components\Select::make('vehicle_use_id')
                    ->relationship('vehicleUse', 'name')
                    ->required(),
                Forms\Components\Select::make('vehicle_activity_id')
                    ->relationship('vehicleActivity', 'name')
                    ->required(),
                Forms\Components\Select::make('vehicle_accessory_id')
                    ->relationship('vehicleAccessory', 'name')
                    ->required(),
                Forms\Components\Select::make('vehicle_route_id')
                    ->relationship('vehicleRoute', 'name')
                    ->required(),
                Forms\Components\TextInput::make('vehicle_amount')
                    ->required()
                    ->numeric(),
            ]);
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
                Tables\Columns\TextColumn::make('vehicleAccessory.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicleRoute.name')
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
