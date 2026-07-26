<?php

namespace App\Filament\Resources\ItikafRegistrations\Pages;

use App\Filament\Resources\ItikafRegistrations\ItikafRegistrationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditItikafRegistration extends EditRecord
{
    protected static string $resource = ItikafRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    /**
     * Hanya kolom 'status' yang boleh diubah oleh admin.
     * Field lain dikembalikan dari data asli model.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Hanya status yang dapat diperbarui admin
        return [
            'status' => $data['status'],
        ];
    }
}
