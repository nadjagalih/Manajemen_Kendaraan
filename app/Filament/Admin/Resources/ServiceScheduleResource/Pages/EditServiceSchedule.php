<?php

namespace App\Filament\Admin\Resources\ServiceScheduleResource\Pages;

use App\Filament\Admin\Resources\ServiceScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceSchedule extends EditRecord
{
    protected static string $resource = ServiceScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
