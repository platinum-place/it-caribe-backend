<?php

namespace Root\Location\Presentation\Filament\Resources\Branches;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Root\Location\Infrastructure\Persistence\Models\Branch;
use Root\Location\Presentation\Filament\Resources\Branches\Pages\CreateBranch;
use Root\Location\Presentation\Filament\Resources\Branches\Pages\EditBranch;
use Root\Location\Presentation\Filament\Resources\Branches\Pages\ListBranches;
use Root\Location\Presentation\Filament\Resources\Branches\Pages\ViewBranch;
use Root\Location\Presentation\Filament\Resources\Branches\Schemas\BranchForm;
use Root\Location\Presentation\Filament\Resources\Branches\Schemas\BranchInfolist;
use Root\Location\Presentation\Filament\Resources\Branches\Tables\BranchesTable;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return BranchForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BranchInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BranchesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBranches::route('/'),
            'create' => CreateBranch::route('/create'),
            'view' => ViewBranch::route('/{record}'),
            'edit' => EditBranch::route('/{record}/edit'),
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
