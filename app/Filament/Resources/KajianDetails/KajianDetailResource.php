<?php

namespace App\Filament\Resources\KajianDetails;

use App\Filament\Resources\KajianDetails\Pages\CreateKajianDetail;
use App\Filament\Resources\KajianDetails\Pages\EditKajianDetail;
use App\Filament\Resources\KajianDetails\Pages\ListKajianDetails;
use App\Filament\Resources\KajianDetails\Schemas\KajianDetailForm;
use App\Filament\Resources\KajianDetails\Tables\KajianDetailsTable;
use App\Models\KajianDetail;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KajianDetailResource extends Resource
{
    protected static ?string $model = KajianDetail::class;

    protected static ?string $modelLabel = 'Kajian Detail';

    protected static ?string $pluralmodelLabel = 'Kajian Details';
    
    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string|UnitEnum|null $navigationGroup = 'Kajian Islam';

    public static function form(Schema $schema): Schema
    {
        return KajianDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KajianDetailsTable::configure($table);
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
            'index' => ListKajianDetails::route('/'),
            'create' => CreateKajianDetail::route('/create'),
            'edit' => EditKajianDetail::route('/{record}/edit'),
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
