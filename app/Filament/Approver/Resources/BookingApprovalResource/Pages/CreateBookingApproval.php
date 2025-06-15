<?php

namespace App\Filament\Approver\Resources\BookingApprovalResource\Pages;

use App\Filament\Approver\Resources\BookingApprovalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookingApproval extends CreateRecord
{
    protected static string $resource = BookingApprovalResource::class;
}
