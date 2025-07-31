<?php

namespace App\Filament\Resources\EntretientResource\Pages;

use App\Filament\Resources\EntretientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEntretients extends ListRecords
{
    protected static string $resource = EntretientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
