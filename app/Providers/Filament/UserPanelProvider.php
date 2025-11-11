<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Support\Enums\MaxWidth;
use App\Filament\Widgets\SatuanWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\FontProviders\LocalFontProvider;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\RedirectToProperPanelMiddleware;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('user')
            ->login()
            // ->topNavigation()
            ->colors([
                'primary' => Color::Blue, //Orange, Indigo, //Blue,   //Gray,   //Rose,   //Amber,  // Emerald,
            ])->navigationGroups([
                'HUMAN RESOURCES',
                'PETA',
            ])
            // ->breadcrumbs(false)
            ->font(
                'Inter',
                provider: LocalFontProvider::class,
            )
            ->spa()
            ->brandLogo(asset('images/Logo_Kraton_Yogyakarta.png'))
            ->brandLogoHeight('3.5rem')
            ->favicon(asset('images/Icon_Kraton_Yogyakarta.ico'))
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->maxContentWidth(MaxWidth::Full)
            ->sidebarFullyCollapsibleOnDesktop()
            // ->sidebarWidth('13rem')
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                SatuanWidget::class,
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
                RedirectToProperPanelMiddleware::class,
                Authenticate::class,
            ])
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->setIcon('heroicon-o-user')
                    ->slug('my-profile')
                    ->setTitle('My Profile')
                    ->setNavigationLabel('My Profile')
                    ->shouldShowAvatarForm(),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('My Profile')
                    ->url(fn(): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle')
            ])
            ->renderHook(
                // PanelsRenderHook::BODY_END,
                PanelsRenderHook::FOOTER,
                fn() => view('footer')
            )
            ->databaseTransactions();
    }
}
