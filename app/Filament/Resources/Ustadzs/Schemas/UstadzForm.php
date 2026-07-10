<?php

namespace App\Filament\Resources\Ustadzs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UstadzForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Ustadz')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Deskripsi Ustadz')
                    ->required(),
                FileUpload::make('photo')
                    ->label('Foto Ustadz')
                    ->image()
                    ->maxSize(5120)
                    ->disk('public')
                    ->directory('ustadz')
                    ->imageAspectRatio('1:1'),
            ]);
    }
}
