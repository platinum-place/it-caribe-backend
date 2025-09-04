<?php

namespace Modules\Presentation\CRM\Filament\Resources\Leads;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Infrastructure\CRM\Persistence\Models\Lead;
use Modules\Presentation\CRM\Filament\Resources\Leads\Pages\CreateLead;
use Modules\Presentation\CRM\Filament\Resources\Leads\Pages\EditLead;
use Modules\Presentation\CRM\Filament\Resources\Leads\Pages\ListLeads;
use Modules\Presentation\CRM\Filament\Resources\Leads\Pages\ViewLead;
use Modules\Presentation\CRM\Filament\Resources\Leads\Schemas\LeadForm;
use Modules\Presentation\CRM\Filament\Resources\Leads\Schemas\LeadInfolist;
use Modules\Presentation\CRM\Filament\Resources\Leads\Tables\LeadsTable;

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
