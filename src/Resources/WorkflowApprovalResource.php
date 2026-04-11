<?php

namespace ApurbaLabs\ApprovalEngineFilament\Resources;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

use ApurbaLabs\ApprovalEngine\Models\WorkflowApproval;
use ApurbaLabs\ApprovalEngineFilament\Resources\WorkflowApprovalResource\Pages;


class WorkflowApprovalResource extends Resource
{
    protected static ?string $model = WorkflowApproval::class;
    
    protected static ?string $slug = 'workflow-approvals';

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
        return 'heroicon-o-check-circle';
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('workflow_instance_id'),
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('due_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(fn ($record) => $record->update([
                        'status' => 'approved',
                        'completed_at' => now(),
                    ])),

                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(fn ($record) => $record->update([
                        'status' => 'rejected',
                        'completed_at' => now(),
                    ])),
            ]);
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkflowApprovals::route('/'),
            'view' => Pages\ViewWorkflowApproval::route('/{record}'),
        ];
    }
}