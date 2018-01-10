<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('user_command', function($attribute, $value, $parameters, $validator) {
            return (bool)preg_match("#^\/(?:\w|_|-)+$#", $value); /* /command */
        });

        Validator::extend('sys_command', function($attribute, $value, $parameters, $validator) {
            return (bool)preg_match("#^\\$(?:\w|_|-)+$#", $value); /* $command */
        });
    }

    public function register()
    {
        //
    }
}
