<?php

namespace App\Filament\Resources\Debtors;

use App\Filament\Resources\Debtors\Pages\CreateDebtor;
use App\Filament\Resources\Debtors\Pages\EditDebtor;
use App\Filament\Resources\Debtors\Pages\ListDebtors;
use App\Filament\Resources\Debtors\Pages\ViewDebtor;
use App\Filament\Resources\Debtors\Schemas\DebtorForm;
use App\Filament\Resources\Debtors\Schemas\DebtorInfolist;
use App\Filament\Resources\Debtors\Tables\DebtorsTable;
use App\Models\CRM\Debtor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DebtorResource extends Resource
{
    protected static ?string $model = Debtor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'full_name';

    public static function form(Schema $schema): Schema
    {
        return DebtorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DebtorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DebtorsTable::configure($table);
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
            'index' => ListDebtors::route('/'),
            'create' => CreateDebtor::route('/create'),
            'view' => ViewDebtor::route('/{record}'),
            'edit' => EditDebtor::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
