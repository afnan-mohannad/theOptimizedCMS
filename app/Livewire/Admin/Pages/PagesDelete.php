<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Pages\PagesData;

class PagesDelete extends Component
{
    public $page;

    protected $listeners = ['pageDelete'];

    public function mount()
    {
        Gate::authorize('app.pages.destroy');
    }

    public function pageDelete($id)
    {
        // fill $project with the eloquent model of the same id
        $this->page = Page::find($id);
        // show delete modal
        $this->dispatch('deleteModalToggle');
    }

    public function submit()
    {
        // delete from storage
        if(isset($this->page->picture) && !empty($this->page->picture))
            unlink('storage/'.$this->page->picture);

        if(isset($this->page->cover_picture) && !empty($this->page->cover_picture))
            unlink('storage/'.$this->page->cover_picture);

        $this->page->delete();
        $this->reset('page');

        // hide modal
        $this->dispatch('deleteModalToggle');
        // refresh projects data component
        $this->dispatch('refreshData')->to(PagesData::class);
        $this->dispatch('successDelete');
    }

    public function render()
    {
        return view('livewire.admin.pages.pages-delete');
    }
}
