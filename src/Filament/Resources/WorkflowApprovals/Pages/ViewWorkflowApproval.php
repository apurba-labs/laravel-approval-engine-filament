<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals\Pages;

use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Schemas\Schema; 

use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\WorkflowApprovals\WorkflowApprovalResource;

class ViewWorkflowApproval extends ViewRecord
{
    protected static string $resource = WorkflowApprovalResource::class;

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
                            // Show user name instead of just ID
                            TextEntry::make('user.name')
                                ->label('Approver')
                                ->placeholder('Not Assigned Yet'),
                            
                            TextEntry::make('status')
                                ->badge(),
                                
                            TextEntry::make('due_at')
                                ->label('Deadline')
                                ->dateTime()
                                ->since() // Shows "2 days ago" or "in 3 hours"
                                ->color('gray'),
                        ])
                        ->columns(3) // Layout them side-by-side inside the repeater
                ])
        ]);
    }
}
