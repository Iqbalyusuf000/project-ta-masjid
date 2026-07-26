<?php

namespace App\Filament\Resources\ItikafRegistrations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ItikafRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('itikaf_code')
                    ->label('Kode I\'tikaf')
                    ->disabled()
                    ->columnSpan(1),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending'   => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->columnSpan(1),

                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->columnSpan(1),

                TextInput::make('whatsapp')
                    ->label('Nomor WhatsApp')
                    ->required()
                    ->disabled()
                    ->columnSpan(1),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Ikhwan (L)',
                        'P' => 'Akhwat (P)',
                    ])
                    ->required()
                    ->disabled()
                    ->columnSpan(1),

                TagsInput::make('days_selected')
                    ->label('Hari I\'tikaf Dipilih')
                    ->disabled()
                    ->columnSpan(2),
            ]);
    }
}
