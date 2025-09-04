<?php

namespace Modules\Presentation\CRM\Filament\Resources\LeadTypes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Infrastructure\CRM\Persistence\Models\LeadType;
use Modules\Presentation\CRM\Filament\Resources\LeadTypes\Pages\CreateLeadType;
use Modules\Presentation\CRM\Filament\Resources\LeadTypes\Pages\EditLeadType;
use Modules\Presentation\CRM\Filament\Resources\LeadTypes\Pages\ListLeadTypes;
use Modules\Presentation\CRM\Filament\Resources\LeadTypes\Pages\ViewLeadType;
use Modules\Presentation\CRM\Filament\Resources\LeadTypes\Schemas\LeadTypeForm;
use Modules\Presentation\CRM\Filament\Resources\LeadTypes\Schemas\LeadTypeInfolist;
use Modules\Presentation\CRM\Filament\Resources\LeadTypes\Tables\LeadTypesTable;

class LeadTypeResource extends Resource
{
    protected static ?string $model = LeadType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

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
