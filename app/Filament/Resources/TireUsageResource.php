<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Vehicle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use App\Models\TireUsage;
use Filament\Tables\Table;
use App\Models\TirePosition;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TireUsageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TireUsageResource\RelationManagers;

class TireUsageResource extends Resource
{
    protected static ?string $model = TireUsage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Ban';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vehicle_id')
                    ->relationship('vehicle', 'nama_kendaraan')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $vehicle = Vehicle::find($state);
                        $set('max_tires', $vehicle?->tireProfile?->number_of_tires);
                        $tireUsages = $get('tire_usages') ?? [];
                        foreach ($tireUsages as &$usage) {
                            $usage['vehicle_id'] = $state;
                        }
                        $set('tire_usages', $tireUsages);
                    }),
                Forms\Components\DatePicker::make('usage_date')
                    ->required(),
                Forms\Components\Repeater::make('tire_usages')
                    ->schema(fn (Get $get): array => [
                                Forms\Components\Select::make('tire_id')
                                    ->relationship('tire', 'serial_number')
                                    ->searchable()
                                    ->required(),
                                Forms\Components\Select::make('position_id')
                                    ->options(function () use ($get) {
                                        $vehicleId = $get('vehicle_id');
                                        if (!$vehicleId) {
                                            return [];
                                        }
                                        $vehicle = Vehicle::find($vehicleId);
                                        $tireProfileId = $vehicle->profile_ban_id;
                                        $allPositions = TirePosition::where('tire_profile_id', $tireProfileId)
                                            ->pluck('position', 'id')
                                            ->toArray();
                                        $selectedPositions = collect($get('position_id') ?? [])
                                            ->pluck('position_id')
                                            ->toArray();
                                        $filteredArray = array_diff_key($allPositions, array_flip($selectedPositions));

                                        return $filteredArray;
                                    })
                                    ->live()
                                    ->required()
                            
                    ])
                    ->minItems(1)
                    ->maxItems(function (callable $get) {
                        return $get('max_tires') ?? 1;
                    })
                    ->afterStateHydrated(function (callable $get, callable $set) {
                        $tireUsages = $get('tire_usages') ?? [];
                        foreach ($tireUsages as &$usage) {
                            $usage['vehicle_id'] = $get('vehicle_id');
                        }
                        $set('tire_usages', $tireUsages);
                    })
                    ->rules([
                        fn (): Closure => function ($state, callable $get) {
                            if (count($state) > $get('max_tires')) {
                                return 'Jumlah ban melebihi batas maksimum!';
                            }
                        },
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTireUsages::route('/'),
            'create' => Pages\CreateTireUsage::route('/create'),
            'edit' => Pages\EditTireUsage::route('/{record}/edit'),
        ];
    }
}
