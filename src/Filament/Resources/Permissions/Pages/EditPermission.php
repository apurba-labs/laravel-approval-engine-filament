<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Permissions\Pages;

use Filament\Resources\Pages\EditRecord;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Permissions\PermissionResource;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;
}