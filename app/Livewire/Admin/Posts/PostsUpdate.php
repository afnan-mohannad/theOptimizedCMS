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

class PostsUpdate extends Component
{
    use WithFileUploads;

    public $categories = [];
    public $tags = [];
    public $tag_ids = [];
    public $post, $category_id, $locale, $title, $excerpt, $body, $picture, $cover_picture, $status, $is_active, $featured, $created_at;

    public function mount($id)
    {
        Gate::authorize('app.posts.edit');

        $this->categories = Category::getAllForSelect();
        $this->tags = Tag::getForSelect();
        $this->post = Post::getPostById($id);
        $this->locale = $this->post->locale;
        $this->title = $this->post->title;
        $this->excerpt = $this->post->excerpt;
        $this->body = $this->post->body;
        $this->created_at = $this->post->created_at->format('d-m-Y');
        $this->category_id = $this->post->category_id;
        $this->status = $this->post->status;
        $this->is_active = $this->post->is_active;
        $this->featured = $this->post->featured;
        $this->picture = $this->post->picture;
        $this->cover_picture = $this->post->cover_picture;
        $this->tag_ids = $this->post->tags->pluck('id')->toArray();
    }

    public function removePicture()
    {
        $this->picture = null;
        if(!empty($this->post->picture))
            unlink('storage/'.$this->post->picture);
        $this->post->picture = '';
        $this->post->save();
    }

    public function removeCoverPicture()
    {
        $this->cover_picture = null;
        if(!empty($this->post->cover_picture))
            unlink('storage/'.$this->post->cover_picture);
        $this->post->cover_picture = '';
        $this->post->save();
        
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
            $created_at = $this->created_at;
            $body = $this->body;
            $status = $this->status ?? 'PUBLISHED';
            $featured = $this->featured ?? false;
            $is_active = $this->is_active ?? false;
            $author_id = auth()->user()->id ?? null;
            $locale = $this->locale;
            $category_id = $this->category_id;
            $tag_ids = $this->tag_ids;
           
            Post::updatePost($this->post,$locale,$title,$excerpt,$body,$category_id,$author_id,$status,$featured,$is_active,$created_at);

            if($this->tag_ids){
                $this->post->tags()->sync($tag_ids);
            }

            //upload picture
            if ($this->picture != $this->post->picture && !empty($this->picture)) {
                if(!empty($this->post->picture))
                    unlink('storage/'.$this->post->picture);
                $main_picture = time() . '.' . $this->picture->getClientOriginalExtension();
                $this->picture->storeAs('posts/pictures', $main_picture, 'public');
                $this->post->picture = 'posts/pictures/' . $main_picture;
                $this->post->save();
            }

            // upload cover
            if ($this->cover_picture != $this->post->cover_picture && !empty($this->cover_picture)) {
                if(!empty($this->post->cover_picture))
                    unlink('storage/'.$this->post->cover_picture);
                $cover_picture = time() . '.' . $this->cover_picture->getClientOriginalExtension();
                $this->cover_picture->storeAs('posts/cover_pictures', $cover_picture, 'public');
                $this->post->cover_picture = 'posts/cover_pictures/' . $cover_picture;
                $this->post->save();
            }
            

            DB::commit();
            Post::flushCache();
          
            $this->reset(['category_id', 'locale', 'title', 'excerpt', 'body', 'picture', 'cover_picture', 'status', 'is_active', 'featured', 'created_at']);
            // refresh posts data component
            $this->dispatch('refreshData')->to(PostsData::class);
            session()->flash('success', __('admin.success_create', ['item'=>$this->post->title]));
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
        return view('livewire.admin.posts.posts-update');
    }
}
