<?php

namespace App\Filament\Resources\DesainResource\Pages;

use App\Filament\Resources\DesainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDesains extends ListRecords
{
    protected static string $resource = DesainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
