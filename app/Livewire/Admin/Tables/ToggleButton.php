<?php

namespace App\Livewire\Admin\Tables;

use Livewire\Component;
use App\Livewire\Admin\Tags\TagsData;
use App\Livewire\Admin\Pages\PagesData;
use App\Livewire\Admin\Posts\PostsData;
use App\Livewire\Admin\Users\UsersData;
use Illuminate\Database\Eloquent\Model;
use App\Livewire\Admin\Banners\BannersData;
use App\Livewire\Admin\Messages\MessagesData;
use App\Livewire\Admin\Categories\CategoriesData;
use App\Livewire\Admin\Subscribers\SubscribersData;

class ToggleButton extends Component
{
    public Model $model;
    public string $field;
    public bool $is_active;
 
    public function mount()
    {
        $this->is_active = (bool) $this->model->getAttribute($this->field);
    }
    public function render()
    {
        return view('livewire.admin.tables.toggle-button');
    }
    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
        // refresh team data components
        $this->dispatch('refreshData')->to(BannersData::class);
        $this->dispatch('refreshData')->to(TagsData::class);
        $this->dispatch('refreshData')->to(CategoriesData::class);
        $this->dispatch('refreshData')->to(UsersData::class);
        $this->dispatch('refreshData')->to(PostsData::class);
        $this->dispatch('refreshData')->to(SubscribersData::class);
        $this->dispatch('refreshData')->to(MessagesData::class);
        $this->dispatch('refreshData')->to(PagesData::class);
    }
}
