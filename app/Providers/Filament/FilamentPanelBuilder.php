<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Pages\Auth\Login;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\Support\Colors\Color;
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
            ->databaseTransactions()
            ->brandLogo(asset('img/logo.png'))
            ->brandLogoHeight('50px')
            ->brandName('IT - Insurance Tech')
            ->favicon(asset('img/logo.png'))
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->login(Login::class)
            ->profile(EditProfile::class)
            ->userMenuItems([
                Action::make('home')
                    ->translateLabel()
                    ->url(fn (): string => '/')
                    ->icon('heroicon-o-home'),

                Action::make('admin')
                    ->translateLabel()
                    ->url('/admin')
                    ->icon('heroicon-o-document-text')
                    ->visible(fn () => auth()->user()->isAdmin()),

                Action::make('quote')
                    ->translateLabel()
                    ->url('/quote')
                    ->icon('heroicon-o-document-text'),

                Action::make('quote_vehicle')
                    ->translateLabel()
                    ->url('/quote-vehicle')
                    ->icon('heroicon-o-document-text'),

                Action::make('vehicle')
                    ->translateLabel()
                    ->url('/vehicle')
                    ->icon('heroicon-o-document-text')
                    ->visible(fn () => auth()->user()->isAdmin()),

                Action::make('crm')
                    ->label(__('CRM'))
                    ->url('/crm')
                    ->icon('heroicon-o-document-text')
                    ->visible(fn () => auth()->user()->isAdmin()),
            ]);
    }
}
