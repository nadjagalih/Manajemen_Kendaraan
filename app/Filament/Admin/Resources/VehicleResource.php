<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VehicleResource\Pages;
use App\Filament\Admin\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Kendaraan')
                ->required(),

            Forms\Components\TextInput::make('license_plate')
                ->label('Nomor Polisi')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Select::make('type')
                ->label('Tipe')
                ->options([
                    'angkutan_orang' => 'Angkutan Orang',
                    'angkutan_barang' => 'Angkutan Barang',
                ])
                ->required(),

            Forms\Components\TextInput::make('fuel_type')
                ->label('Jenis BBM')
                ->placeholder('Contoh: Solar, Pertalite'),

            Forms\Components\Toggle::make('is_company_owned')
                ->label('Milik Perusahaan')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Nama'),
            Tables\Columns\TextColumn::make('license_plate')->label('Plat'),
            Tables\Columns\TextColumn::make('type')
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'angkut_orang' => 'success',
                'angkut_barang' => 'warning',
                default => 'gray',
            })
            ->label('Tipe'),
            Tables\Columns\TextColumn::make('fuel_type')->label('BBM'),
            Tables\Columns\IconColumn::make('is_company_owned')
                ->boolean()
                ->label('Perusahaan'),
            Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime('d M Y'),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
