<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Users;

use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Users\Pages\CreateUser;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Users\Pages\EditUser;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Users\Pages\ListUsers;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Users\Schemas\UserForm;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Users\Tables\UsersTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = null;
    public static function getModel(): string
    {
        return config('auth.providers.users.model');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'User';

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
