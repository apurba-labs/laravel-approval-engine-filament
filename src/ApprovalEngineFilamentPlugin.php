<?php

namespace ApurbaLabs\ApprovalEngineFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;

use ApurbaLabs\ApprovalEngineFilament\Resources\WorkflowInstanceResource;
use ApurbaLabs\ApprovalEngineFilament\Resources\WorkflowApprovalResource;

class ApprovalEngineFilamentPlugin implements Plugin
{
    public function getId(): string
    {
        return 'approval-engine';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            WorkflowInstanceResource::class,
            WorkflowApprovalResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return new static(); 
    }
}