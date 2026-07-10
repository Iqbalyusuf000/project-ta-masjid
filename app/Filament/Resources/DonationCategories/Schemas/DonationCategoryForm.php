<?php

namespace App\Filament\Resources\DonationCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DonationCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('Nama Kategori Donasi')
                    ->maxLength(255),
                TextInput::make('description')
                    ->required()
                    ->label('Deskripsi Donasi'),
                TextInput::make('icon')
                    ->label('Icon (Optional, eg. mdi:mosque)')
                    ->maxLength(255),
                TextInput::make('target_amount')
                    ->label('Target Donasi (Optional)')
                    ->numeric(),
                TextInput::make('badge')
                    ->label('Badge (Optional, eg. Mendesak)')
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->required()
                    ->label('Status'),
            ]);
    }
}
