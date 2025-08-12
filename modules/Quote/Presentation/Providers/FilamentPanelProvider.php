<?php

namespace Modules\Quote\Presentation\Providers;

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
            ->id('quote')
            ->path('quote')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                AccountWidget::class,
            ])
            ->discoverResources(in: base_path('modules/Quote/Presentation/Filament/Resources'), for: 'Modules\\Quote\\Presentation\\Filament\\Resources')
            ->discoverPages(in: base_path('modules/Quote/Presentation/Filament/Pages'), for: 'Modules\\Quote\\Presentation\\Filament\\Pages')
            ->discoverWidgets(in: base_path('modules/Quote/Presentation/Filament/Widgets'), for: 'Modules\\Quote\\Presentation\\Filament\\Widgets');
    }
}
