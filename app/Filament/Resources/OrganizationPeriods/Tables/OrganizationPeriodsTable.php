<?php

namespace App\Filament\Resources\OrganizationPeriods\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrganizationPeriodsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Periode'),
                TextColumn::make('start_year')
                    ->label('Tahun Mulai'),
                TextColumn::make('end_year')
                    ->label('Tahun Selesai'),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Status'),
            ])
            ->defaultSort('is_active', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
