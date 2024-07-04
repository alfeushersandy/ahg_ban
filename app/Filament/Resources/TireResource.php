<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TireResource\Pages;
use App\Filament\Resources\TireResource\RelationManagers;
use App\Models\Tire;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TireResource extends Resource
{
    protected static ?string $model = Tire::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Ban';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('serial_number')
                    ->required()
                    ->unique(),
                Forms\Components\Select::make('type')
                    ->options([
                        'Ban 1000 x 20' => 'Ban 1000 x 20',
                        'Ban 750 x 16' => 'Ban 750 x 16',
                        'Ban 1100 x 20' => 'Ban 1100 x 20',
                    ]),
                Forms\Components\DatePicker::make('arrival_date')
                    ->required(),
                Forms\Components\TextInput::make('cap_code')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Baru' => 'Baru',
                        'Bekas' => 'Bekas',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('serial_number')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('arrival_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('cap_code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('usage_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('status')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTires::route('/'),
        ];
    }
}
