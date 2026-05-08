<?php

namespace App\Filament\Resources\VisionMissions\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VisionMissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('visi')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                Repeater::make('misi')
                    ->simple(
                        TextInput::make('item')->required()
                    )
                    ->label('Misi')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
