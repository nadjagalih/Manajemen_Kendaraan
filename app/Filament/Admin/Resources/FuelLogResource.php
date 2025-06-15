<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FuelLogResource\Pages;
use App\Models\FuelLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class FuelLogResource extends Resource
{
    protected static ?string $model = FuelLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-fire';
    protected static ?string $navigationGroup = 'Monitoring Kendaraan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)->schema([ // 2 kolom
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'name')
                    ->label('Kendaraan')
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('tanggal')
                    ->label('Tanggal Pengisian')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->required(),
            ]),

            Grid::make(2)->schema([
                TextInput::make('jumlah_liter')
                    ->label('Jumlah BBM')
                    ->numeric()
                    ->prefix('⛽')
                    ->suffix('liter')
                    ->required()
                    ->placeholder('Contoh: 15.5')
                    ->helperText('Jumlah BBM yang diisi'),

                TextInput::make('odometer')
                    ->label('Odometer')
                    ->numeric()
                    ->prefix('🚗')
                    ->suffix('km')
                    ->required()
                    ->placeholder('Contoh: 123456')
                    ->helperText('Jarak tempuh saat pengisian'),
            ]),

            TextInput::make('catatan')
                ->label('Catatan Tambahan')
                ->placeholder('Opsional...')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('vehicle.name')->label('Kendaraan')->searchable(),
                TextColumn::make('tanggal')->date('d M Y')->label('Tanggal'),
                TextColumn::make('jumlah_liter')->label('Liter')->suffix(' L'),
                TextColumn::make('odometer')->label('Odometer')->suffix(' km'),
                TextColumn::make('catatan')->label('Catatan')->limit(30)->wrap(),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFuelLogs::route('/'),
            'create' => Pages\CreateFuelLog::route('/create'),
            'edit' => Pages\EditFuelLog::route('/{record}/edit'),
        ];
    }
}
