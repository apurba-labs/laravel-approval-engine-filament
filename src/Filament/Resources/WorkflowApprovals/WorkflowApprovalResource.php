<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * TABLE 
     */
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

                Tables\Columns\TextColumn::make('workflowInstance.payload')
                    ->label('Data')
                    ->formatStateUsing(fn ($state) => json_encode($state))
                    ->limit(50),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger'  => 'rejected',
                    ]),

                Tables\Columns\TextColumn::make('due_at')
                    ->label('Due At')
                    ->dateTime(),

            ])

            ->emptyStateHeading('No pending approvals 🎉')
            ->emptyStateDescription('You are all caught up!')

            ->actions([

                ViewAction::make(),

                Action::make('approve')
                    ->label('Approve')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {

                        $record->update([
                            'status' => 'approved',
                            'completed_at' => now(),
                        ]);

                        app(\ApurbaLabs\ApprovalEngine\Actions\MoveToNextStageAction::class)
                            ->execute($record->workflowInstance, $record->stage_order);
                    }),

                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {

                        $record->update([
                            'status' => 'rejected',
                            'completed_at' => now(),
                        ]);
                    }),

            ]);
    }

    /**
     * QUERY (SMART HANDLING)
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // If user logged in → show "My Approvals"
        if (auth()->check()) {
            return $query
                ->where('user_id', auth()->id())
                ->where('status', 'pending');
        }

        // If no auth (dev mode) → show all pending
        return $query->where('status', 'pending');
    }

    /**
     * PAGES
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkflowApprovals::route('/'),
            'view' => Pages\ViewWorkflowApproval::route('/{record}'),
        ];
    }
}