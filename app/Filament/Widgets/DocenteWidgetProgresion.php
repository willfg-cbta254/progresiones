<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DocenteWidgetProgresion extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de Progresiones', $this->getTotalProgresion())
                ->icon('heroicon-o-document-text')
                ->color('success'),
            Stat::make('Humanidades', $this->getProgresionByHumanidades())
                ->icon('heroicon-o-finger-print')
                ->color('primary'),
            Stat::make('Cultura Digital', $this->getProgresionByCulturaDigital())
                ->icon('heroicon-o-computer-desktop')
                ->color('primary'),
            Stat::make('Ciencias Sociales', $this->getProgresionByCienciasSociales())
                ->icon('heroicon-o-building-library')
                ->color('primary'),
            Stat::make('Ciencias Naturales, Experimentales y Tecnologicas', $this->getProgresionByCienciasNaturales())
                ->icon('heroicon-o-beaker')
                ->color('primary'),
            Stat::make('Pensamiento Matematico', $this->getProgresionByPensamientoMatematico())
                ->icon('heroicon-o-calculator')
                ->color('primary'),
            Stat::make('Lengua y Comunicacion', $this->getProgresionByLenguaYComunicacion())
                ->icon('heroicon-o-book-open')
                ->color('primary'),
            Stat::make('Conciencia Historica', $this->getProgresionByConcienciaHistorica())
                ->icon('heroicon-o-globe-americas')
                ->color('primary'),
            Stat::make('Ingles', $this->getProgresionByIngles())
                ->icon('heroicon-o-language')
                ->color('primary'),

        ];
    }

    protected function getTotalProgresion()
    {
        return \App\Models\Progresion::count();
    }

    protected function getProgresionByHumanidades()
    {
        return \App\Models\Progresion::where('uac', 'Humanidades')->count();
    }

    protected function getProgresionByCulturaDigital()
    {
        return \App\Models\Progresion::where('uac', 'Cultura Digital')->count();
    }

    protected function getProgresionByCienciasSociales()
    {
        return \App\Models\Progresion::where('uac', 'Ciencias Sociales')->count();
    }

    protected function getProgresionByCienciasNaturales()
    {
        return \App\Models\Progresion::where('uac', 'Ciencias Naturales, Experimentales y Tecnologicas')->count();
    }

    protected function getProgresionByPensamientoMatematico()
    {
        return \App\Models\Progresion::where('uac', 'Pensamiento Matematico')->count();
    }

    protected function getProgresionByLenguaYComunicacion()
    {
        return \App\Models\Progresion::where('uac', 'Lengua y Comunicacion')->count();
    }

    protected function getProgresionByConcienciaHistorica()
    {
        return \App\Models\Progresion::where('uac', 'Conciencia Historica')->count();
    }

    protected function getProgresionByIngles()
    {
        return \App\Models\Progresion::where('uac', 'Ingles')->count();
    }
}
