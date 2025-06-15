<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VehicleBookingResource\Pages;
use App\Filament\Admin\Resources\VehicleBookingResource\RelationManagers;
use App\Models\VehicleBooking;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleBookingResource extends Resource
{
    protected static ?string $model = VehicleBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->label('Dipesan oleh')
                ->relationship('user', 'name')
                ->default(Auth::id())
                ->disabled()
                ->dehydrated(),

            Forms\Components\Select::make('vehicle_id')
                ->relationship('vehicle', 'name')
                ->label('Kendaraan')
                ->required(),

            Forms\Components\Select::make('orderers_id')
                ->relationship('orderers', 'name')
                ->label('Pemesan'),

            Forms\Components\TextInput::make('destination')
                ->label('Tujuan')
                ->required(),

            Forms\Components\Textarea::make('purpose')
                ->label('Keperluan'),

            Forms\Components\DateTimePicker::make('start_time')
                ->label('Waktu Mulai')
                ->required(),

            Forms\Components\DateTimePicker::make('end_time')
                ->label('Waktu Selesai')
                ->required(),

            Forms\Components\Select::make('approval_status')
                ->label('Status Persetujuan')
                ->options([
                    'pending' => 'Menunggu Persetujuan',
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                ])
                ->default('pending')
                ->disabled()
                ->dehydrated(),

            Forms\Components\TextInput::make('current_approval')
                ->label('Persetujuan Ke:')
                ->default(0)
                ->disabled()
                ->dehydrated(),
        ]);
    }

public static function table(Table $table): Table
{
    return $table->columns([
        Tables\Columns\TextColumn::make('user.name')
            ->label('Pemesan'),

        Tables\Columns\TextColumn::make('vehicle.name')
            ->label('Kendaraan'),

        Tables\Columns\TextColumn::make('driver.name')
            ->label('Supir')
            ->placeholder('-'),

        Tables\Columns\TextColumn::make('destination')
            ->label('Tujuan'),

        Tables\Columns\TextColumn::make('start_time')
            ->label('Mulai')
            ->dateTime('d M Y H:i'),

        Tables\Columns\TextColumn::make('end_time')
            ->label('Selesai')
            ->dateTime('d M Y H:i'),

        Tables\Columns\TextColumn::make('status')
            ->label('Status')
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'pending' => 'gray',
                'approved' => 'success',
                'rejected' => 'danger',
                default => 'secondary',
            }),
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
            'index' => Pages\ListVehicleBookings::route('/'),
            'create' => Pages\CreateVehicleBooking::route('/create'),
            'edit' => Pages\EditVehicleBooking::route('/{record}/edit'),
        ];
    }
}
