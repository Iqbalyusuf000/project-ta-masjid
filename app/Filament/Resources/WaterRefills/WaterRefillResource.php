<?php

namespace App\Filament\Resources\WaterRefills;

use App\Filament\Resources\WaterRefills\Pages\CreateWaterRefill;
use App\Filament\Resources\WaterRefills\Pages\EditWaterRefill;
use App\Filament\Resources\WaterRefills\Pages\ListWaterRefills;
use App\Filament\Resources\WaterRefills\Schemas\WaterRefillForm;
use App\Filament\Resources\WaterRefills\Tables\WaterRefillsTable;
use App\Models\WaterRefill;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class WaterRefillResource extends Resource
{
    protected static ?string $model = WaterRefill::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCubeTransparent;

    protected static string|UnitEnum|null $navigationGroup = 'Unit Usaha Masjid';

    protected static ?string $modelLabel = 'Water Refill';

    protected static ?string $pluralModelLabel = 'Water Refills';

    public static function form(Schema $schema): Schema
    {
        return WaterRefillForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WaterRefillsTable::configure($table);
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
            'index' => ListWaterRefills::route('/'),
            'create' => CreateWaterRefill::route('/create'),
            'edit' => EditWaterRefill::route('/{record}/edit'),
        ];
    }
}
