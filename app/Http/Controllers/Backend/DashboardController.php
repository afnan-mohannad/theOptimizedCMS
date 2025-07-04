<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Message;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $total_messages = Message::getCount();
        $total_subscriptions = Subscriber::getCount();
        $total_categories = Category::getCount();
        $total_posts = Post::getCount();
        $subscriptions = Subscriber::getCountries();
        $users_increase = User::getUsersIncreaseOverYear();

        return view('backend.admin.dashboard',[
            'total_messages'=>$total_messages ?? 0,
            'total_subscriptions'=>$total_subscriptions ?? 0,
            'total_categories'=>$total_categories ?? 0, 
            'total_posts'=>$total_posts ?? 0, 
            'subscriptions'=>json_encode($subscriptions),
            'users_increase'=>$users_increase
        ]);
 
    }

    public function clear()
    {
        Cache::flush();
        return back();
    }
}
