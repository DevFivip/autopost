<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        TomatoMenu::groups([
            __('ALC') => true,
            __('Settings') => false,
            __('Resources') => true,
        ]);

        // $user = auth()->user();
        // dd($user);
        TomatoMenu::register([
            Menu::make()
                ->group('Resources')
                ->label('Customers')
                ->route('admin.customers.index')
                ->icon('bx bx-user'),
            Menu::make()
                ->group('Resources')
                ->label('Subreddits')
                ->route('admin.subreddits.index')
                ->icon('bx bx-user'),
            Menu::make()
                ->group('Resources')
                ->label('Assign Subreddits to Customers')
                ->route('admin.customer-subreddits.index')
                ->icon('bx bx-user'),
            Menu::make()
                ->group('Resources')
                ->label('Upcoming Posts')
                ->route('admin.events.index')
                ->icon('bx bx-calendar'),
            Menu::make()
                ->group('Resources')
                ->label('Content Library')
                ->route('admin.images.index')
                ->icon('bx bx-images'),
            Menu::make()
                ->group('Resources')
                ->label('Telegram Channels')
                ->route('admin.telegram-channels.index')
                ->icon('bx bx-telegram'),
        ]);
    }
}
