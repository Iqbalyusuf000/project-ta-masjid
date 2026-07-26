<?php

namespace App\Filament\Resources\ExpenseTransactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ExpenseTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('expense_code')
                    ->label('Kode Pengeluaran')
                    ->default(fn () => 'EXP-' . strtoupper(Str::random(6)))
                    ->required()
                    ->disabled()
                    ->unique(ignoreRecord: true),

                TextInput::make('title')
                    ->label('Keterangan Pengeluaran')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('cth: Pembelian ATK bulan Juli'),

                Select::make('category')
                    ->label('Kategori')
                    ->required()
                    ->options([
                        'operasional'  => 'Operasional',
                        'pembangunan'  => 'Pembangunan',
                        'sosial'       => 'Sosial',
                        'lain-lain'    => 'Lain-lain',
                    ]),

                TextInput::make('amount')
                    ->label('Jumlah (Rp)')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(1),

                DatePicker::make('expense_date')
                    ->label('Tanggal Pengeluaran')
                    ->required()
                    ->default(now()),

                FileUpload::make('receipt_image')
                    ->label('Bukti Kuitansi / Nota')
                    ->image()
                    ->directory('receipts')
                    ->maxSize(2048)
                    ->nullable(),
            ]);
    }
}
