<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cookie;
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
        $this->app->singleton('locale-for-client', function(){
            $seg = request()->segment(1);
            if(in_array($seg, config('customConfig.locales'), true))
            {
                // if the current url already contains a locale return it
                return $seg;
            }
            if(!empty(request()->cookie('lang')))
            {
                // if the user's 'locale' cookie is set we want to use it
                $locale = request()->cookie('lang');
            }else{
                // most browsers now will send the user's preferred language with the request
                // so we just read it
                $locale = request()->server('HTTP_ACCEPT_LANGUAGE');
                $locale = substr($locale, 0, 2);
                //$locale = config('customConfig.fallback_locale');
            }
            if(in_array($locale, config('customConfig.locales'), true))
            {
                return $locale;
            }
            // if the cookie or the browser's locale is invalid or unknown we fallback
            return config('customConfig.fallback_locale');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $this->Language();

        // Custom blade directive for role check
        Blade::if('role', function ($role) {
            return Auth::user()->role->slug == $role;
        });
    }

    protected function Language()
    {
        if (Cookie::has('lang')) {
            $lang = Cookie::get('lang');

            if ($lang == 'en'){
                App::setlocale('en');
                Cookie::queue(Cookie::make('lang', 'en', 60 * 60 * 24 * 20));
            }
            else{
                App::setlocale('ar');
                Cookie::queue(Cookie::make('lang', 'ar', 60 * 60 * 24 * 20));
            }
        } else{
            App::setlocale('en');
            Cookie::queue(Cookie::make('lang', 'en', 60 * 60 * 24 * 20));
        }
    }
}
