<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;

use ApurbaLabs\ApprovalEngine\Models\WorkflowApproval;
use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals\Pages;

class WorkflowApprovalResource extends Resource
{
    protected static ?string $model = WorkflowApproval::class;
    protected static ?string $slug = 'workflow-approvals';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('approval-engine::filament.nav.label') ?? 'My Approvals';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('approval-engine::filament.nav.group') ?? 'Approval Engine';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-check-circle';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                Tables\Columns\TextColumn::make('workflowInstance.module')
                    ->label('Module')
                    ->badge(),
                Tables\Columns\TextColumn::make('workflowInstance.payload.total_amount')
                    ->label('Amount'),

                Tables\Columns\TextColumn::make('workflowInstance.payload.user_id')
                    ->label('Requested By'),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger'  => 'rejected',
                    ]),

                Tables\Columns\TextColumn::make('due_at')
                    ->label('Due')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime(),
            ])
            ->emptyStateHeading('No pending approvals 🎉')
            ->emptyStateDescription('You are all caught up!')
            ->actions([

                ViewAction::make(),

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
            ->where('user_id', auth()->id())
            ->where('status', 'pending'); // inbox only
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkflowApprovals::route('/'),
            'view' => Pages\ViewWorkflowApproval::route('/{record}'),
        ];
    }
}