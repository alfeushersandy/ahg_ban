<?php

namespace App\Filament\Resources\TireUsageResource\Pages;

use App\Filament\Resources\TireUsageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTireUsage extends EditRecord
{
    protected static string $resource = TireUsageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
