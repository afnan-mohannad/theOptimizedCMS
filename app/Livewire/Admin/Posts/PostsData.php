<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class PostsData extends Component
{ 
    use WithPagination;
    
    /* wire models */
    public $search;
    public $is_active;
    public $category_id;
    public $category_slug;
    public $status;
    public $publish_date;
    public $locale;
    public $sortColumn = "id";
    public $sortDirection = "desc";
    public $checkedPost = [];
    public $categories = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh','deleteCheckedPosts'];

    public function mount($category)
    {
        Gate::authorize('app.posts.index');
        $this->categories = Category::getAllForSelect();
        if(isset($category) && $category != null)
            $this->category_slug = $category;
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->checkedPost = [];
        $this->dispatch('resetActions');
    }

    public function updatingIsActive()
    {
        $this->resetPage();
        $this->checkedPost = [];
        $this->dispatch('resetActions');
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
        $this->checkedPost = [];
        $this->dispatch('resetActions');
    }

    public function updatingStatus()
    {
        $this->resetPage();
        $this->checkedPost = [];
        $this->dispatch('resetActions');
    }

    public function updatingPublishDate()
    {
        $this->resetPage();
        $this->checkedPost = [];
        $this->dispatch('resetActions');
    }

    public function updatingLocale()
    {
        $this->resetPage();
        $this->checkedPost = [];
        $this->dispatch('resetActions');
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->resetPage();
        Post::flushCache();
        $this->checkedPost = [];
    }

    public function render()
    {
        $keyword = $this->search;
        $status  = $this->status;
        $is_active = $this->is_active;
        $locale = $this->locale;
        $publish_date = $this->publish_date;
        $category_id = $this->category_id;
        $category_slug = $this->category_slug;
        $sortColumn= $this->sortColumn;
        $sortDirection = $this->sortDirection;
        $posts = Post::getAllPosts($keyword,$status,$is_active,$locale,$publish_date,$category_id,$category_slug,10,$sortColumn,$sortDirection);
    
        return view('livewire.admin.posts.posts-data', ['data'=>$posts]);
    }

    public function deletePosts(){
        $this->dispatch('swal:deletePosts',[
            'title'=>__('admin.Delete'),
            'html'=>__('admin.confirm_delete_text'),
            'yes'=>__('admin.cancel_no'),
            'no'=>__('admin.yes_delete'),
            'checkedIDs'=>$this->checkedPost,
        ]);
    }

    public function deleteCheckedPosts($ids){
        Post::whereKey($ids)->delete();
        $this->checkedPost = [];
        $this->dispatch('resetActions');
        $this->dispatch('successDelete');
    }

    public function isChecked($postId){
        return in_array($postId, $this->checkedPost) ? 'bg-light-info text-dark' : '';
    }
}
