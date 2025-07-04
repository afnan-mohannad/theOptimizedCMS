<?php

namespace App\Livewire\Admin\Banners;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Banners\BannersData;

class BannersCreate extends Component
{
    use WithFileUploads;

    public $heading1_text_en, $heading1_text_ar, $heading2_text_en, $heading2_text_ar, $button_text_en, $button_text_ar, $button_href, $button_target, $picture, $is_active;

    public function mount()
    {
        Gate::authorize('app.banners.create');
        $this->is_active = true;
    }

    public function removePicture()
    {
        $this->picture = null;
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
            'picture' => 'required|image|mimes:png,jpg,jpeg,svg|max:1024',
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

            $this->validate($this->rules(), [], $this->attributes());

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

            // save data in db
            $banner = Banner::storeBanner($heading1_text_en,$heading1_text_ar,$heading2_text_en,$heading2_text_ar,$button_text_en,$button_text_ar,$button_href,$button_target,$is_active);

            // save image on my project
            $imageName = time() . '.' . $this->picture->getClientOriginalExtension();
            $this->picture->storeAs('banners/pictures', $imageName, 'public');
       
            $banner->picture = 'banners/pictures/' . $imageName;
            $banner->save();
            
            DB::commit();

            $this->reset(['heading1_text_en', 'heading1_text_ar', 'heading2_text_en', 'heading2_text_ar', 'button_text_en', 'button_text_ar', 'button_href', 'button_target','picture', 'is_active']);
            // hide modal
            $this->dispatch('createModalToggle');
            // refresh banner data component
            $this->dispatch('refreshData')->to(BannersData::class);
            
        }catch(Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            
        }
    }
    
    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatch('scrollToError');
         }
        return view('livewire.admin.banners.banners-create');
    }
}