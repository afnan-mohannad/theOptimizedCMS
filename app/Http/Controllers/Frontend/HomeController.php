<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function landing($locale){
        return view('frontend.index');
    }

    public function changeLanguage($lang){

        $url = Request::create(url()->previous())->path();
        $pos = strpos($url, app()->getLocale());
        $redirect = substr_replace($url,$lang,$pos,2);

        if ($lang == 'en'){
            Cookie::queue(Cookie::make('lang', 'en', 60 * 60 * 24 * 20));
            app()->setLocale($lang);
        }
        else{
            Cookie::queue(Cookie::make('lang', 'ar', 60 * 60 * 24 * 20));
            app()->setLocale($lang);
        }

        // flush the cache for model has cached data related to the language 
        // Model::flushCache();
        
        if(auth()->check()){
            if(auth()->user()->slug != 'user')
                return redirect()->back(); 
            else
                return redirect('/'.$redirect);
        }else{
            return redirect('/'.$redirect);
        }
    }
}
