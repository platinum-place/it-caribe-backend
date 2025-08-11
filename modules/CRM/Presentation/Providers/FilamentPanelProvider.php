<?php

namespace Modules\CRM\Presentation\Providers;

use Filament\Navigation\NavigationBuilder;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Modules\CRM\Presentation\Filament\Resources\DebtorResource;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypeResource;
use Modules\Support\FilamentPanel;

class FilamentPanelProvider extends PanelProvider
{
    protected FilamentPanel $filamentPanel;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->filamentPanel = new FilamentPanel;
    }

    /**
     * @throws \Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $this->filamentPanel
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
            ->discoverWidgets(in: base_path('modules/CRM/Presentation/Filament/Widgets'), for: 'Modules\\CRM\\Presentation\\Filament\\Widgets')
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $this->filamentPanel
                    ->buildNavigation($builder)
                    ->items([
                        ...DebtorTypeResource::getNavigationItems(),
                        ...DebtorResource::getNavigationItems(),
                    ]);
            });
    }
}
