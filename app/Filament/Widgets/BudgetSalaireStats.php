<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Salaire;

class BudgetSalaireStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalSalaires = Salaire::sum('net_a_payer');

        return [
            Stat::make('Total salaires', number_format($totalSalaires, 0, ',', ' ') . ' FCFA')
                ->description('Somme totale des salaires versés')
                ->color('success'),
        ];
    }
}
