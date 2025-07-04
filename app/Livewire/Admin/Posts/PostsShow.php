<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Component;

class PostsShow extends Component
{
    public $tag_ids = [];
    public $post, $category_id, $locale, $title, $excerpt, $body, $picture, $cover_picture, $status, $is_active, $featured, $created_at, $file;

    public function mount($id)
    {
        $this->post = Post::getPostById($id);
        $this->locale = $this->post->locale;
        $this->title = $this->post->title;
        $this->excerpt = $this->post->excerpt;
        $this->body = $this->post->body;
        $this->created_at = $this->post->created_at->format('d-m-Y H:m:i');
        $this->category_id = $this->post->category_id;
        $this->file = $this->post->file;
        $this->status = $this->post->status;
        $this->is_active = $this->post->is_active;
        $this->featured = $this->post->featured;
        $this->picture = $this->post->picture;
        $this->cover_picture = $this->post->cover_picture;
        $this->tag_ids = $this->post->pluck('id')->toArray();
    }
    
    public function render()
    {
        return view('livewire.admin.posts.posts-show');
    }
}
