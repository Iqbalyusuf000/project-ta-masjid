<?php

namespace App\Filament\Resources\KajianCategories;

use App\Filament\Resources\KajianCategories\Pages\CreateKajianCategory;
use App\Filament\Resources\KajianCategories\Pages\EditKajianCategory;
use App\Filament\Resources\KajianCategories\Pages\ListKajianCategories;
use App\Filament\Resources\KajianCategories\Schemas\KajianCategoryForm;
use App\Filament\Resources\KajianCategories\Tables\KajianCategoriesTable;
use App\Models\KajianCategory;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KajianCategoryResource extends Resource
{
    protected static ?string $model = KajianCategory::class;

    protected static ?string $modelLabel = 'Kajian Category';

    protected static ?string $pluralmodelLabel = 'Kajian Categories';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static string|UnitEnum|null $navigationGroup = 'Kajian Islam';

    protected static ?int $navigationSort = 0;

    public static function form(Schema $schema): Schema
    {
        return KajianCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KajianCategoriesTable::configure($table);
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
            'index' => ListKajianCategories::route('/'),
            'create' => CreateKajianCategory::route('/create'),
            'edit' => EditKajianCategory::route('/{record}/edit'),
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
