<?php

namespace App\Filament\Resources\ProgresionResource\Pages;

use App\Filament\Resources\ProgresionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgresions extends ListRecords
{
    protected static string $resource = ProgresionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Crear Progresion')
                ->icon('heroicon-o-plus'),
        ];
    }
}
