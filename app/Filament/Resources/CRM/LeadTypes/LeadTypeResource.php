<?php

namespace App\Filament\Resources\CRM\LeadTypes;

use App\Filament\Resources\CRM\LeadTypes\Pages\CreateLeadType;
use App\Filament\Resources\CRM\LeadTypes\Pages\EditLeadType;
use App\Filament\Resources\CRM\LeadTypes\Pages\ListLeadTypes;
use App\Filament\Resources\CRM\LeadTypes\Pages\ViewLeadType;
use App\Filament\Resources\CRM\LeadTypes\Schemas\LeadTypeForm;
use App\Filament\Resources\CRM\LeadTypes\Schemas\LeadTypeInfolist;
use App\Filament\Resources\CRM\LeadTypes\Tables\LeadTypesTable;
use App\Models\CRM\LeadType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeadTypeResource extends Resource
{
    protected static ?string $model = LeadType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('CRM');
    }

    public static function form(Schema $schema): Schema
    {
        return LeadTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LeadTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LeadTypesTable::configure($table);
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
            'index' => ListLeadTypes::route('/'),
            'create' => CreateLeadType::route('/create'),
            'view' => ViewLeadType::route('/{record}'),
            'edit' => EditLeadType::route('/{record}/edit'),
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
