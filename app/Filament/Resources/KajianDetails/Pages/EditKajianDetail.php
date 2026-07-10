<?php

namespace App\Filament\Resources\KajianDetails\Pages;

use App\Filament\Resources\KajianDetails\KajianDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditKajianDetail extends EditRecord
{
    protected static string $resource = KajianDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
