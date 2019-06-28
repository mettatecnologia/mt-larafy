<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    use \App\Traits\TAuth;

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
        \Illuminate\Support\Facades\View::composer('*', function($View) {
            //variaveis inseridas em todas as views
            if (\Auth::check()){
                $User = self::user();
                $View->with('User', $User);
            }
        });
        Schema::defaultStringLength(env('DB_MAX_STRING_LENGTH',191));
    }
}
