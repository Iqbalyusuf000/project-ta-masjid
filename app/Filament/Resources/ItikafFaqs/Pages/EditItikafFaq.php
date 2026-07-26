<?php

namespace App\Filament\Resources\ItikafFaqs\Pages;

use App\Filament\Resources\ItikafFaqs\ItikafFaqResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditItikafFaq extends EditRecord
{
    protected static string $resource = ItikafFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
