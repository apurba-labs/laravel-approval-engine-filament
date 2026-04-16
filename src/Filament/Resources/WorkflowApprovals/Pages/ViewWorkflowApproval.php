<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals\Pages;

use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Actions\Action;

use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals\WorkflowApprovalResource;

class ViewWorkflowApproval extends ViewRecord
{
    protected static string $resource = WorkflowApprovalResource::class;

    /**
     * DETAIL VIEW (LATEST FILAMENT)
     */
    public function infolist(Schema $schema): Schema
    {
        return $schema->schema([

            TextInput::make('module')
                ->label('Module')
                ->disabled()
                ->formatStateUsing(fn () => $this->record->workflowInstance?->module),

            TextInput::make('status')
                ->label('Status')
                ->disabled(),

            TextInput::make('amount')
                ->label('Amount')
                ->disabled()
                ->formatStateUsing(fn () => data_get($this->record->workflowInstance?->payload, 'total_amount')),

            TextInput::make('requested_by')
                ->label('Requested By')
                ->disabled()
                ->formatStateUsing(fn () => data_get($this->record->workflowInstance?->payload, 'user_id')),

            TextInput::make('created_at')
                ->label('Created At')
                ->disabled(),

            Textarea::make('payload')
                ->label('Full Data')
                ->disabled()
                ->formatStateUsing(fn () => json_encode($this->record->workflowInstance?->payload, JSON_PRETTY_PRINT)),

        ]);
    }

    /**
     * ACTION BUTTONS
     */
    protected function getHeaderActions(): array
    {
        return [

            Action::make('approve')
                ->label('Approve')
                ->color('success')
                ->visible(fn () => $this->record->status === 'pending')
                ->action(function () {

                    $this->record->update([
                        'status' => 'approved',
                        'completed_at' => now(),
                    ]);

                    app(\ApurbaLabs\ApprovalEngine\Actions\MoveToNextStageAction::class)
                        ->execute($this->record->workflowInstance, $this->record->stage_order);
                }),

            Action::make('reject')
                ->label('Reject')
                ->color('danger')
                ->visible(fn () => $this->record->status === 'pending')
                ->action(function () {

                    $this->record->update([
                        'status' => 'rejected',
                        'completed_at' => now(),
                    ]);
                }),
        ];
    }
}