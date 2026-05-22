<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Pengurus')
                    ->required(),
                FileUpload::make('photo')
                    ->image()
                    ->directory('members')
                    ->disk('public')
                    ->maxSize(5120)
                    ->required(),
            ]);
    }
}
