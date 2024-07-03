<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TirePositionResource\Pages;
use App\Filament\Resources\TirePositionResource\RelationManagers;
use App\Models\TirePosition;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TirePositionResource extends Resource
{
    protected static ?string $model = TirePosition::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tire_profile_id')
                ->relationship('tireProfile', 'name')
                ->required(),
                Forms\Components\TextInput::make('position')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tireProfile.name')->label('Tire Profile')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('position')->sortable()->searchable(),
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
            'index' => Pages\ListTirePositions::route('/'),
            'create' => Pages\CreateTirePosition::route('/create'),
            'edit' => Pages\EditTirePosition::route('/{record}/edit'),
        ];
    }
}
