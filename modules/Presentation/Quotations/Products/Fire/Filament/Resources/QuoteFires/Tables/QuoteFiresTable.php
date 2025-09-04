<?php

namespace Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class QuoteFiresTable
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
                TextColumn::make('quote_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quote_fire_construction_type_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quote_fire_credit_type_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quote_fire_risk_type_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('branch.name')
                    ->searchable(),
                TextColumn::make('co_borrower_id')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('guarantor')
                    ->boolean(),
                TextColumn::make('deadline_month')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('deadline_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('appraisal_value')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('financed_value')
                    ->numeric()
                    ->sortable(),
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
