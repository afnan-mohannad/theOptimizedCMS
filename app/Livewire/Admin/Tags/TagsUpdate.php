<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;

class TagsUpdate extends Component
{
    use WithFileUploads;

    public $tag, $slug, $is_active;

    public function mount()
    {
        Gate::authorize('app.tags.edit');
    }

    protected $listeners = ['tagUpdate'];

    public function tagUpdate($id)
    {
        // fill $tag with the eloquent model of the same id
        $this->tag = Tag::find($id);
        $this->slug = $this->tag->slug;
        $this->is_active = $this->tag->is_active ?? true;
        $this->resetValidation();
        // show edit modal
        $this->dispatch('updateModalToggle');
    }

    public function rules()
    {
        return [
            'slug' => 'required|min:3|max:50|unique:tags,slug,'.$this->tag->id,
        ];
    }

    public function attributes()
    {
        return [
           
        ];
    }
    public function submit()
    {
        try {
            $data = $this->validate($this->rules(), [], $this->attributes());

            DB::beginTransaction();
            
            $slug = trim($this->slug);
            $is_active = $this->is_active ?? false;

            // update data
            $tag = Tag::updateTag($this->tag,$slug,$is_active);

            DB::commit();

            // hide modal
            $this->dispatch('updateModalToggle');
            // refresh team data component
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
        return view('livewire.admin.tags.tags-update');
    }
}
