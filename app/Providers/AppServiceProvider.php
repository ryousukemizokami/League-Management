<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \URL::forceScheme('https'); // リンクをHTTPSにする設定に修正
        
        if (request()->is('admin/*')) {
        config(['session.cookie' => config('session.cookie_admin')]);
        }
    }
}
