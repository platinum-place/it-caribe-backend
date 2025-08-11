<?php

namespace Modules\Vehicle\Presentation\Providers;

use Filament\Navigation\NavigationBuilder;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Modules\Common\Presentation\Filament\FilamentPanelBuilder;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessoryResource;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivityResource;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleColorResource;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleLoanTypeResource;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakeResource;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModelResource;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRouteResource;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypeResource;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUseResource;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilityResource;

class FilamentPanelProvider extends PanelProvider
{
    protected FilamentPanelBuilder $filamentPanel;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->filamentPanel = new FilamentPanelBuilder;
    }

    /**
     * @throws \Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $this->filamentPanel
            ->buildPanel($panel)
            ->id('vehicle')
            ->path('vehicle')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                AccountWidget::class,
            ])
            ->discoverResources(in: base_path('modules/Vehicle/Presentation/Filament/Resources'), for: 'Modules\\Vehicle\\Presentation\\Filament\\Resources')
            ->discoverPages(in: base_path('modules/Vehicle/Presentation/Filament/Pages'), for: 'Modules\\Vehicle\\Presentation\\Filament\\Pages')
            ->discoverWidgets(in: base_path('modules/Vehicle/Presentation/Filament/Widgets'), for: 'Modules\\Vehicle\\Presentation\\Filament\\Widgets')
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $this->filamentPanel
                    ->buildNavigation($builder)
                    ->items([
                        ...VehicleAccessoryResource::getNavigationItems(),
                        ...VehicleActivityResource::getNavigationItems(),
                        ...VehicleColorResource::getNavigationItems(),
                        ...VehicleLoanTypeResource::getNavigationItems(),
                        ...VehicleMakeResource::getNavigationItems(),
                        ...VehicleModelResource::getNavigationItems(),
                        ...VehicleRouteResource::getNavigationItems(),
                        ...VehicleTypeResource::getNavigationItems(),
                        ...VehicleUseResource::getNavigationItems(),
                        ...VehicleUtilityResource::getNavigationItems(),
                    ]);
            });
    }
}
