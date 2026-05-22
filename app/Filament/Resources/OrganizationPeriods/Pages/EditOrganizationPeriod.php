<?php

namespace App\Filament\Resources\OrganizationPeriods\Pages;

use App\Filament\Resources\OrganizationPeriods\OrganizationPeriodResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrganizationPeriod extends EditRecord
{
    protected static string $resource = OrganizationPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
