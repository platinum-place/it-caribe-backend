<?php

namespace Modules\CRM\Presentation\Providers;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Modules\Common\Presentation\Filament\FilamentPanelBuilder;

class FilamentPanelProvider extends PanelProvider
{
    /**
     * @throws \Exception
     */
    public function panel(Panel $panel): Panel
    {
        return app(FilamentPanelBuilder::class)
            ->buildPanel($panel)
            ->id('crm')
            ->path('crm')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                AccountWidget::class,
            ])
            ->discoverResources(in: base_path('modules/CRM/Presentation/Filament/Resources'), for: 'Modules\\CRM\\Presentation\\Filament\\Resources')
            ->discoverPages(in: base_path('modules/CRM/Presentation/Filament/Pages'), for: 'Modules\\CRM\\Presentation\\Filament\\Pages')
            ->discoverWidgets(in: base_path('modules/CRM/Presentation/Filament/Widgets'), for: 'Modules\\CRM\\Presentation\\Filament\\Widgets');
    }
}
