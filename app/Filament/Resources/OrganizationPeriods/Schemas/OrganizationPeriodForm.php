<?php

namespace App\Filament\Resources\OrganizationPeriods\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\IntegerInput;
use Filament\Forms\Components\Toggle;

class OrganizationPeriodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->label('Nama Periode')
                        ->required(),
                    TextInput::make('start_year')
                        ->label('Tahun Mulai')
                        ->numeric()
                        ->minLength(4)
                        ->maxLength(4)
                        ->required(),
                    TextInput::make('end_year')
                        ->label('Tahun Selesai')
                        ->numeric()
                        ->minLength(4)
                        ->maxLength(4)
                        ->required(),
                    Toggle::make('is_active')
                        ->label('Aktif atau tidak')
                        ->helperText(
                            'Jika diaktifkan, periode aktif lainnya akan otomatis dinonaktifkan.'
                        )
                        ->required(),
                ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
