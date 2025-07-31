<?php

namespace App\Filament\Resources\EntretientResource\Pages;

use App\Filament\Resources\EntretientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntretient extends EditRecord
{
    protected static string $resource = EntretientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
