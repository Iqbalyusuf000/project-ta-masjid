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
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('donation_code')
                    ->label('Donation Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('related_code')
                    ->label('Terkait Dengan')
                    ->getStateUsing(function ($record) {
                        if ($record->reference_type === 'zakat_fitrah' && $record->zakat_fitrah) {
                            return 'Zakat: ' . $record->zakat_fitrah->zakat_code;
                        } elseif ($record->reference_type === 'itikaf_registration' && $record->itikaf_registration) {
                            return 'I\'tikaf: ' . $record->itikaf_registration->itikaf_code;
                        }
                        return '-';
                    }),
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
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('Payment Method')
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

