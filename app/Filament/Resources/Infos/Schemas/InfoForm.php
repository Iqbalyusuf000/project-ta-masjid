<?php

namespace App\Filament\Resources\Infos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('address')
                    ->label('Alamat')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone_number')
                    ->label('Nomor Telepon')
                    ->required()
                    ->tel()
                    ->minLength(10)
                    ->maxLength(13)
                    ->placeholder('Harap mengisi nomor telepon dengan awalan 08x'),
                TextInput::make('email')
                    ->label('Email')
                    ->placeholder('Harap mengisi email sesuai dengan format email')
                    ->required()
                    ->email()
                    ->regex('/^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/'),
            ]);
    }
}
