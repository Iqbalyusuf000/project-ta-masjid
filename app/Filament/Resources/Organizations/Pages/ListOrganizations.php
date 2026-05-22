<?php

namespace App\Filament\Resources\Organizations\Pages;

use App\Filament\Resources\Organizations\OrganizationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListOrganizations extends ListRecords
{
    protected static string $resource = OrganizationResource::class;

    protected static ?string $description = '';

    public function getSubheading(): string|Htmlable|null
    {
        return 'Sebelum mengisi bagian Organization, harap mengisi bagian sebelumnya (atas) terlebih dahulu.';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
