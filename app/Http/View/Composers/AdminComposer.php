<?php

namespace App\Http\View\Composers;

use Exception;
use Illuminate\View\View;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class AdminComposer extends Controller
{
    public function compose(View $view){
        //header breadcrumb excepts
        $header_excepts = [
            "app.dashboard",
            "app.settings.index",
            "app.settings.appearance.index",
            "app.settings.socialite.index",
            "app.settings.landing.index",
            "app.profile.index",
            "app.menus.index",
            "app.profile.password.change",
        ];
        $view->with([
            'header_excepts'=>$header_excepts
        ]);
    }
}
