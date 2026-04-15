<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals\Pages;

use Filament\Resources\Pages\ListRecords;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals\WorkflowApprovalResource;

class ListWorkflowApprovals extends ListRecords
{
    protected static string $resource = WorkflowApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('refresh')
                ->label('Refresh')
                ->icon('heroicon-o-arrow-path')
                ->action(fn () => null),
        ];
    }
}