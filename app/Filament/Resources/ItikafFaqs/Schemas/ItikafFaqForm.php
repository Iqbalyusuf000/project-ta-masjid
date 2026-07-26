<?php

namespace App\Filament\Resources\ItikafFaqs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ItikafFaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('question')
                    ->label('Pertanyaan')
                    ->required()
                    ->maxLength(500)
                    ->columnSpan(2),

                Textarea::make('answer')
                    ->label('Jawaban')
                    ->required()
                    ->rows(5)
                    ->columnSpan(2),

                TextInput::make('sort_order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0)
                    ->helperText('Semakin kecil angka, semakin awal tampil.')
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Tampilkan di Halaman Publik')
                    ->default(true)
                    ->columnSpan(1),
            ]);
    }
}
