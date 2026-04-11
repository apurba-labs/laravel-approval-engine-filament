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
        // Register the translation namespace 'approval-engine'
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'approval-engine');

        // Register views
        if (is_dir(__DIR__ . '/../resources/views')) {
            $this->loadViewsFrom(__DIR__ . '/../resources/views', 'approval-engine');
        }

        // Publish config
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/approval-engine-filament.php' => config_path('approval-engine-filament.php'),
            ], 'approval-engine-config');

            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/approval-engine'),
            ], 'approval-engine-lang');
        }   
    }
}
