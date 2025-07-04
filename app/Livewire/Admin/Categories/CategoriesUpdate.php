<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;

class CategoriesUpdate extends Component
{
    use WithFileUploads;

    public $category, $name_en, $name_ar, $description_en, $description_ar, $slug, $picture, $is_active, $type="main", $categories, $parent_id;

    public function mount()
    {
        Gate::authorize('app.categories.edit');
        $this->categories = Category::getForSelect();
    }

    protected $listeners = ['categoryUpdate'];

    public function categoryUpdate($id)
    {
        // fill $category with the eloquent model of the same id
        $this->category = Category::find($id);
        $translations_array = $this->category->getTranslationsArray();
        $this->name_en = $translations_array['en']['name'];
        $this->name_ar = $translations_array['ar']['name'];
        $this->description_en = $translations_array['en']['description'];
        $this->description_ar = $translations_array['ar']['description'];
        $this->slug = $this->category->slug;
        $this->parent_id = $this->category->parent_id;
        $this->is_active = $this->category->is_active ?? true;
        $this->picture = $this->category->picture;
        $this->resetValidation();
        // show edit modal
        $this->dispatch('updateModalToggle');
    }

    public function removePicture()
    {
        $this->picture = null;
        if(!empty($this->category->picture))
            unlink('storage/'.$this->category->picture);
        $this->category->picture = '';
        $this->category->save();
    }

    public function rules()
    {
        return [
            'slug' => 'required|string|unique:categories,slug,'.$this->category->id,
            'name_en' => 'required|max:100|min:5',
            'name_ar' => 'required|max:100|min:5',
            'description_en' => 'nullable|string|max:255|min:5',
            'description_ar' => 'nullable|string|max:255|min:5',
            'picture' => 'nullable'
        ];
    }

    public function attributes()
    {
        return [
            'slug' => __('admin.Slug'),
            'name_en' => __('admin.Name').' '.__('admin.(en)'),
            'name_ar' => __('admin.Name').' '.__('admin.(ar)'),
            'description_en' => __('admin.Description').' '.__('admin.(en)'),
            'description_ar' => __('admin.Description').' '.__('admin.(ar)'),
            'picture' => __('admin.banners.Picture')
        ];
    }

    public function submit()
    {
        try {
            $data = $this->validate($this->rules(), [], $this->attributes());

            DB::beginTransaction();
            
            $slug = $this->slug;
            $name_en = $this->name_en;
            $name_ar = $this->name_ar;
            $description_en = $this->description_en;
            $description_ar = $this->description_ar;
            $parent_id = $this->parent_id;
            $is_active = $this->is_active;
            Category::updateCategory($this->category,$slug,$name_en,$name_ar,$description_en,$description_ar,$parent_id,$is_active);

            // save image on my project
            if ($this->picture != $this->category->picture && !empty($this->picture)) {
                if(!empty($this->category->picture))
                    unlink('storage/'.$this->category->picture);
                $imageName = time() . '.' . $this->picture->getClientOriginalExtension();
                $this->picture->storeAs('categories/pictures', $imageName, 'public');
                $this->category->picture = 'categories/pictures/' . $imageName;
                $this->category->save();
            } 

            DB::commit();

            // hide modal
            $this->dispatch('updateModalToggle');
            // refresh team data component
            $this->dispatch('refreshData')->to(CategoriesData::class);
            
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
        return view('livewire.admin.categories.categories-update');
    }
}