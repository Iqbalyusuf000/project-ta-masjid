<?php

namespace App\Filament\Resources\KajianDetails\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use App\Enum\KajianTypeEnum;
use Filament\Forms\Components\Textarea;

class KajianDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kajian_id')
                    ->label('Judul Kajian')
                    ->required()
                    ->relationship('kajian', 'title'),
                Select::make('ustadz_id')
                    ->label('Nama Ustadz')
                    ->required()
                    ->relationship('ustadz','name'),
                Select::make('location_id')
                    ->label('Lokasi')
                    ->required()
                    ->relationship('location', 'name'),
                TextInput::make('sub_title')
                    ->label('Subtitle')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Deskripsi Kajian')
                    ->required(),
                DatePicker::make('date')
                    ->label('Tanggal Kajian')
                    ->required(),
                Select::make('time_type')
                    ->label('Tipe Waktu Input')
                    ->required()
                    ->reactive()
                    ->options([
                        'fixed' => 'Jam Pasti (Angka)',
                        'phrase' => 'Sesuai Waktu Salat / Istilah',
                    ])
                    ->helperText('Pilihlah salah satu! Start Time digunakan untuk mengatur waktu sesuai jam, 
                    sedangkan Time Phrase untuk mengatur sesuai Waktu Sholat, Contoh: Ba\'da Maghrib'),
                TimePicker::make('start_time')
                    ->label('Waktu Kajian Mulai (Jam)')
                    ->required(fn($get) => $get('time_type') === 'fixed' )
                    ->seconds(false)
                    ->native(false)
                    ->visible( fn($get) => $get('time_type') === 'fixed' ),
                Select::make('time_phrase')
                    ->label('Sesuai Waktu Salat')
                    ->required(fn($get) => $get('time_type') === 'phrase' )
                    ->options([
                        'Ba\'da Subuh' => 'Ba\'da Subuh',
                        'Ba\'da Zuhur' => 'Ba\'da Zuhur',
                        'Ba\'da Ashar' => 'Ba\'da Ashar',
                        'Ba\'da Maghrib' => 'Ba\'da Maghrib',
                        'Ba\'da Isya' => 'Ba\'da Isya',
                    ])
                    ->visible( fn($get) => $get('time_type') === 'phrase' ),
                TextInput::make('note')
                    ->label('Catatan')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('poster')
                    ->label('Poster Kajian')
                    ->required()
                    ->image()
                    ->maxSize(5120)
                    ->disk('public')
                    ->directory('poster_kajian'),
                // Select::make('information')
                //     ->label('Tipe Kegiatan')
                //     ->required()
                //     ->options(KajianTypeEnum::options())
            ]);
    }
}
