<?php

namespace App\Filament\Admin\Resources\OrdererResource\Pages;

use App\Filament\Admin\Resources\OrdererResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderer extends CreateRecord
{
    protected static string $resource = OrdererResource::class;
}
