<?php

namespace App\Filament\Resources\ItikafRegistrations;

use App\Filament\Resources\ItikafRegistrations\Pages\CreateItikafRegistration;
use App\Filament\Resources\ItikafRegistrations\Pages\EditItikafRegistration;
use App\Filament\Resources\ItikafRegistrations\Pages\ListItikafRegistrations;
use App\Filament\Resources\ItikafRegistrations\Schemas\ItikafRegistrationForm;
use App\Filament\Resources\ItikafRegistrations\Tables\ItikafRegistrationsTable;
use App\Models\ItikafRegistration;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItikafRegistrationResource extends Resource
{
    protected static ?string $model = ItikafRegistration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMoon;

    protected static string|UnitEnum|null $navigationGroup = "I'tikaf Ramadhan";

    protected static ?string $modelLabel = "Pendaftaran I'tikaf";

    protected static ?string $pluralModelLabel = "Pendaftaran I'tikaf";

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ItikafRegistrationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItikafRegistrationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListItikafRegistrations::route('/'),
            'create' => CreateItikafRegistration::route('/create'),
            'edit'   => EditItikafRegistration::route('/{record}/edit'),
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
