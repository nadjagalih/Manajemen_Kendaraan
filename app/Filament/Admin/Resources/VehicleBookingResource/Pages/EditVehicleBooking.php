<?php

namespace App\Filament\Admin\Resources\VehicleBookingResource\Pages;

use App\Filament\Admin\Resources\VehicleBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleBooking extends EditRecord
{
    protected static string $resource = VehicleBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
