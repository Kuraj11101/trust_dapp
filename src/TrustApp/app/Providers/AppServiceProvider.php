<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;
//use Illuminate\Database\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        //get app path
        $this->app->bind('path.public', function() {
            return base_path().'/public';
        });

        // App::before(function($request)
        // {
        //     if( (Request::header('x-forwarded-proto') <> 'https') && !App::environment('local',  'staging')) {
        //         return Redirect::secure(Request::getRequestUri());
        //     }
        // });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Builder::defaultStringLength(191);

        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

    }
}
