<?php

namespace App\Filament\Approver\Resources;

use App\Filament\Approver\Resources\FuelLogResource\Pages;
use App\Filament\Approver\Resources\FuelLogResource\RelationManagers;
use App\Models\FuelLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;

class FuelLogResource extends Resource
{
    protected static ?string $model = FuelLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-fire';
    protected static ?string $navigationGroup = 'Monitoring Kendaraan';

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('vehicle.name')->label('Kendaraan'),
            Tables\Columns\TextColumn::make('tanggal')->date(),
            Tables\Columns\TextColumn::make('jumlah_liter')->label('Liter'),
            Tables\Columns\TextColumn::make('odometer')->label('Odometer (km)'),
            Tables\Columns\TextColumn::make('catatan')->limit(20),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Approver\Resources\FuelLogResource\Pages\ListFuelLogs::route('/'),
        ];
    }
}
