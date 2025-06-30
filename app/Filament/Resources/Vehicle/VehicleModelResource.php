<?php

namespace App\Filament\Resources\Vehicle;

use App\Filament\Exports\Vehicle\VehicleModelExporter;
use App\Filament\Resources\Vehicle\VehicleModelResource\Pages;
use App\Models\Vehicle\VehicleModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleModelResource extends Resource
{
    protected static ?string $model = VehicleModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('Vehicle model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Vehicle models');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vehicle_make_id')
                    ->required()
                    ->relationship('make', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10)
                    ->label(__('Vehicle make')),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('Vehicle model')),
                Forms\Components\Select::make('vehicle_type_id')
                    ->required()
                    ->relationship('type', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10)
                    ->label(__('Vehicle type')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->label(__('ID')),
                Tables\Columns\TextColumn::make('make.name')
                    ->searchable()
                    ->label(__('Vehicle make')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('Vehicle model')),
                Tables\Columns\TextColumn::make('type.name')
                    ->searchable()
                    ->label(__('Vehicle type')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ExportBulkAction::make()
                        ->exporter(VehicleModelExporter::class),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVehicleModels::route('/'),
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
