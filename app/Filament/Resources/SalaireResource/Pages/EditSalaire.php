<?php

namespace App\Filament\Resources\SalaireResource\Pages;

use App\Filament\Resources\SalaireResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalaire extends EditRecord
{
    protected static string $resource = SalaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
