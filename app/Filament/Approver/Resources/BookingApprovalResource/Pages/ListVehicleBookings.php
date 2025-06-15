<?php

namespace App\Filament\Approver\Resources\VehicleBookingResource\Pages;

use App\Filament\Approver\Resources\VehicleBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleBookings extends ListRecords
{
    protected static string $resource = VehicleBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
