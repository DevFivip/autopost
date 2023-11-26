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
                ->label('Assingar Subreddits')
                ->route('admin.customer-subreddits.index')
                ->icon('bx bx-user')
        ]);
    }
}
