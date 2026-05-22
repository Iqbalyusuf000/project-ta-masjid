<?php

namespace App\Filament\Resources\Organizations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrganizationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.name')
                    ->label('Nama Pengurus')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('organizationPeriod.name')
                    ->label('Periode')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('position.name')
                    ->label('Posisi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('division.name')
                    ->label('Divisi'),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Status'),
            ])
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
