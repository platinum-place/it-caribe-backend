<?php

namespace App\Filament\Branch\Resources\QuoteVehicles\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LinesRelationManager extends RelationManager
{
    protected static string $relationship = 'lines';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return 'Aseguradoras';
    }

    public function isReadOnly(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('quoteLine.name')
                    ->label('Aseguradora'),

                TextColumn::make('vehicle_rate')
                    ->label('Tasa')
                    ->suffix('%')
                    ->visible(fn () => auth()->user()->isAdmin()),

                TextColumn::make('total_monthly')
                    ->label('Total Mensual')
                    ->state(fn ($record) => number_format($record->total_monthly, 2))
                    ->prefix('RD$'),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}
