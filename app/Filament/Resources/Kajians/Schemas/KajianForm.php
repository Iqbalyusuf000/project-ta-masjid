<?php

namespace App\Filament\Resources\Kajians\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;

class KajianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Kajian')
                    ->required()
                    ->reactive()
                    ->maxLength(255)
                    ->afterStateUpdated(function($set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated(),
                Select::make('kajian_category_id')
                    ->label('Kategori Kajian')
                    ->relationship('kajianCategory','name')
                    ->required(),
                Select::make('type')
                    ->label('Tipe Kajian')
                    ->required()
                    ->options([
                        'kajian_rutin' => 'Kajian Rutin',
                        'kajian_tematik' => 'Kajian Tematik',
                        'tabligh_akbar'=> 'Tabligh Akbar',
                    ]),
            ]);
    }
}
