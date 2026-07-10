<?php

namespace App\Filament\Resources\WaterRefills\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class WaterRefillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Produk')
                    ->required(),
                TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->required()
                    ->minLength(3)
                    ->maxLength(10)
                    ->prefix('Rp.'),
                Textarea::make('description')
                    ->label('Deskripsi Produk')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('photo')
                    ->image()
                    ->label('Foto Produk')
                    ->maxSize(5120)
                    ->disk('public')
                    ->directory('water-refill-photos')
                    ->required()
                    ->imagePreviewHeight(200),
                Select::make('info')
                    ->label('Status Ketersediaan')
                    ->options([
                        'Tersedia' => 'Tersedia',
                        'Tidak Tersedia' => 'Tidak Tersedia',
                    ])
                    ->required(),
                Toggle::make('is_active')
                    ->label('Status')
                    ->required(),
            ]);
    }
}
