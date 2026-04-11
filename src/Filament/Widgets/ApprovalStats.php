<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use ApurbaLabs\ApprovalEngine\Models\WorkflowApproval;

class ApprovalStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Approvals',
                WorkflowApproval::where('status', 'pending')->count()
            ),

            Stat::make('Approved Today',
                WorkflowApproval::whereDate('approved_at', now())->count()
            ),

            Stat::make('Total Workflows',
                \ApurbaLabs\ApprovalEngine\Models\WorkflowInstance::count()
            ),
        ];
    }
}
