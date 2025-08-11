<?php

namespace App\Providers\Filament;

use App\Filament\Resources\UserResource;
use Filament\Navigation\NavigationBuilder;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Modules\Support\FilamentPanel;

class AdminPanelProvider extends PanelProvider
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
            ->default()
            ->id('admin')
            ->path('admin')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                AccountWidget::class,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $this->filamentPanel
                    ->buildNavigation($builder)
                    ->items([
                        ...UserResource::getNavigationItems(),
                    ]);
            });
    }
}
