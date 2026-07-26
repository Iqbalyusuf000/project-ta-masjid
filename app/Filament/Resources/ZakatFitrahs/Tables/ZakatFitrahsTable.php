<?php

namespace App\Filament\Resources\ZakatFitrahs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ZakatFitrahsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('zakat_code')
                    ->label('Kode Zakat')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('muzakki_name')
                    ->label('Nama Muzakki')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Alamat')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_people')
                    ->label('Jumlah Jiwa')
                    ->sortable(),
                TextColumn::make('rice_total')
                    ->label('Jumlah Beras')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => $state . ' Kg'),
                TextColumn::make('infaq.total_amount')
                    ->label('Infaq Tambahan')
                    ->money('idr')
                    ->default('Rp 0')
                    ->sortable(),
                IconColumn::make('zakat_status')
                    ->label('Status Transaksi')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('zakat_status')
                    ->label('Status Zakat')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending'   => 'warning',
                        'failed'    => 'danger',
                        default     => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'confirmed' => 'Dikonfirmasi',
                        'pending' => 'Pending',
                        default     => 'Pending',
                    })
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

