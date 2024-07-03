<?php

namespace App\Filament\Resources\TirePositionResource\Pages;

use App\Filament\Resources\TirePositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTirePositions extends ListRecords
{
    protected static string $resource = TirePositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
