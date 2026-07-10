<?php

namespace App\Filament\Resources\ZakatFitrahs\Pages;

use App\Filament\Resources\ZakatFitrahs\ZakatFitrahResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZakatFitrahs extends ListRecords
{
    protected static string $resource = ZakatFitrahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
