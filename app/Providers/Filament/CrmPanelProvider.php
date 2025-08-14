<?php

namespace App\Providers\Filament;

use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class CrmPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return app(FilamentPanelBuilder::class)
            ->buildPanel($panel)
            ->id('crm')
            ->path('crm')
            ->discoverResources(in: app_path('Filament/CRM/Resources'), for: 'App\Filament\CRM\Resources')
            ->discoverPages(in: app_path('Filament/CRM/Pages'), for: 'App\Filament\CRM\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/CRM/Widgets'), for: 'App\Filament\CRM\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ]);
    }
}
