<?php

namespace App\Filament\Resources\VisionMissions;

use App\Filament\Resources\VisionMissions\Pages\CreateVisionMission;
use App\Filament\Resources\VisionMissions\Pages\EditVisionMission;
use App\Filament\Resources\VisionMissions\Pages\ListVisionMissions;
use App\Filament\Resources\VisionMissions\Pages\ViewVisionMission;
use App\Filament\Resources\VisionMissions\Schemas\VisionMissionForm;
use App\Filament\Resources\VisionMissions\Schemas\VisionMissionInfolist;
use App\Filament\Resources\VisionMissions\Tables\VisionMissionsTable;
use App\Models\VisionMission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class VisionMissionResource extends Resource
{
    protected static ?string $model = VisionMission::class;

    protected static string|UnitEnum|null $navigationGroup = 'Profil';

    protected static ?int $navigationSort = 0;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEye;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    // public static function getNavigationUrl(): string
    // {
    //     $record = \App\Models\VisionMission::first();

    //     if ($record) {
    //         return static::getUrl('view', ['record' => $record]);
    //     }

    //     return static::getUrl('index');
    // }

    public static function form(Schema $schema): Schema
    {
        return VisionMissionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VisionMissionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VisionMissionsTable::configure($table);
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
            'index' => ListVisionMissions::route('/'),
            'view' => ViewVisionMission::route('/{record}'),
            'edit' => EditVisionMission::route('/{record}/edit'),
        ];
    }
}
