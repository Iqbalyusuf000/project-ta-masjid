<?php

namespace App\Filament\Resources\ItikafRegistrations\Pages;

use App\Filament\Resources\ItikafRegistrations\ItikafRegistrationResource;
use Filament\Resources\Pages\ListRecords;

class ListItikafRegistrations extends ListRecords
{
    protected static string $resource = ItikafRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Pendaftaran hanya dari publik, tidak dari admin
        ];
    }
}
