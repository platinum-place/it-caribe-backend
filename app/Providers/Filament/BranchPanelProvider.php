<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Pages\Auth\Login;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Root\Location\Infrastructure\Persistence\Models\Branch;

class BranchPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('branch')
            ->path('branch')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Branch/Resources'), for: 'App\Filament\Branch\Resources')
            ->discoverPages(in: app_path('Filament/Branch/Pages'), for: 'App\Filament\Branch\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Branch/Widgets'), for: 'App\Filament\Branch\Widgets')
            ->widgets([
                AccountWidget::class,
                // FilamentInfoWidget::class,
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
            ->default()
            ->login(Login::class)
            ->profile(EditProfile::class, isSimple: false)
            ->brandLogo(asset('img/logo.png'))
            ->brandLogoHeight('50px')
            ->brandName('IT - Insurance Tech')
            ->favicon(asset('img/logo.png'))
            ->databaseTransactions()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->tenant(Branch::class)
            ->userMenuItems([
                Action::make('admin')
                    ->url(fn (): string => '/admin')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->visible(fn (): bool => auth()->user()->isAdmin()),
            ]);
    }
}
