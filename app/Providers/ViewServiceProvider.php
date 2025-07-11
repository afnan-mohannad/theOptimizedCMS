<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*','App\Http\View\Composers\MainComposer');
        View::composer(['components.backend-side-menu', 'backend.admin.dashboard', 'backend.layouts.partials.header'],'App\Http\View\Composers\AdminComposer');
    }
}
