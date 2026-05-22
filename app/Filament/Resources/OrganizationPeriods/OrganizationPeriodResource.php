<?php

namespace App\Filament\Resources\OrganizationPeriods;

use App\Filament\Resources\OrganizationPeriods\Pages\CreateOrganizationPeriod;
use App\Filament\Resources\OrganizationPeriods\Pages\EditOrganizationPeriod;
use App\Filament\Resources\OrganizationPeriods\Pages\ListOrganizationPeriods;
use App\Filament\Resources\OrganizationPeriods\Schemas\OrganizationPeriodForm;
use App\Filament\Resources\OrganizationPeriods\Tables\OrganizationPeriodsTable;
use App\Models\OrganizationPeriod;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OrganizationPeriodResource extends Resource
{
    protected static ?string $model = OrganizationPeriod::class;

    protected static ?string $modelLabel = 'Organization Period';

    protected static ?string $pluralModelLabel = 'Organization Periods';

    protected static string|UnitEnum|null $navigationGroup = 'Profiles';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    public static function form(Schema $schema): Schema
    {
        return OrganizationPeriodForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganizationPeriodsTable::configure($table);
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
            'index' => ListOrganizationPeriods::route('/'),
            'create' => CreateOrganizationPeriod::route('/create'),
            'edit' => EditOrganizationPeriod::route('/{record}/edit'),
        ];
    }
}
