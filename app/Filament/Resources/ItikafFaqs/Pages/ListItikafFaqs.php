<?php

namespace App\Filament\Resources\ItikafFaqs\Pages;

use App\Filament\Resources\ItikafFaqs\ItikafFaqResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListItikafFaqs extends ListRecords
{
    protected static string $resource = ItikafFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
