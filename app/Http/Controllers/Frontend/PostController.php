<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function details(Request $request,$locale,$category,$slug){
        $category = trim($category);
        $slug     = trim($slug);
        $check_category = Category::checkCategoryBySlug($category);

        if($check_category)
        {
            $id = explode("-", $slug)[0];

            $post = Post::getPublishedPostById($id);
            
            if(isset($post) && !empty($post))
            {
                //increase post views 
                $post->incrementReadCount();
              
                if($slug == $id)
                    return Redirect::to('/'.lang().'/'.$category.'/'.$id.'-'.slug($post->title), 301);
                
                $compact = [
                    'post' => $post,
                ];
                
                switch ($category) {
                    case '':
                        return view('')->with($compact);
                        break;
                    
                    default:
                        return view('')->with($compact);
                        break;
                }
               
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }
}
