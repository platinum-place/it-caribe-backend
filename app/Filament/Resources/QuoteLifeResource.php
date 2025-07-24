<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteLifeResource\Pages;
use App\Models\QuoteLife;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteLifeResource extends Resource
{
    protected static ?string $model = QuoteLife::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('Quote life');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Quote lives');
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
                Tables\Columns\TextColumn::make('quoteCreditType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('coDebtor.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('guarantor')
                    ->boolean(),
                Tables\Columns\TextColumn::make('deadline')
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
            'index' => Pages\ListQuoteLives::route('/'),
            'create' => Pages\CreateQuoteLife::route('/create'),
            'view' => Pages\ViewQuoteLife::route('/{record}'),
            'edit' => Pages\EditQuoteLife::route('/{record}/edit'),
            'emit' => Pages\EmitQuoteLife::route('/{record}/emit'),
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
