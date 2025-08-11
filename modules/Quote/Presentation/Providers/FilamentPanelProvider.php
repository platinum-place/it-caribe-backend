<?php

namespace Modules\Quote\Presentation\Providers;

use Filament\Navigation\NavigationBuilder;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Modules\Quote\Infrastructure\Persistence\Models\Quote;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteLineStatus;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteStatus;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteType;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineResource;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatusResource;
use Modules\Quote\Presentation\Filament\Resources\QuoteResource;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatusResource;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypeResource;
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
            ->discoverWidgets(in: base_path('modules/Quote/Presentation/Filament/Widgets'), for: 'Modules\\Quote\\Presentation\\Filament\\Widgets')
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $this->filamentPanel
                    ->buildNavigation($builder)
                    ->items([
                        ...(auth()->user()->isAdmin() ? QuoteLineStatusResource::getNavigationItems() : []),
                        ...(auth()->user()->isAdmin() ? QuoteStatusResource::getNavigationItems() : []),
                        ...(auth()->user()->isAdmin() ? QuoteTypeResource::getNavigationItems() : []),
                        ...(auth()->user()->isAdmin() ? QuoteResource::getNavigationItems() : []),
                    ]);
            });
    }
}
