<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

class PagesUpdate extends Component
{
    public $page, $title_en, $title_ar, $slug, $excerpt_en, $excerpt_ar, $body_en, $body_ar, $status, $created_at;

    public function mount($id)
    {
        Gate::authorize('app.pages.edit');

        $this->page = Page::find($id);
        $translations_array = $this->page->getTranslationsArray();
        $this->slug = $this->page->slug;
        $this->title_en  = $translations_array['en']['title'];
        $this->title_ar   = $translations_array['ar']['title'];
        $this->excerpt_en = $translations_array['en']['excerpt'];
        $this->excerpt_ar = $translations_array['ar']['excerpt'];
        $this->body_en    = $translations_array['en']['body'];
        $this->body_ar    = $translations_array['ar']['body'];
        $this->status     = $this->page->status;
    }

    public function generateSlug(){
        $this->slug = slug($this->title_en);
    }

    public function rules()
    {
        return [
            'slug' => 'required|string|unique:pages,slug,'.$this->page->id,
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
            $page       = Page::updatePage($this->page,$slug,$title_en,$title_ar,$excerpt_en,$excerpt_ar,$body_en,$body_ar,$status);

            DB::commit();

            Page::flushCache();
          
            $this->reset(['title_en', 'title_ar', 'slug', 'excerpt_en', 'excerpt_ar' , 'body_en', 'body_ar', 'status', 'created_at']);
            // refresh pages data component
            $this->dispatch('refreshData')->to(PagesData::class);
            session()->flash('success', __('admin.success_create', ['item'=>$this->page->title]));
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
        return view('livewire.admin.pages.pages-update');
    }
}
