<?php

namespace App\Filament\Resources\DonationSettings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;

class DonationSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bank_name')
                        ->label('Nama Bank')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('account_number')
                        ->label('Nomor Akun')
                        ->numeric()
                        ->required(),
                    TextInput::make('account_name')
                        ->label('Nama Akun Bank')
                        ->required()
                        ->maxLength(255),
                    FileUpload::make('qris_image')
                        ->label('Gambar QRIS')
                        ->disk('public')
                        ->directory('donations')
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                        ->required(),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->maxLength(65535),
            ]);
    }
}
