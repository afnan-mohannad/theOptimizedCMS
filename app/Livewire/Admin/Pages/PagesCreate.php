<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Pages\PagesData;

class PagesCreate extends Component
{
    public $title_en, $title_ar, $slug, $excerpt_en, $excerpt_ar, $body_en, $body_ar, $status, $created_at;

    public function mount()
    {
        Gate::authorize('app.pages.create');
        $this->status = true;
    }

    public function generateSlug(){
        $this->slug = slug($this->title_en);
    }

    public function rules()
    {
        return [
            'slug' => 'required|string|unique:pages',
            'title_en' => 'required|string|max:50|min:5',
            'title_ar' => 'required|string|max:50|min:5',
            'excerpt_en'=> 'nullable|string|max:50000|min:50',
            'excerpt_ar'=> 'nullable|string|max:50000|min:50',
            'body_en' => 'nullable|string',
            'body_ar' => 'nullable|string',
        ];
    }

    public function attributes()
    {
        return [
            'slug' => __('admin.Slug'),
            'title_en' => __('admin.Title').' '.__('admin.(en)'),
            'title_ar' => __('admin.Title').' '.__('admin.(ar)'),
            'excerpt_en'=> __('admin.Excerpt').' '.__('admin.(en)'),
            'excerpt_ar'=> __('admin.Excerpt').' '.__('admin.(en)'),
            'body_en' => __('admin.Body').' '.__('admin.(en)'),
            'body_ar' => __('admin.Body').' '.__('admin.(en)'),
        ];
    }

    public function submit()
    {
        $this->validate($this->rules(), [], $this->attributes());

        try {
       
            DB::beginTransaction();
            
            $slug       = $this->slug;
            $title_en   = $this->title_en;
            $title_ar   = $this->title_ar;
            $excerpt_en = $this->excerpt_en;
            $excerpt_ar = $this->excerpt_ar;
            $body_en    = $this->body_en;
            $body_ar    = $this->body_ar;
            $status     = $this->status;
            $page       = Page::storePage($slug,$title_en,$title_ar,$excerpt_en,$excerpt_ar,$body_en,$body_ar,$status);

            DB::commit();
          
            $this->reset(['title_en', 'title_ar', 'slug', 'excerpt_en', 'excerpt_ar' , 'body_en', 'body_ar', 'status', 'created_at']);
            // refresh pages data component
            $this->dispatch('refreshData')->to(PagesData::class);
            session()->flash('success', __('admin.success_create', ['item'=>$page->title]));
            return redirect()->route('app.pages.index');
        }catch(Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            
            return redirect()->back();
        }
    }
    
    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatch('scrollToError');
        }
        return view('livewire.admin.pages.pages-create');
    }
}
