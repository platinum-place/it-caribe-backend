<?php

namespace App\Providers\Filament;

use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class QuoteVehiclePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return app(FilamentPanelBuilder::class)
            ->buildPanel($panel)
            ->id('quote-vehicle')
            ->path('quote-vehicle')
            ->discoverResources(in: app_path('Filament/QuoteVehicle/Resources'), for: 'App\Filament\QuoteVehicle\Resources')
            ->discoverPages(in: app_path('Filament/QuoteVehicle/Pages'), for: 'App\Filament\QuoteVehicle\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/QuoteVehicle/Widgets'), for: 'App\Filament\QuoteVehicle\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ]);
    }
}
