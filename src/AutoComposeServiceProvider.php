<?php

namespace Hotash\AutoCompose;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AutoComposeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with(Route::current()->parameters());
        });
    }
}
