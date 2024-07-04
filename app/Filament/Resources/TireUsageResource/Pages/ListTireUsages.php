<?php

namespace App\Filament\Resources\TireUsageResource\Pages;

use App\Filament\Resources\TireUsageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTireUsages extends ListRecords
{
    protected static string $resource = TireUsageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
