<?php

namespace Modules\CRM\Presentation\Providers;

use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Modules\Common\Presentation\Filament\FilamentPanelBuilder;

class CrmPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return app(FilamentPanelBuilder::class)
            ->buildPanel($panel)
            ->id('crm')
            ->path('crm')
            ->discoverResources(in: base_path('modules/CRM/Presentation/Filament/Resources'), for: 'Modules\CRM\Presentation\Filament\Resources')
            ->discoverPages(in: base_path('modules/CRM/Presentation/Filament/Pages'), for: 'Modules\CRM\Presentation\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: base_path('modules/CRM/Presentation/Filament/Widgets'), for: 'Modules\CRM\Presentation\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ]);
    }
}
