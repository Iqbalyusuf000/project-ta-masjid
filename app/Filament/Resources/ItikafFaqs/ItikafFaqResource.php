<?php

namespace App\Filament\Resources\ItikafFaqs;

use App\Filament\Resources\ItikafFaqs\Pages\CreateItikafFaq;
use App\Filament\Resources\ItikafFaqs\Pages\EditItikafFaq;
use App\Filament\Resources\ItikafFaqs\Pages\ListItikafFaqs;
use App\Filament\Resources\ItikafFaqs\Schemas\ItikafFaqForm;
use App\Filament\Resources\ItikafFaqs\Tables\ItikafFaqsTable;
use App\Models\ItikafFaq;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItikafFaqResource extends Resource
{
    protected static ?string $model = ItikafFaq::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static string|UnitEnum|null $navigationGroup = "I'tikaf Ramadhan";

    protected static ?string $modelLabel = "FAQ I'tikaf";

    protected static ?string $pluralModelLabel = "FAQ I'tikaf";

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ItikafFaqForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItikafFaqsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListItikafFaqs::route('/'),
            'create' => CreateItikafFaq::route('/create'),
            'edit'   => EditItikafFaq::route('/{record}/edit'),
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
