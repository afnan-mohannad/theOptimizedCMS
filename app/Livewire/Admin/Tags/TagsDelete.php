<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Tags\TagsData;

class TagsDelete extends Component
{
    public $tag;

    protected $listeners = ['tagDelete'];

    public function mount()
    {
        Gate::authorize('app.tags.destroy');
    }

    public function tagDelete($id)
    {
        // fill $project with the eloquent model of the same id
        $this->tag = Tag::find($id);
        // show delete modal
        $this->dispatch('deleteModalToggle');
    }

    public function submit()
    {
        // delete record
        $this->tag->delete();
        $this->reset('tag');
        // hide modal
        $this->dispatch('deleteModalToggle');
        // refresh projects data component
        $this->dispatch('refreshData')->to(TagsData::class);
        $this->dispatch('successDelete');
    }


    public function render()
    {
        return view('livewire.admin.tags.tags-delete');
    }
}
