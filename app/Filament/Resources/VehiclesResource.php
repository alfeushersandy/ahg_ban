<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vehicle;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SubCategory;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Filament\Resources\VehiclesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VehiclesResource\RelationManagers;

class VehiclesResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kendaraan')
                    ->required(),
                Forms\Components\TextInput::make('kode_kabin')
                    ->required(),
                Forms\Components\TextInput::make('nopol')
                    ->required(),
                Forms\Components\TextInput::make('sn'),
                Forms\Components\TextInput::make('no_mesin'),
                Forms\Components\TextInput::make('no_rangka'),
                Forms\Components\Select::make('kategori_id')
                    ->relationship('category', 'nama_kategori')
                    ->required()
                    ->afterStateUpdated(function (Set $set) {
                        $set('sub_category_id', null);
                    })
                    ->live(),
                Forms\Components\Select::make('sub_kategori_id')
                    ->options(fn (Get $get): Collection => SubCategory::query()
                        ->where('kategori_id', $get('kategori_id'))
                        ->pluck('sub_kategori', 'id'))
                    ->required(),
                Forms\Components\Select::make('profile_ban_id')
                    ->relationship('tireProfile', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kendaraan'),
                Tables\Columns\TextColumn::make('kode_kabin'),
                Tables\Columns\TextColumn::make('nopol'),
                Tables\Columns\TextColumn::make('sn'),
                Tables\Columns\TextColumn::make('no_mesin'),
                Tables\Columns\TextColumn::make('no_rangka'),
                Tables\Columns\TextColumn::make('category.nama_kategori'),
                Tables\Columns\TextColumn::make('tireProfile.name'),
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicles::route('/create'),
            'edit' => Pages\EditVehicles::route('/{record}/edit'),
        ];
    }
}
