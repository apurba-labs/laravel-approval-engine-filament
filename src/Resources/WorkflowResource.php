<?php

namespace ApurbaLabs\ApprovalEngineFilament\Resources;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Forms\Form;

use ApurbaLabs\ApprovalEngine\Models\WorkflowInstance;

class WorkflowResource extends Resource
{
    protected static ?string $model = WorkflowInstance::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationGroup = 'Approval Engine';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('module')->disabled(),
            Forms\Components\Textarea::make('payload')->disabled(),
            Forms\Components\TextInput::make('status')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('module')->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }
}