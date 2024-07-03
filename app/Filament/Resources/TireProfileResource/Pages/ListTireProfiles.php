<?php

namespace App\Filament\Resources\TireProfileResource\Pages;

use App\Filament\Resources\TireProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTireProfiles extends ListRecords
{
    protected static string $resource = TireProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
