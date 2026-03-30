<?php
namespace ApurbaLabs\ApprovalEngineFilament;

use ApurbaLabs\ApprovalEngine\ApprovalEngineServiceProvider as PackageServiceProvider;
use Filament\Facades\Filament;
use Filament\Panel;
use ApurbaLabs\ApprovalEngineFilament\ApprovalEngineFilamentPlugin;

class ApprovalEngineFilamentServiceProvider extends PackageServiceProvider
{
    public static string $name = 'laravel-approval-engine-filament';

    public function register(): void
    {
        
        Panel::configureUsing(function (Panel $panel): void {
            if ($panel->getId() !== 'admin') {
                return;
            }

            $panel->plugin(ApprovalEngineFilamentPlugin::make());
        });
    }
    public function boot(): void
    {
        
    }
}
