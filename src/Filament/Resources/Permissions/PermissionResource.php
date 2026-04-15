<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Permissions;

use Filament\Tables;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Actions\EditAction;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

use ApurbaLabs\IAM\Models\Permission;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Permissions\Pages;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationLabel = 'Permissions';

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('approval-engine::filament.nav.group');
    }

    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([

            //RESOURCE
            Select::make('resource')
                ->options([
                    'expense' => 'Expense',
                    'requisition' => 'Requisition',
                    'workflow' => 'Workflow',
                ])
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set, Get $get) {
                    if ($get('action')) {
                        $set('slug', $get('resource') . '.' . $get('action'));
                    }
                }),

            // ACTION
            Select::make('action')
                ->options([
                    'create' => 'Create',
                    'read' => 'Read',
                    'update' => 'Update',
                    'delete' => 'Delete',
                    'approve' => 'Approve',
                    'reject' => 'Reject',
                    'manage' => 'Manage',
                ])
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set, Get $get) {
                    if ($get('resource')) {
                        $set('slug', $get('resource') . '.' . $get('action'));
                    }
                }),

            // SLUG (AUTO GENERATED)
            TextInput::make('slug')
                ->disabled()     // user cannot edit
                ->dehydrated()   // still saved to DB
                ->required(),

            // NAME 
            TextInput::make('name')
                ->label('Display Name')
                ->afterStateUpdated(function (Set $set, Get $get) {
                    if ($get('resource') && $get('action')) {
                        $set('slug', $get('resource') . '.' . $get('action'));
                        $set('name', ucfirst($get('resource')) . ' ' . ucfirst($get('action')));
                    }
                }),

            // DESCRIPTION
            TextInput::make('description'),

        ]);
    }
    
    // TABLE
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                EditAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }
}