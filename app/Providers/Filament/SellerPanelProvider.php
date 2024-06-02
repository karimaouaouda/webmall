<?php

namespace App\Providers\Filament;

use App\Filament\Seller\Auth\Register;
use App\Filament\Seller\Dynamic\Pages\Settings;
use App\Filament\Seller\Dynamic\Pages\ShopSettings;
use App\Filament\Seller\Resources\ShopResource\Pages\Opinions;
use App\Filament\Seller\Widgets;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\Panel\Concerns\HasAuth;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SellerPanelProvider extends PanelProvider
{
    use HasAuth;

    public function panel(Panel $panel): Panel
    {

        return $panel
            ->id('seller')
            ->path('/dashboard')
            ->authGuard("seller")
            ->colors([
                'primary' => Color::Blue,
                'secondary' => Color::Green
            ])
            ->domain('seller.webmall.test')
            ->viteTheme('resources/css/app.css', 'build')
            ->discoverResources(in: app_path('Filament/Seller/Resources'), for: 'App\\Filament\\Seller\\Resources')
            ->discoverPages(in: app_path('Filament/Seller/Pages'), for: 'App\\Filament\\Seller\\Pages')
            //->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
                Settings::class,
                Opinions::class,
            ])
            ->profile(isSimple: false)
            ->passwordReset()
            ->login()
            ->databaseNotifications()
            ->databaseNotificationsPolling('10s')
            ->emailVerification()
            ->registration(Register::class)
            ->discoverWidgets(in: app_path('Filament/Seller/Widgets'), for: 'App\\Filament\\Seller\\Widgets')
            ->widgets([
                AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
                //\App\Filament\Seller\Widgets\ProfileAnalysis::class,
                Widgets\StatsOverview::class
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
                //AssertHavingShop::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
