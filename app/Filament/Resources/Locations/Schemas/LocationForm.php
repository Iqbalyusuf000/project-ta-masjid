<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lokasi')
                    ->rules('required')
                    ->maxLength(255),
                Select::make('type')
                    ->label('Jenis Pertemuan')
                    ->reactive()
                    ->options([
                        'offline' => 'Offline',
                        'online' => 'Online',
                    ])
                    ->rules('required'),
                Textarea::make('address')
                    ->label('Alamat')
                    ->rows(3)
                    ->required(fn($get) => $get('type') === 'offline')
                    ->visible(fn($get) => $get('type') === 'offline'),
                TextInput::make('maps_url')
                    ->label('Link Google Maps')
                    ->url()
                    ->required(fn($get) => $get('type') === 'offline')
                    ->visible(fn($get) => $get('type') === 'offline'),
                TextInput::make('online_link')
                    ->label('Link Online')
                    ->url()
                    ->required(fn($get) => $get('type') === 'online')
                    ->visible(fn($get) => $get('type') === 'online'),
            ]);
    }
}
