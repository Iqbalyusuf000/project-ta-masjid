<?php

namespace App\Filament\Resources\DonationTransactions\Pages;

use App\Filament\Resources\DonationTransactions\DonationTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditDonationTransaction extends EditRecord
{
    protected static string $resource = DonationTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['status'] === 'success') {
            $data['verified_by'] = auth()->user()->id;
            $data['verified_at'] = now();
        }
        else {
            $data['verified_by'] = null;
            $data['verified_at'] = null;
        }
        return $data;
    }
    
}
