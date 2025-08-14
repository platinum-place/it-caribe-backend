<?php

namespace App\Providers\Filament;

use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class VehiclePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return app(FilamentPanelBuilder::class)
            ->buildPanel($panel)
            ->id('vehicle')
            ->path('vehicle')
            ->discoverResources(in: app_path('Filament/Vehicle/Resources'), for: 'App\Filament\Vehicle\Resources')
            ->discoverPages(in: app_path('Filament/Vehicle/Pages'), for: 'App\Filament\Vehicle\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Vehicle/Widgets'), for: 'App\Filament\Vehicle\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ]);
    }
}
