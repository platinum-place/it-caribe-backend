<?php

namespace Modules\Infrastructure\Quotations\Products\Vehicle\Providers;

use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Pages\Auth\Login;
use App\Http\Middleware\EnsureAdmin;
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

class FilamentServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('quotations-products-vehicle')
            ->path('quotations/products/vehicle')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: base_path('modules/Presentation/Quotations/Products/Vehicle/Filament/Resources'), for: 'Modules\Presentation\Quotations\Products\Vehicle\Filament\Resources')
            ->discoverPages(in: base_path('modules/Presentation/Quotations/Products/Vehicle/Pages'), for: 'Modules\Presentation\Quotations\Products\Vehicle\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('modules/Presentation/Quotations/Products/Vehicle/Widgets'), for: 'Modules\Presentation\Quotations\Products\Vehicle\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                //                FilamentInfoWidget::class,
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
            ]);
    }
}
