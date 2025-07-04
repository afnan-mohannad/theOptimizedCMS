<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Categories\CategoriesData;

class CategoriesDelete extends Component
{
    public $category;

    protected $listeners = ['categoryDelete'];

    public function mount()
    {
        Gate::authorize('app.categories.destroy');
    }

    public function categoryDelete($id)
    {
        // fill $project with the eloquent model of the same id
        $this->category = Category::find($id);
        // show delete modal
        $this->dispatch('deleteModalToggle');
    }

    public function submit()
    {
        if(isset($this->category->picture) && !empty($this->category->picture))
            unlink('storage/'.$this->category->picture);
        // delete record
        $this->category->delete();
        $this->reset('category');
        // hide modal
        $this->dispatch('deleteModalToggle');
        // refresh projects data component
        $this->dispatch('refreshData')->to(CategoriesData::class);
        $this->dispatch('successDelete');
    }

    public function render()
    {
        return view('livewire.admin.categories.categories-delete');
    }
}
