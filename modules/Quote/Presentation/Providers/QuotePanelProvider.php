<?php

namespace Modules\Quote\Presentation\Providers;

use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Modules\Common\Presentation\Filament\FilamentPanelBuilder;

class QuotePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return app(FilamentPanelBuilder::class)
            ->buildPanel($panel)
            ->default()
            ->id('quote')
            ->path('quote')
            ->discoverResources(in: base_path('modules/Quote/Presentation/Filament/Resources'), for: 'Modules\Quote\Presentation\Filament\Resources')
            ->discoverPages(in: base_path('modules/Quote/Presentation/Filament/Pages'), for: 'Modules\Quote\Presentation\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: base_path('modules/Quote/Presentation/Filament/Widgets'), for: 'Modules\Quote\Presentation\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ]);
    }
}
