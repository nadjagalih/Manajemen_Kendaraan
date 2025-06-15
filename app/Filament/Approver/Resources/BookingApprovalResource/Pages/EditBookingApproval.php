<?php

namespace App\Filament\Approver\Resources\BookingApprovalResource\Pages;

use App\Filament\Admin\Resources\VehicleResource;
use App\Filament\Approver\Resources\BookingApprovalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookingApproval extends EditRecord
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
