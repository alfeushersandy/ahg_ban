<?php

namespace App\Filament\Resources\TirePositionResource\Pages;

use App\Filament\Resources\TirePositionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTirePosition extends EditRecord
{
    protected static string $resource = TirePositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
