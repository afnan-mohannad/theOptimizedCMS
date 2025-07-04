<?php

namespace App\Http\View\Composers;

use Exception;
use App\Models\Message;
use Illuminate\View\View;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class MainComposer extends Controller
{
    public function compose(View $view){

        if (Cookie::get('lang') !== null){
            $lang = Cookie::get('lang');
        }else{
            $lang = 'en';
        }

        $view->with([
            'lang'=> $lang
        ]);
    }
}
