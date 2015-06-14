<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('pins.show', function($view){
            if(Auth::check()){
                $favorites = DB::table('favorites')->whereUserId(Auth::id())->lists('pin_id');
                $view->with('favorites', $favorites);
            }
        });
    }
}
