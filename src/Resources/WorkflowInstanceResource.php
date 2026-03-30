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

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationGroup = 'Approval Engine';
    
    protected static ?string $navigationLabel = 'Active Workflows'; 

   
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkflowInstances::route('/'),
            'view' => Pages\ViewWorkflowInstance::route('/{record}'),
        ];
    }
}
