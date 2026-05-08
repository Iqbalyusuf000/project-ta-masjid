<?php

namespace App\Filament\Resources\VisionMissions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;

class VisionMissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextEntry::make('visi'),
                    TextEntry::make('misi')
                        ->bulleted(),
                ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make([
                    TextEntry::make('created_by'),
                    TextEntry::make('created_at')
                        ->dateTime()
                        ->placeholder('-'),
                    TextEntry::make('updated_at')
                        ->dateTime()
                        ->placeholder('-'),
                ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
