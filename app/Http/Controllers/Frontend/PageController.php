<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Page::findBySlug($slug);
    }
}
