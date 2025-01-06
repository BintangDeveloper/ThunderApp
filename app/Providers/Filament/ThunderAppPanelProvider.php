<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ThunderAppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('ThunderApp')
            ->path('/')
            ->login()
            ->colors([
                /*'primary' => [
                    50 => '255, 228, 230', // Soft pale red
                    100 => '254, 205, 209', // Pale red
                    200 => '252, 165, 178', // Light blood red
                    300 => '249, 113, 126', // Brightened blood red
                    400 => '244, 63, 94',   // Vibrant neon red
                    500 => '225, 29, 72',   // Classic blood red
                    600 => '190, 18, 60',   // Dark neon red
                    700 => '159, 14, 50',   // Deep blood red
                    800 => '120, 11, 38',   // Blackened red
                    900 => '89, 8, 28',     // Almost black-red
                    950 => '53, 5, 16',     // Pure dark red
                ],*/
                'primary' => [
                    50 => '255, 0, 0', // Soft pale red
                    100 => '254, 0, 0', // Pale red
                    200 => '252, 0, 0', // Light blood red
                    300 => '249, 0, 0', // Brightened blood red
                    400 => '244, 0, 0', // Vibrant neon red
                    500 => '225, 0, 0', // Classic blood red
                    600 => '190, 0, 0', // Dark neon red
                    700 => '159, 0, 0', // Deep blood red
                    800 => '120, 0, 0', // Blackened red
                    900 => '89, 0, 0', // Almost black-red
                    950 => '53, 0, 0', // Pure dark red
                ],
                'gray' => [
                    50 => '250, 250, 250',
                    100 => '245, 245, 245',
                    200 => '229, 229, 229',
                    300 => '204, 204, 204',
                    400 => '163, 163, 163',
                    500 => '115, 115, 115',
                    600 => '82, 82, 82',
                    700 => '64, 64, 64',
                    800 => '38, 38, 38',
                    900 => '23, 23, 23',
                    950 => '12, 12, 12',
                ]
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ->spa()
            ->unsavedChangesAlerts()
            ->passwordReset();
    }
    
}
