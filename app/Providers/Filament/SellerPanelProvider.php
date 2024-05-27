<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\Panel\Concerns\HasAuth;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Seller\Pages\Settings;
use App\Filament\Seller\Widgets;
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
                'primary' => Color::Amber,
            ])
            ->domain('seller.webmall.test')
            ->discoverResources(in: app_path('Filament/Seller/Resources'), for: 'App\\Filament\\Seller\\Resources')
            ->discoverPages(in: app_path('Filament/Seller/Pages'), for: 'App\\Filament\\Seller\\Pages')
            //->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
                Settings::class
            ])
            ->profile(isSimple: false)
            ->passwordReset()
            ->login()
            ->registration()
            ->discoverWidgets(in: app_path('Filament/Seller/Widgets'), for: 'App\\Filament\\Seller\\Widgets')
            ->widgets([
                //Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
                //\App\Filament\Seller\Widgets\ProfileAnalysis::class,
                Widgets\CreateShop::class
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
