<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Permissions\Pages;

use Filament\Resources\Pages\CreateRecord;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Permissions\PermissionResource;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
}