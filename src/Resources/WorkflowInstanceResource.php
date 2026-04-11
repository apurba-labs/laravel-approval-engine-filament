<?php

namespace ApurbaLabs\ApprovalEngineFilament\Resources;

use ApurbaLabs\ApprovalEngine\Models\WorkflowInstance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use ApurbaLabs\ApprovalEngineFilament\Resources\WorkflowInstanceResource\Pages;

class WorkflowInstanceResource extends Resource
{
    protected static ?string $model = WorkflowInstance::class;

    protected static ?string $slug = 'workflow-instances';

    public static function getNavigationLabel(): string
    {
        return __('approval-engine::filament.nav.label') ?? 'Active Workflows';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('approval-engine::filament.nav.group') ?? 'Approval Engine';
    }

    public static function getNavigationIcon(): string | \Illuminate\Contracts\Support\Htmlable | null
    {
        return 'heroicon-o-cpu-chip';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkflowInstances::route('/'),
            'view' => Pages\ViewWorkflowInstance::route('/{record}'),
        ];
    }
}
