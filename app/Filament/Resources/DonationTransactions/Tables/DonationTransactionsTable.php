<?php

namespace App\Filament\Resources\DonationTransactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class DonationTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donation_code')
                    ->label('Donation Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('donation_category.name')
                    ->label('Donation Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('source')
                    ->label('Source')
                    ->searchable()  
                    ->sortable(),
                TextColumn::make('donation_name')
                    ->label('Donation Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->label('Total Amount')
                    ->searchable()
                    ->sortable()
                    ->money('IDR'),
                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
