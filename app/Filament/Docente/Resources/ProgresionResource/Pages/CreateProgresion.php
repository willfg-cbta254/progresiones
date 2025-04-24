<?php

namespace App\Filament\Docente\Resources\ProgresionResource\Pages;

use App\Filament\Docente\Resources\ProgresionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProgresion extends CreateRecord
{
    protected static string $resource = ProgresionResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;

        return $data;
    }
}
