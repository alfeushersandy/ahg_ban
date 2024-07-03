<?php

namespace App\Filament\Resources\TireProfileResource\Pages;

use App\Filament\Resources\TireProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTireProfile extends EditRecord
{
    protected static string $resource = TireProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
