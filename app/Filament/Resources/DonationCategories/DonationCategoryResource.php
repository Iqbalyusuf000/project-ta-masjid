<?php

namespace App\Filament\Resources\DonationCategories;

use App\Filament\Resources\DonationCategories\Pages\CreateDonationCategory;
use App\Filament\Resources\DonationCategories\Pages\EditDonationCategory;
use App\Filament\Resources\DonationCategories\Pages\ListDonationCategories;
use App\Filament\Resources\DonationCategories\Schemas\DonationCategoryForm;
use App\Filament\Resources\DonationCategories\Tables\DonationCategoriesTable;
use App\Models\DonationCategory;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonationCategoryResource extends Resource
{
    protected static ?string $model = DonationCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static string|UnitEnum|null $navigationGroup = 'Zakat, Infaq dan Sedekah';

    protected static ?string $modelLabel = 'Donation Category';

    protected static ?string $pluralModelLabel = 'Donation Categories';

    public static function form(Schema $schema): Schema
    {
        return DonationCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DonationCategoriesTable::configure($table);
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
            'index' => ListDonationCategories::route('/'),
            'create' => CreateDonationCategory::route('/create'),
            'edit' => EditDonationCategory::route('/{record}/edit'),
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
