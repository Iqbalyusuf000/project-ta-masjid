<?php

namespace App\Filament\Resources\ZakatFitrahs;

use App\Filament\Resources\ZakatFitrahs\Pages\CreateZakatFitrah;
use App\Filament\Resources\ZakatFitrahs\Pages\EditZakatFitrah;
use App\Filament\Resources\ZakatFitrahs\Pages\ListZakatFitrahs;
use App\Filament\Resources\ZakatFitrahs\Schemas\ZakatFitrahForm;
use App\Filament\Resources\ZakatFitrahs\Tables\ZakatFitrahsTable;
use App\Models\ZakatFitrah;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ZakatFitrahResource extends Resource
{
    protected static ?string $model = ZakatFitrah::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static string|UnitEnum|null $navigationGroup = 'Zakat, Infaq dan Sedekah';

    protected static ?string $modelLabel = 'Zakat Fitrah';

    protected static ?string $pluralmodelLabel = 'Zakat Fitrah';

    public static function form(Schema $schema): Schema
    {
        return ZakatFitrahForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ZakatFitrahsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListZakatFitrahs::route('/'),
            'create' => CreateZakatFitrah::route('/create'),
            'edit' => EditZakatFitrah::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
