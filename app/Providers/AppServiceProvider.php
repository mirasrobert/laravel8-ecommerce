<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Carbon\Carbon;


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
            // View Composer lets you render the variable in all of the VIEWS using * as ALL
            // OR PASS the variable in all of the views
            // View::composer('layouts.navigation', function ($view) {
            //     $user = User::findOrFail(Auth::id());
            //     $view->with('user', $user);
            // });
    }
}
