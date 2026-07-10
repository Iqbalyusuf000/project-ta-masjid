<?php

namespace App\Filament\Resources\DonationCategories\Pages;

use App\Filament\Resources\DonationCategories\DonationCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDonationCategory extends CreateRecord
{
    protected static string $resource = DonationCategoryResource::class;
}
