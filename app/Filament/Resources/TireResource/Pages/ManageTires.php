<?php

namespace App\Filament\Resources\TireResource\Pages;

use App\Filament\Resources\TireResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTires extends ManageRecords
{
    protected static string $resource = TireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
