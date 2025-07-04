<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Tags\TagsData;

class TagsCreate extends Component
{
    use WithFileUploads;

    public $slug, $is_active;

    public function mount()
    {
        Gate::authorize('app.tags.create');
        $this->is_active = true;
    }

    public function rules()
    {
        return [
            'slug' => 'required|min:3|max:50|unique:tags',
        ];
    }

    public function attributes()
    {
        return [
            'slug'=>__('admin.Slug')
        ];
    }

    public function submit()
    {
        try {

            $data = $this->validate($this->rules(), [], $this->attributes());

            DB::beginTransaction();
            
            $slug = trim($this->slug);
            $is_active = $this->is_active ?? false;

            // save data in db
            $tag = Tag::storeTag($slug,$is_active);

            DB::commit();

            $this->reset(['slug', 'is_active']);
            // hide modal
            $this->dispatch('createModalToggle');
            // refresh tag data component
            $this->dispatch('refreshData')->to(TagsData::class);
            
        }catch(QueryException $e){
            DB::rollback();
            Log::error($e->getMessage());
            
        }
    }
    
    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatch('scrollToError');
        }
        return view('livewire.admin.tags.tags-create');
    }
}
