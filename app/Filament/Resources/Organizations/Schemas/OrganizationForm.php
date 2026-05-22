<?php

namespace App\Filament\Resources\Organizations\Schemas;

use App\Models\OrganizationPeriod;
use App\Models\Position;
use App\Models\Division;
use App\Models\Member;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class OrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_id')
                    ->label('Nama Pengurus')
                    ->options(Member::query()->pluck('name', 'id')->toArray())
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('organization_period_id')
                    ->label('Periode')
                    ->options(OrganizationPeriod::where('is_active', true)->pluck('name', 'id')->toArray())
                    ->required()
                    ->searchable()
                    ->preload(),
                Grid::make(3)
                    ->schema([
                        Select::make('division_id')
                            ->label('Divisi')
                            ->options(Division::query()->pluck('name', 'id')->toArray())
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama Divisi')
                                    ->required(),
                            ])
                            ->createOptionUsing(function (array $data): string {

                                return Division::create([
                                    'name' => $data['name'],
                                ])->id;
                            }),
                        Select::make('position_id')
                            ->label('Posisi')
                            ->options(Position::query()->pluck('name', 'id')->toArray())
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama Divisi')
                                    ->required(),
                            ])
                            ->createOptionUsing(function (array $data): string {

                                return Position::create([
                                    'name' => $data['name'],
                                ])->id;
                            }),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->minLength(1)
                            ->maxLength(2)
                            ->required(),
                    ])
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Aktif atau tidak')
                    ->required(),
            ]);
    }
}
