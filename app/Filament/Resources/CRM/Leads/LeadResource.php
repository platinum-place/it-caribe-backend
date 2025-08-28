<?php

namespace App\Filament\Resources\CRM\Leads;

use App\Filament\Resources\CRM\Leads\Pages\CreateLead;
use App\Filament\Resources\CRM\Leads\Pages\EditLead;
use App\Filament\Resources\CRM\Leads\Pages\ListLeads;
use App\Filament\Resources\CRM\Leads\Pages\ViewLead;
use App\Filament\Resources\CRM\Leads\Schemas\LeadForm;
use App\Filament\Resources\CRM\Leads\Schemas\LeadInfolist;
use App\Filament\Resources\CRM\Leads\Tables\LeadsTable;
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
        return LeadForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LeadInfolist::configure($schema);
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
            'view' => ViewLead::route('/{record}'),
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
