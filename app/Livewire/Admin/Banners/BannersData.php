<?php

namespace App\Livewire\Admin\Banners;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class BannersData extends Component
{
    use WithPagination;

    /* wire models */
    public $search;
    public $is_active;
    public $sortColumn = "id";
    public $sortDirection = "desc";
    public $checkedBanner = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh','deleteCheckedBanners'];

    public function mount()
    {
        Gate::authorize('app.banners.index');
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->checkedBanner = [];
        $this->dispatch('resetActions');
    }

    public function updatingIsActive()
    {
        $this->resetPage();
        $this->checkedBanner = [];
        $this->dispatch('resetActions');
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->resetPage();
        Banner::flushCache();
        $this->checkedBanner = [];
    }

    public function render()
    {
        $keyword   = $this->search;
        $is_active = $this->is_active;
        $sortColumn= $this->sortColumn;
        $sortDirection = $this->sortDirection;
        $banners = Banner::getAllBanners($keyword,$is_active,$sortColumn,$sortDirection,10);
        return view('livewire.admin.banners.banners-data', ['data' => $banners]);
    }

    public function deleteBanners(){
        $this->dispatch('swal:deleteBanners',[
            'title'=>__('admin.Delete'),
            'html'=>__('admin.confirm_delete_text'),
            'yes'=>__('admin.cancel_no'),
            'no'=>__('admin.yes_delete'),
            'checkedIDs'=>$this->checkedBanner,
        ]);
    }

    public function deleteCheckedBanners($ids){
        Banner::whereKey($ids)->delete();
        $this->checkedBanner = [];
        $this->dispatch('resetActions');
        $this->dispatch('successDelete');
    }

    public function isChecked($bannerId){
        return in_array($bannerId, $this->checkedBanner) ? 'bg-light-info text-dark' : '';
    }
   
}
