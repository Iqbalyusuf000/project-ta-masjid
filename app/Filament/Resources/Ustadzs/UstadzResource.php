<?php

namespace App\Filament\Resources\Ustadzs;

use App\Filament\Resources\Ustadzs\Pages\CreateUstadz;
use App\Filament\Resources\Ustadzs\Pages\EditUstadz;
use App\Filament\Resources\Ustadzs\Pages\ListUstadzs;
use App\Filament\Resources\Ustadzs\Schemas\UstadzForm;
use App\Filament\Resources\Ustadzs\Tables\UstadzsTable;
use App\Models\Ustadz;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UstadzResource extends Resource
{
    protected static ?string $model = Ustadz::class;

    protected static ?string $modelLabel = 'Ustadz';

    protected static ?string $pluralModelLabel = 'Ustadzs';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static string|UnitEnum|null $navigationGroup = 'Kajian Islam';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return UstadzForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UstadzsTable::configure($table);
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
            'index' => ListUstadzs::route('/'),
            'create' => CreateUstadz::route('/create'),
            'edit' => EditUstadz::route('/{record}/edit'),
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
