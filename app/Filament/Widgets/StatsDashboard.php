<?php

namespace App\Filament\Widgets;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donator;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $countDonators = Donator::count();
        $countCampaigns = Campaign::count();
        $countDonateRecieve = Donation::sum('jumlah_donasi');
        $countActiveCampaign = Campaign::where('status', 'aktif')->count();
        return [
            Stat::make('Donator', $countDonators . ' Orang'),
            Stat::make('Campaign', $countCampaigns . ' Campaign'),
            Stat::make('Donasi Diterima', 'Rp ' . number_format($countDonateRecieve, 0, ',', '.')),
            Stat::make('Active Campaign', $countActiveCampaign . ' Campaign'),
        ];
    }
}
