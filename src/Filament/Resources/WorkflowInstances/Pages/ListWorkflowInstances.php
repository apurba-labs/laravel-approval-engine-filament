<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowInstances\Pages;

use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowInstances\WorkflowInstanceResource;
use Filament\Resources\Pages\ListRecords;

class ListWorkflowInstances extends ListRecords
{
    protected static string $resource = WorkflowInstanceResource::class;
}