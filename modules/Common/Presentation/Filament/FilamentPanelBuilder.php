<?php

namespace Modules\Common\Presentation\Filament;

use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Common\Presentation\Filament\Pages\Auth\EditProfile;
use Modules\Common\Presentation\Filament\Pages\Auth\Login;

class FilamentPanelBuilder
{
    public function buildPanel(Panel $panel): Panel
    {
        return $panel
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->spa()
            ->databaseTransactions()
            ->brandLogo(asset('img/logo.png'))
            ->brandLogoHeight('50px')
            ->brandName('IT - Insurance Tech')
            ->favicon(asset('img/logo.png'))
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->login(Login::class)
//            ->registration()
//            ->passwordReset()
//            ->emailVerification()
//            ->emailChangeVerification()
            ->profile(EditProfile::class)
//            ->maxContentWidth(Width::Full)
//            ->simplePageMaxContentWidth(Width::Small)
//            ->subNavigationPosition(SubNavigationPosition::End)
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
                    ->url('/quote/vehicle-quote')
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
