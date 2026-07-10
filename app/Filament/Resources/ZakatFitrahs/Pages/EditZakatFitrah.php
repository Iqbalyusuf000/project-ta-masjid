<?php

namespace App\Filament\Resources\ZakatFitrahs\Pages;

use App\Filament\Resources\ZakatFitrahs\ZakatFitrahResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditZakatFitrah extends EditRecord
{
    protected static string $resource = ZakatFitrahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['zakat_status'] === 'confirmed') {
            $data['verified_at'] = now();
        }
        else {
            $data['verified_at'] = null;
        }
        return $data;
    }
}
