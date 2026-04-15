<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Roles;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use BackedEnum;
use ApurbaLabs\IAM\Models\Role;
use ApurbaLabs\IAM\Models\Permission;

use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Roles\Pages;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';

    public static function getNavigationGroup(): ?string
    {
        return __('approval-engine::filament.nav.group');
    }

    protected static ?string $navigationLabel = 'Roles';

    protected static ?int $navigationSort = 4;

    // -------------------------------
    // FORM (Create / Edit)
    // -------------------------------
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            \Filament\Forms\Components\TextInput::make('name')
                ->required(),

            \Filament\Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),

            \Filament\Forms\Components\CheckboxList::make('permissions')
                ->relationship('permissions', 'name')
                ->columns(2),
        ]);
    }

    // -------------------------------
    // TABLE
    // -------------------------------


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name'),
            ]);
    }

    // -------------------------------
    // RELATIONS (optional later)
    // -------------------------------
    public static function getRelations(): array
    {
        return [];
    }

    // -------------------------------
    // PAGES
    // -------------------------------
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }
}