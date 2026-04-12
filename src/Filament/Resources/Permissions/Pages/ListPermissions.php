<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Permissions\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Permissions\PermissionResource;

class ListPermissions extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(), 
        ];
    }
}