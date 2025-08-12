<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Providers;

use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Modules\Common\Presentation\Filament\FilamentPanelBuilder;

class VehicleQuotePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return app(FilamentPanelBuilder::class)
            ->buildPanel($panel)
            ->id('vehicle-quote')
            ->path('quote/vehicle-quote')
            ->discoverResources(in: base_path('modules/Quote/Submodules/Vehicle/Presentation/Filament/Resources'), for: 'Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources')
            ->discoverPages(in: base_path('modules/Quote/Submodules/Vehicle/Presentation/Filament/Pages'), for: 'Modules\Quote\Submodules\Vehicle\Presentation\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: base_path('modules/Quote/Submodules/Vehicle/Presentation/Filament/Widgets'), for: 'Modules\Quote\Submodules\Vehicle\Presentation\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ]);
    }
}
