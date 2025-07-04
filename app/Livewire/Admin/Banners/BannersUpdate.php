<?php

namespace App\Livewire\Admin\Banners;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;

class BannersUpdate extends Component
{
    use WithFileUploads;

    public $banner,$heading1_text_en, $heading1_text_ar, $heading2_text_en, $heading2_text_ar, $button_text_en, $button_text_ar, $button_href, $button_target, $picture, $is_active;
   
    protected $listeners = ['bannerUpdate'];
    
    public function mount()
    {
        Gate::authorize('app.banners.edit');
    }

    public function bannerUpdate($id)
    {
        // fill $banner with the eloquent model of the same id
        $this->banner = Banner::find($id);
        $translations_array = $this->banner->getTranslationsArray();
        $this->heading1_text_en = $translations_array['en']['heading1_text'];
        $this->heading1_text_ar = $translations_array['ar']['heading1_text'];
        $this->heading2_text_en = $translations_array['en']['heading2_text'];
        $this->heading2_text_ar = $translations_array['ar']['heading2_text'];
        $this->button_text_en = $translations_array['en']['button_text'];
        $this->button_text_ar =  $translations_array['ar']['button_text'];
        $this->button_href = $this->banner->button_href;
        $this->button_target = $this->banner->button_target;
        $this->is_active = $this->banner->is_active ?? true;
        $this->picture = $this->banner->picture;
        $this->resetValidation();
        // show edit modal
        $this->dispatch('updateModalToggle');
    }

    public function removePicture()
    {
        $this->picture = null;
        if(!empty($this->banner->picture))
            unlink('storage/'.$this->banner->picture);
        $this->banner->picture = '';
        $this->banner->save();
    }

    public function rules()
    {
        return [
            'heading1_text_en' => 'required|string|min:3|max:100',
            'heading1_text_ar' => 'required|string|min:3|max:100',
            'heading2_text_en' => 'required|string|min:3|max:100',
            'heading2_text_ar' => 'required|string|min:3|max:100',
            'button_text_en' => 'required|string|min:3|max:50',
            'button_text_ar' => 'required|string|min:3|max:50',
            'picture' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'heading1_text_en' => __('admin.banners.attributes.heading1_text_en'),
            'heading1_text_ar' => __('admin.banners.attributes.heading1_text_ar'),
            'heading2_text_en' => __('admin.banners.attributes.heading2_text_en'),
            'heading2_text_ar' => __('admin.banners.attributes.heading2_text_ar'),
            'button_text_en' => __('admin.banners.attributes.button_text_en'),
            'button_text_ar' => __('admin.banners.attributes.button_text_ar'),
        ];
    }
    public function submit()
    {
        try {
            $data = $this->validate($this->rules(), [], $this->attributes());

            DB::beginTransaction();
            
            $heading1_text_en = trim($this->heading1_text_en);
            $heading1_text_ar = trim($this->heading1_text_ar);
            $heading2_text_en = trim($this->heading2_text_en);
            $heading2_text_ar = trim($this->heading2_text_ar);
            $button_text_en = trim($this->button_text_en);
            $button_text_ar = trim($this->button_text_ar);
            $button_href = trim($this->button_href);
            $button_target = trim($this->button_target);
            $is_active = $this->is_active ?? false;

            // update data
            $banner = Banner::updateBanner($this->banner,$heading1_text_en,$heading1_text_ar,$heading2_text_en,$heading2_text_ar,$button_text_en,$button_text_ar,$button_href,$button_target,$is_active);
            
            // save image on my project
            if ($this->picture != $this->banner->picture  && !empty($this->picture)) {
                if(!empty($this->banner->picture))
                    unlink('storage/'.$this->banner->picture);
                $imageName = time() . '.' . $this->picture->getClientOriginalExtension();
                $this->picture->storeAs('banners/pictures', $imageName, 'public');
                $banner->picture = 'banners/pictures/' . $imageName;
                $banner->save();
            } 

            DB::commit();

            // hide modal
            $this->dispatch('updateModalToggle');
            // refresh team data component
            $this->dispatch('refreshData')->to(BannersData::class);
            
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
        return view('livewire.admin.banners.banners-update');
    }
}