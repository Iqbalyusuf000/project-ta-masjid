<?php

namespace App\Filament\Resources\KajianCategories\Pages;

use App\Filament\Resources\KajianCategories\KajianCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditKajianCategory extends EditRecord
{
    protected static string $resource = KajianCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
