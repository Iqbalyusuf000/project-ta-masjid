<?php

namespace App\Filament\Resources\WaterRefills\Pages;

use App\Filament\Resources\WaterRefills\WaterRefillResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWaterRefill extends EditRecord
{
    protected static string $resource = WaterRefillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
