<?php

namespace App\Livewire\Admin\Posts;

use Exception;
use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Posts\PostsData;

class PostsCreate extends Component
{
    use WithFileUploads;

    public $categories = [];
    public $tags = [];
    public array $tag_ids = [];
    public $category_id,$category_slug,$locale, $title, $excerpt, $body, $picture, $cover_picture, $status, $is_active, $featured, $created_at;

    public function mount($category)
    {
        Gate::authorize('app.posts.create');
        $this->categories = Category::getAllForSelect();
        $this->tags = Tag::getForSelect();
        $this->created_at = now()->format('d-m-Y H:m:i');
        $this->status = "PUBLISHED";
        $this->is_active = true;
        if(isset($category) && $category != null)
            $this->category_slug = $category;
    }

    public function rules()
    {
        return [
            'locale' => 'required',
            'title' => 'required|string|min:5|max:255',
            'excerpt'=> 'required|string|min:120|max:320',
            'category_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'locale' =>__('admin.Language'),
            'title' =>__('admin.Title'),
            'excerpt' => __('admin.Excerpt'),
            'category_id' =>__('admin.Category')
        ];
    }

    public function submit()
    {
        $this->validate($this->rules(), [], $this->attributes());

        try {
       
            DB::beginTransaction();

            $title = $this->title;
            $excerpt =$this->excerpt;
            $created_at = $this->created_at ?? now()->format('d-m-Y');
            $body = $this->body;
            $status = $this->status ?? 'PUBLISHED';
            $featured = $this->featured ?? false;
            $is_active = $this->is_active ?? false;
            $author_id = auth()->user()->id ?? null;
            $locale = $this->locale;
            $category_id = $this->category_id;
            $tag_ids = $this->tag_ids;
           
            $post = Post::storePost($locale,$title,$excerpt,$body,$category_id,$author_id,$status,$featured,$is_active,$created_at);

            if($this->tag_ids){
                $post->tags()->attach($this->tag_ids);
            }

            //upload picture
            if ($this->picture) {
                $main_picture = time() . '.' . $this->picture->getClientOriginalExtension();
                $this->picture->storeAs('posts/pictures', $main_picture, 'public');
                $post->picture = 'posts/pictures/' . $main_picture;
                $post->save();
            }

            // upload cover
            if ($this->cover_picture) {
                $cover_picture = time() . '.' . $this->cover_picture->getClientOriginalExtension();
                $this->cover_picture->storeAs('posts/cover_pictures', $cover_picture, 'public');
                $post->cover_picture = 'posts/cover_pictures/' . $cover_picture;
                $post->save();
            }

            DB::commit();
          
            $this->reset(['category_id', 'locale', 'title', 'excerpt', 'body', 'picture', 'cover_picture', 'status', 'is_active', 'featured', 'created_at']);
            // refresh posts data component
            $this->dispatch('refreshData')->to(PostsData::class);
            session()->flash('success', __('admin.success_create', ['item'=>$post->title]));
            return redirect()->route('app.posts.index');
        }catch(Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            
            return redirect()->back();
        }
    }
    
    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatch('scrollToError');
        }
        return view('livewire.admin.posts.posts-create');
    }
}
