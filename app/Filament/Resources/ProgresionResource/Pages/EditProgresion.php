<?php

namespace App\Filament\Resources\ProgresionResource\Pages;

use App\Filament\Resources\ProgresionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgresion extends EditRecord
{
    protected static string $resource = ProgresionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->label('Eliminar Progresion')
            ->icon('heroicon-o-trash'),
        ];
    }
}
