<?php

namespace ApurbaLabs\ApprovalEngineFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;
// Import resources
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowInstanceResource;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovalResource;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\RoleResource;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\PermissionResource;

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
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}