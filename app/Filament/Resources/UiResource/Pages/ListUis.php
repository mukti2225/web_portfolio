<?php

namespace App\Filament\Resources\UiResource\Pages;

use App\Filament\Resources\UiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUis extends ListRecords
{
    protected static string $resource = UiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
