<?php

namespace App\Filament\Approver\Resources;

use App\Filament\Approver\Resources\VehicleBookingResource\Pages;
use App\Models\VehicleBooking;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class VehicleBookingResource extends Resource
{
    protected static ?string $model = VehicleBooking::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('orderers.name')
                    ->label('Pemesan')
                    ->openUrlInNewTab()
                    ->extraAttributes(['class' => 'text-primary underline']),

                Tables\Columns\TextColumn::make('purpose')
                    ->label('Keperluan')
                    ->limit(30)
                    ->wrap(),

                Tables\Columns\TextColumn::make('vehicle.name')
                    ->label('Kendaraan'),

                Tables\Columns\TextColumn::make('destination')
                    ->label('Tujuan'),

                Tables\Columns\TextColumn::make('start_time')
                    ->label('Mulai')
                    ->dateTime('d M Y H:i'),

                Tables\Columns\TextColumn::make('end_time')
                    ->label('Selesai')
                    ->dateTime('d M Y H:i'),

                Tables\Columns\BadgeColumn::make('approval_status')
                    ->label('Status')
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(function ($state, $record) {
                        $user = auth()->user();

                        if (! $user) return ucfirst($state);

                        if (
                            $state === 'approved' &&
                            (
                                ($user->role === 'kepala_cabang' && $record->current_approval === 1) ||
                                ($user->role === 'kepala_pusat' && $record->current_approval === 2)
                            )
                        ) {
                            return 'Confirmed by You';
                        }

                        return ucfirst($state);
                    }),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Konfirmasi')
                    ->color('success')
                    ->visible(fn ($record) =>
                        $record->approval_status === 'pending' &&
                        (
                            (auth()->user()->role === 'kepala_cabang' && $record->current_approval === 0) ||
                            (auth()->user()->role === 'kepala_pusat' && $record->current_approval === 1)
                        )
                    )
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $role = auth()->user()->role;

                        if ($role === 'kepala_cabang' && $record->current_approval === 0) {
                            $record->current_approval = 1;
                        } elseif ($role === 'kepala_pusat' && $record->current_approval === 1) {
                            $record->approval_status = 'approved';
                            $record->current_approval = 2;
                        }

                        $record->save();
                    }),

                Action::make('reject')
                    ->label('Tolak')
                    ->color('danger')
                    ->visible(fn ($record) =>
                        $record->approval_status === 'pending' &&
                        (
                            auth()->user()->role === 'kepala_cabang' ||
                            auth()->user()->role === 'kepala_pusat'
                        )
                    )
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->approval_status = 'rejected';
                        $record->save();
                    }),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if (! $user) {
            return parent::getEloquentQuery()->whereRaw('1 = 0'); // hide all if no user
        }

        $query = parent::getEloquentQuery()->with(['orderers', 'vehicle']);

        if ($user->role === 'kepala_cabang') {
            return $query->where(function ($q) {
                $q->where('approval_status', 'pending')->where('current_approval', 0)
                  ->orWhere(function ($q2) {
                      $q2->where('approval_status', 'approved')
                         ->where('current_approval', '>=', 1)
                         ->where('end_time', '>', now());
                  });
            });
        }

        if ($user->role === 'kepala_pusat') {
            return $query->where(function ($q) {
                $q->where('approval_status', 'pending')->where('current_approval', 1)
                  ->orWhere(function ($q2) {
                      $q2->where('approval_status', 'approved')
                         ->where('current_approval', '>=', 2)
                         ->where('end_time', '>', now());
                  });
            });
        }

        return $query->whereRaw('1 = 0'); // default: tampilkan kosong
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleBookings::route('/'),
        ];
    }
}
