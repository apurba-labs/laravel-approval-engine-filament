<?php

namespace ApurbaLabs\ApprovalEngineFilament\Resources\WorkflowInstanceResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use ApurbaLabs\ApprovalEngineFilament\Resources\WorkflowInstanceResource;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Schemas\Schema; 

class ViewWorkflowInstance extends ViewRecord
{
    protected static string $resource = WorkflowInstanceResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Workflow Details')
                ->columns(2)
                ->schema([
                    TextEntry::make('module')
                        ->label('Process Name')
                        ->weight('bold'),
                    
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            default => 'gray',
                        }),
                ]),

            Section::make('Approval History / Progress')
                ->schema([
                    RepeatableEntry::make('approvals')
                        ->label('Stages')
                        ->schema([
                            TextEntry::make('user.name')
                                ->label('Approver')
                                ->placeholder('Not Assigned Yet'),
                            
                            TextEntry::make('status')
                                ->badge(),
                                
                            TextEntry::make('due_at')
                                ->label('Deadline')
                                ->dateTime()
                                ->since()
                                ->color('gray'),
                        ])
                        ->columns(3)
                ])
        ]);
    }
}
