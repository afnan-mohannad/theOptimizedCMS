<?php

namespace App\Livewire\Admin\Banners;

use App\Models\Banner;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Banners\BannersData;

class BannersDelete extends Component
{
    public $banner;

    protected $listeners = ['bannerDelete'];

    public function mount()
    {
        Gate::authorize('app.banners.destroy');
    }

    public function bannerDelete($id)
    {
        // fill $project with the eloquent model of the same id
        $this->banner = Banner::find($id);
        // show delete modal
        $this->dispatch('deleteModalToggle');
    }

    public function submit()
    {
        // delete record
        unlink('storage/'.$this->banner->picture);
        $this->banner->delete();
        $this->reset('banner');
        // hide modal
        $this->dispatch('deleteModalToggle');
        // refresh projects data component
        $this->dispatch('refreshData')->to(BannersData::class);
        $this->dispatch('successDelete');
    }

    public function render()
    {
        return view('livewire.admin.banners.banners-delete');
    }
}
