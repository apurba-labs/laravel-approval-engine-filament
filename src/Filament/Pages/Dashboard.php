<?php
namespace ApurbaLabs\ApprovalEngineFilament\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $title = 'Approval Dashboard';
    protected string $view = 'filament.pages.dashboard';

    protected static ?int $navigationSort = 1;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\ApprovalStats::class,
        ];
    }
}
