<?php

namespace ApurbaLabs\ApprovalEngineFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;
// Import resources
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowInstances\WorkflowInstanceResource;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals\WorkflowApprovalResource;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Roles\RoleResource;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Permissions\PermissionResource;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Users\UserResource;

class ApprovalEngineFilamentPlugin implements Plugin
{
    public function getId(): string
    {
        return 'laravel-approval-engine-filament';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            RoleResource::class,
            PermissionResource::class,
            WorkflowInstanceResource::class,
            WorkflowApprovalResource::class,
            UserResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}