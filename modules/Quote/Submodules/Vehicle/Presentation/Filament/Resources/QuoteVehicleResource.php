<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources;

use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleResource\Pages;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleResource\RelationManagers;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Persistence\Models\QuoteVehicle;
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

    public static function getModelLabel(): string
    {
        return __('Quote vehicle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Quote vehicles');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('created_by')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('updated_by')
                    ->numeric(),
                Forms\Components\TextInput::make('deleted_by')
                    ->numeric(),
                Forms\Components\TextInput::make('quote_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('vehicle_make_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('vehicle_model_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('vehicle_type_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('vehicle_use_id')
                    ->numeric(),
                Forms\Components\TextInput::make('vehicle_activity_id')
                    ->numeric(),
                Forms\Components\TextInput::make('vehicle_loan_type_id')
                    ->numeric(),
                Forms\Components\TextInput::make('vehicle_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('loan_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('vehicle_year')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_employee')
                    ->required(),
                Forms\Components\Toggle::make('leasing')
                    ->required(),
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
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quote_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_make_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_model_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_use_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_activity_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_loan_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_vehicle_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_loan_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_employee')
                    ->boolean(),
                Tables\Columns\IconColumn::make('leasing')
                    ->boolean(),
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
