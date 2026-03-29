<?php

namespace ApurbaLabs\ApprovalEngineFilament\Resources;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use ApurbaLabs\ApprovalEngine\Models\WorkflowApproval;

class WorkflowApprovalResource extends Resource
{
    protected static ?string $model = WorkflowApproval::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    protected static ?string $navigationGroup = 'Approval Engine';

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
            ]);
    }
}