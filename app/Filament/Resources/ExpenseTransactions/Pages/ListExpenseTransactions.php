<?php

namespace App\Filament\Resources\ExpenseTransactions\Pages;

use App\Filament\Resources\ExpenseTransactions\ExpenseTransactionResource;
use Filament\Resources\Pages\ListRecords;

class ListExpenseTransactions extends ListRecords
{
    protected static string $resource = ExpenseTransactionResource::class;
}
