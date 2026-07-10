<?php

namespace App\Filament\Resources\KajianCategories\Pages;

use App\Filament\Resources\KajianCategories\KajianCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKajianCategories extends ListRecords
{
    protected static string $resource = KajianCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
