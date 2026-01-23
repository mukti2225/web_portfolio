<?php

namespace App\Filament\Resources\UiResource\Pages;

use App\Filament\Resources\UiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUi extends EditRecord
{
    protected static string $resource = UiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
