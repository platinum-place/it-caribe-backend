<?php

namespace Modules\Common\Presentation\Filament;

use App\Filament\Pages\EditProfile;
use App\Filament\Pages\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class FilamentPanelBuilder
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
// ->maxContentWidth(MaxWidth::Full)
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->userMenuItems([
                MenuItem::make()
                    ->label(__('Home'))
                    ->url(fn (): string => '/')
                    ->icon('heroicon-o-home'),

                MenuItem::make()
                    ->label(__('Admin'))
                    ->url('/admin')
                    ->icon('heroicon-o-document-text')
                    ->visible(fn () => auth()->user()->isAdmin()),

                MenuItem::make()
                    ->label(__('Quote'))
                    ->url('/quote')
                    ->icon('heroicon-o-document-text'),

                MenuItem::make()
                    ->label(__('Quote vehicle'))
                    ->url('/quote/vehicle-quote')
                    ->icon('heroicon-o-document-text'),

                MenuItem::make()
                    ->label(__('Vehicle'))
                    ->url('/vehicle')
                    ->icon('heroicon-o-document-text')
                    ->visible(fn () => auth()->user()->isAdmin()),

                MenuItem::make()
                    ->label(__('CRM'))
                    ->url('/crm')
                    ->icon('heroicon-o-document-text')
                    ->visible(fn () => auth()->user()->isAdmin()),
            ]);
    }
}
