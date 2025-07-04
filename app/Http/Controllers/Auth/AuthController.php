<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function logout(){
        Cache::tags('permissions')->flush();
        if(Auth::user()->role->slug == "user"){
            Auth::logout();
            return redirect('/');

        }
        else{
            Auth::logout();
            return redirect('/admin/login');
        }
    }
}
