<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /*
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /*
     * Register the application services.
     */
    public function register()
    {
        foreach (glob(app_path().'/Helpers/*.php') as $fileHelper){
            require_once($fileHelper);
        }
    }
}