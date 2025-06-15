<?php

namespace App\Filament\Approver\Resources;

use App\Filament\Approver\Resources\ServiceScheduleResource\Pages;
use App\Filament\Approver\Resources\ServiceScheduleResource\RelationManagers;
use App\Models\ServiceSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Resource;


class ServiceScheduleResource extends Resource
{
    protected static ?string $model = ServiceSchedule::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Monitoring Kendaraan';

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('vehicle.name')->label('Kendaraan'),
            Tables\Columns\TextColumn::make('tanggal_service')->date()->label('Tanggal'),
            Tables\Columns\TextColumn::make('jenis_service')->label('Jenis'),
            Tables\Columns\BadgeColumn::make('approval_status')->colors([
                'warning' => 'terjadwal',
                'success' => 'selesai',
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Approver\Resources\ServiceScheduleResource\Pages\ListServiceSchedules::route('/'),
        ];
    }
}
