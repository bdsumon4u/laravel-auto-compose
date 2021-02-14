<?php

namespace Hotash\AutoCompose;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AutoComposeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function (View $view) {
            $parameters = optional(Route::current())->parameters();
            $view->with(array_merge($view->getData(), $parameters ?? []));
        });
    }
}
