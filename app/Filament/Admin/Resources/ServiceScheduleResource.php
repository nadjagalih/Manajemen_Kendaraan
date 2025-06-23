<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ServiceScheduleResource\Pages;
use App\Models\ServiceSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class ServiceScheduleResource extends Resource
{
    protected static ?string $model = ServiceSchedule::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Monitoring Kendaraan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)->schema([
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'name')
                    ->label('Kendaraan')
                    ->searchable()
                    ->required(),

                DatePicker::make('tanggal_service')
                    ->label('Tanggal Servis')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->required(),
            ]),

            Grid::make(2)->schema([
                TextInput::make('jenis_service')
                    ->label('Jenis Servis')
                    ->required()
                    ->placeholder('Contoh: Ganti Oli, Tune Up, dsb.'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'terjadwal' => 'Terjadwal',
                        'selesai' => 'Selesai',
                    ])
                    ->default('terjadwal')
                    ->helperText('Tandai selesai jika servis sudah dilakukan'),
            ]),

            Textarea::make('catatan')
                ->label('Catatan Tambahan')
                ->placeholder('Misal: catatan teknisi, estimasi biaya, dll.')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('vehicle.name')
                ->label('Kendaraan')
                ->searchable()
                ->sortable(),

            TextColumn::make('tanggal_service')
                ->label('Tanggal Servis')
                ->date('d M Y'),

            TextColumn::make('jenis_service')
                ->label('Jenis')
                ->wrap()
                ->limit(30),

            BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'warning' => 'terjadwal',
                    'success' => 'selesai',
                ])
                ->formatStateUsing(fn (string $state) => ucfirst($state)),
        ])
        ->defaultSort('tanggal_service', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceSchedules::route('/'),
            'create' => Pages\CreateServiceSchedule::route('/create'),
            'edit' => Pages\EditServiceSchedule::route('/{record}/edit'),
        ];
    }
}
