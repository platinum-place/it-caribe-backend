<?php

namespace App\Providers\Filament;

use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class QuotePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return app(FilamentPanelBuilder::class)
            ->buildPanel($panel)
            ->default()
            ->id('quote')
            ->path('quote')
            ->discoverResources(in: app_path('Filament/Quote/Resources'), for: 'App\Filament\Quote\Resources')
            ->discoverPages(in: app_path('Filament/Quote/Pages'), for: 'App\Filament\Quote\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Quote/Widgets'), for: 'App\Filament\Quote\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ]);
    }
}
