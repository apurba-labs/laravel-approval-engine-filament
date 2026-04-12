<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\RoleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\RoleResource;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(), 
        ];
    }
}