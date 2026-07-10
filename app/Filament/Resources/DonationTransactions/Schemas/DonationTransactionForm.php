<?php

namespace App\Filament\Resources\DonationTransactions\Schemas;

use App\Models\DonationCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DonationTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('donation_code')
                    ->label('Donation Code')
                    ->required()
                    ->disabled(),
                Select::make('donation_category_id')
                    ->label('Donation Category')
                    ->options(DonationCategory::all()->pluck('name', 'id'))
                    ->required()
                    ->disabled(),
                TextInput::make('source')
                    ->label('Source')
                    ->required()
                    ->disabled(),
                TextInput::make('donation_name')
                    ->label('Donation Name')
                    ->required()
                    ->disabled(),
                TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->disabled(),
                TextInput::make('unique_code')
                    ->label('Unique Code')
                    ->required()
                    ->disabled(),
                TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->required()
                    ->disabled(),
                TextInput::make('payment_method')
                    ->label('Payment Method')
                    ->required()
                    ->disabled(),
                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                    ])
                    ->required(),
                Select::make('reference_type')
                    ->label('Reference Type')
                    ->options([
                        'zakat_fitrah' => 'Zakat Fitrah',
                        'donation' => 'Donation',
                    ])
                    ->required()
                    ->disabled(),
                TextInput::make('reference_id')
                    ->label('Reference ID')
                    ->required()
                    ->disabled(),
            ]);
    }
}
