<?php

namespace App\Filament\Resources\ZakatFitrahs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ZakatFitrahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('zakat_code')
                    ->label('Kode Zakat')
                    ->required()
                    ->disabled(),
                TextInput::make('muzakki_name')
                    ->label('Nama Muzakki')
                    ->required()
                    ->disabled(),
                TextInput::make('address')
                    ->label('Alamat')
                    ->required()
                    ->disabled(),
                TextInput::make('address')
                    ->label('Alamat')
                    ->required()
                    ->disabled(),
                TextInput::make('total_people')
                    ->label('Jumlah Jiwa')
                    ->numeric()
                    ->required()
                    ->disabled(),
                TextInput::make('rice_total')
                    ->label('Jumlah Beras')
                    ->numeric()
                    ->required()
                    ->disabled(),
                Select::make('zakat_status')
                    ->label('Status Zakat')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                    ])
                    ->required(),
            ]);
    }
}
