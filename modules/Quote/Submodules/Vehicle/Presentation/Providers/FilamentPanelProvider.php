<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Providers;

use Filament\Navigation\NavigationBuilder;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineResource;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatusResource;
use Modules\Quote\Presentation\Filament\Resources\QuoteResource;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatusResource;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypeResource;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleResource;
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
            ->id('vehicle-quote')
            ->path('quote/vehicle-quote')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                AccountWidget::class,
            ])
            ->discoverResources(in: base_path('modules/Quote/Submodules/Vehicle/Presentation/Filament/Resources'), for: 'Modules\\Quote\\Submodules\\Vehicle\\Presentation\\Filament\\Resources')
            ->discoverPages(in: base_path('modules/Quote/Submodules/Vehicle/Presentation/Filament/Pages'), for: 'Modules\\Quote\\Submodules\\Vehicle\\Presentation\\Filament\\Pages')
            ->discoverWidgets(in: base_path('modules/Quote/Submodules/Vehicle/Presentation/Filament/Widgets'), for: 'Modules\\Quote\\Submodules\\Vehicle\\Presentation\\Filament\\Widgets')
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $this->filamentPanel
                    ->buildNavigation($builder)
                    ->items([
                        ...QuoteVehicleResource::getNavigationItems(),
                    ]);
            });
    }
}
