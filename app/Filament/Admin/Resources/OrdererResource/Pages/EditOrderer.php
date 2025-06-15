<?php

namespace App\Filament\Admin\Resources\OrdererResource\Pages;

use App\Filament\Admin\Resources\OrdererResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderer extends EditRecord
{
    protected static string $resource = OrdererResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
