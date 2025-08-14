<?php

namespace App\Filament\CRM\Resources\Leads;

use App\Filament\CRM\Resources\Leads\Pages\CreateLead;
use App\Filament\CRM\Resources\Leads\Pages\EditLead;
use App\Filament\CRM\Resources\Leads\Pages\ListLeads;
use App\Filament\CRM\Resources\Leads\Pages\ViewDebtor;
use App\Filament\CRM\Resources\Leads\Schemas\DebtorForm;
use App\Filament\CRM\Resources\Leads\Schemas\DebtorInfolist;
use App\Filament\CRM\Resources\Leads\Tables\LeadsTable;
use App\Models\CRM\Lead;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

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
        return LeadsTable::configure($table);
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
            'index' => ListLeads::route('/'),
            'create' => CreateLead::route('/create'),
            'view' => ViewDebtor::route('/{record}'),
            'edit' => EditLead::route('/{record}/edit'),
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
