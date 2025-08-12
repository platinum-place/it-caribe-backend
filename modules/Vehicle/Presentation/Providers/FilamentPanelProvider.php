<?php

namespace Modules\Vehicle\Presentation\Providers;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Modules\Common\Presentation\Filament\FilamentPanelBuilder;

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
            ->discoverWidgets(in: base_path('modules/Vehicle/Presentation/Filament/Widgets'), for: 'Modules\\Vehicle\\Presentation\\Filament\\Widgets');
    }
}
