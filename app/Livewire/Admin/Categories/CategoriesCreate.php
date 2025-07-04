<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Categories\CategoriesData;

class CategoriesCreate extends Component
{
    use WithFileUploads;

    public $name_en, $name_ar, $description_en, $description_ar, $slug, $picture, $is_active, $type="main", $categories, $parent_id;

    public function mount()
    {
        Gate::authorize('app.categories.create');
        $this->categories = Category::getForSelect();
        $this->is_active = true;
    }

    public function generateSlug(){
        $this->slug = slug($this->name_en);
    }

    public function removePicture()
    {
        $this->picture = null;
    }

    public function rules()
    {
        return [
            'slug' => 'required|string|unique:categories',
            'name_en' => 'required|max:100|min:5',
            'name_ar' => 'required|max:100|min:5',
            'description_en' => 'nullable|string|max:255|min:5',
            'description_ar' => 'nullable|string|max:255|min:5',
            'picture' => 'nullable|image|mimes:png,jpg|max:2024'
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

            $this->validate($this->rules(), [], $this->attributes());

            DB::beginTransaction();
            
            $slug = $this->slug;
            $name_en = $this->name_en;
            $name_ar = $this->name_ar;
            $description_en = $this->description_en;
            $description_ar = $this->description_ar;
            $parent_id = $this->parent_id;
            $is_active = $this->is_active ?? 1;
           
            $category = Category::storeCategory($slug,$name_en,$name_ar,$description_en,$description_ar,$parent_id,$is_active);

            if(isset($this->picture) && $this->picture != null){
                // upload picture
                $imageName = time() . '.' . $this->picture->getClientOriginalExtension();
                $this->picture->storeAs('categories/pictures', $imageName, 'public');
        
                $category->picture = 'categories/pictures/' . $imageName;
                $category->save();
            }
            
            DB::commit();

            $this->reset(['name_en', 'name_ar', 'description_en', 'description_ar', 'slug', 'parent_id', 'picture', 'is_active']);
            // hide modal
            $this->dispatch('createModalToggle');
            // refresh category data component
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
        return view('livewire.admin.categories.categories-create');
    }
}