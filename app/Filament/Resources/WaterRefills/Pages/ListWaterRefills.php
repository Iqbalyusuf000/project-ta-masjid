<?php

namespace App\Filament\Resources\WaterRefills\Pages;

use App\Filament\Resources\WaterRefills\WaterRefillResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWaterRefills extends ListRecords
{
    protected static string $resource = WaterRefillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
