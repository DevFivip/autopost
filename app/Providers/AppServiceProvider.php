<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191); 
        //
        TomatoMenu::groups([
            __('App') => true,
            __('Subreddits and Channels') => true,
            __('ALC') => true,
            __('Settings') => false,
        ]);

        // $user = auth()->user();
        // dd($user);
        TomatoMenu::register([
            Menu::make()
                ->group('App')
                ->label('Posts')
                ->route('admin.posts.index')
                ->icon('bx bx-timer'),
            Menu::make()
                ->group('App')
                ->label('Customers')
                ->route('admin.customers.index')
                ->icon('bx bx-user'),
            Menu::make()
                ->group('App')
                ->label('Upcoming Posts')
                ->route('admin.events.index')
                ->icon('bx bx-calendar'),
            Menu::make()
                ->group('App')
                ->label('Content Library')
                ->route('admin.images.index')
                ->icon('bx bx-photo-album '),
            Menu::make()
                ->group('Subreddits and Channels')
                ->label('Telegram Channels')
                ->route('admin.telegram-channels.index')
                ->icon('bx bxl-telegram'),
            Menu::make()
                ->group('Subreddits and Channels')
                ->label('Subreddits')
                ->route('admin.subreddits.index')
                ->icon('bx bxl-reddit'),
            Menu::make()
                ->group('Subreddits and Channels')
                ->label('Assign Subreddits to Customers')
                ->route('admin.customer-subreddits.index')
                ->icon('bx bxl-reddit'),

        ]);
    }
}
