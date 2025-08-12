<?php

namespace Modules\CRM\Presentation\Filament\Resources\DebtorTypes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\CRM\Infrastructure\Persistence\Models\DebtorType;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypes\Pages\CreateDebtorType;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypes\Pages\EditDebtorType;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypes\Pages\ListDebtorTypes;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypes\Pages\ViewDebtorType;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypes\Schemas\DebtorTypeForm;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypes\Schemas\DebtorTypeInfolist;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypes\Tables\DebtorTypesTable;

class DebtorTypeResource extends Resource
{
    protected static ?string $model = DebtorType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DebtorTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DebtorTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DebtorTypesTable::configure($table);
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
            'index' => ListDebtorTypes::route('/'),
            'create' => CreateDebtorType::route('/create'),
            'view' => ViewDebtorType::route('/{record}'),
            'edit' => EditDebtorType::route('/{record}/edit'),
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
