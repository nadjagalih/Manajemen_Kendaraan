<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrdererResource\Pages;
use App\Filament\Admin\Resources\OrdererResource\RelationManagers;
use App\Models\Orderer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdererResource extends Resource
{
    protected static ?string $model = Orderer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Pemesan')
                ->required(),

            Forms\Components\TextInput::make('phone_number')
                ->label('Nomor Telepon')
                ->tel()
                ->nullable(),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Nama'),
            Tables\Columns\TextColumn::make('phone_number')->label('Telepon'),
            Tables\Columns\TextColumn::make('email')->label('Email'),
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
            'index' => Pages\ListOrderers::route('/'),
            'create' => Pages\CreateOrderer::route('/create'),
            'edit' => Pages\EditOrderer::route('/{record}/edit'),
        ];
    }
}
