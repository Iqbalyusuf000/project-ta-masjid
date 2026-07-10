<?php

namespace App\Filament\Resources\KajianDetails\Pages;

use App\Filament\Resources\KajianDetails\KajianDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKajianDetails extends ListRecords
{
    protected static string $resource = KajianDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
