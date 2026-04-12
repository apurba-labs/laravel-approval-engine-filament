<?php

namespace ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Users\Pages;

use ApurbaLabs\ApprovalEngineFilament\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
