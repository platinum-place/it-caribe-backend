<?php

namespace Modules\Support;

use App\Filament\Pages\EditProfile;
use App\Filament\Pages\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class FilamentPanel
{
    public function buildPanel(Panel $panel): Panel
    {
        return $panel
            ->colors([
                'primary' => Color::Amber,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->brandLogo(asset('img/logo.png'))
            ->brandLogoHeight('50px')
            ->brandName('IT - Insurance Tech')
            ->favicon(asset('img/logo.png'))
            ->login(Login::class)
            ->profile(EditProfile::class)
            ->maxContentWidth(MaxWidth::Full)
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s');
    }

    public function buildNavigation(NavigationBuilder $builder): NavigationBuilder
    {
        return $builder
            ->groups([
                NavigationGroup::make(__('Panels'))
                    ->collapsed()
                    ->items([
                        NavigationItem::make(__('Admin'))
                            ->url('/admin')
                            ->icon('heroicon-o-document-text')
                            ->isActiveWhen(fn() => false)
                            ->badge(fn() => request()->is('admin*') ? '●' : null),

                        NavigationItem::make(__('Vehicle'))
                            ->url('/vehicle')
                            ->icon('heroicon-o-document-text')
                            ->isActiveWhen(fn() => false)
                            ->badge(fn() => request()->is('vehicle*') ? '●' : null),

                        NavigationItem::make(__('CRM'))
                            ->url('/crm')
                            ->icon('heroicon-o-document-text')
                            ->isActiveWhen(fn() => false)
                            ->badge(fn() => request()->is('crm*') ? '●' : null),
                    ]),

                NavigationGroup::make(__('Quotes'))
                    ->collapsed()
                    ->items([
                        NavigationItem::make(__('Quote'))
                            ->url('/quote')
                            ->icon('heroicon-o-document-text')
                            ->isActiveWhen(fn() => false)
                            ->badge(function () {
                                return (
                                    request()->is('quote') ||
                                    (
                                        request()->is('quote/*') && !request()->is('quote/vehicle-quote*')
                                    )
                                )
                                    ? '●' :
                                    null;
                            }),

                        NavigationItem::make(__('Vehicle quote'))
                            ->url('/quote/vehicle-quote')
                            ->icon('heroicon-o-document-text')
                            ->isActiveWhen(fn() => false)
                            ->badge(fn() => request()->is('quote/vehicle-quote*') ? '●' : null),
                    ]),

            ])
            ->items([
                NavigationItem::make(__('Dashboard'))
                    ->url(Pages\Dashboard::getUrl())
                    ->icon('heroicon-o-home')
                    ->isActiveWhen(fn() => request()->fullUrlIs(Pages\Dashboard::getUrl())),
            ]);
    }
}
