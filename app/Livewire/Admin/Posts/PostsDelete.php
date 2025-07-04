<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Posts\PostsData;

class PostsDelete extends Component
{
    public $post;

    protected $listeners = ['postDelete'];

    public function mount()
    {
        Gate::authorize('app.posts.destroy');
    }

    public function postDelete($id)
    {
        // fill $project with the eloquent model of the same id
        $this->post = Post::find($id);
        // show delete modal
        $this->dispatch('deleteModalToggle');
    }

    public function submit()
    {
        // delete from storage
        if(isset($this->post->picture) && !empty($this->post->picture))
            unlink('storage/'.$this->post->picture);

        if(isset($this->post->cover_picture) && !empty($this->post->cover_picture))
            unlink('storage/'.$this->post->cover_picture);

        $this->post->delete();
        $this->reset('post');

        // hide modal
        $this->dispatch('deleteModalToggle');
        // refresh projects data component
        $this->dispatch('refreshData')->to(PostsData::class);
        $this->dispatch('successDelete');
    }

    public function render()
    {
        return view('livewire.admin.posts.posts-delete');
    }
}
