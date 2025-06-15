<?php

namespace App\Filament\Approver\Resources\ServiceScheduleResource\Pages;

use App\Filament\Approver\Resources\ServiceScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceSchedules extends ListRecords
{
    protected static string $resource = ServiceScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
