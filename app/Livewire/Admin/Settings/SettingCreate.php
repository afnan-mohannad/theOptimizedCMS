<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

class SettingCreate extends Component
{
    public $addType, $group, $display_name, $key, $type,$allGroup,$status,$tab;

    public function mount()
    {
        Gate::authorize('app.settings.update');
        $this->allGroup=Setting::where('settingType','group')->get();
    }
    public function generateKey(){
        $this->key = slug($this->display_name);
    }
    public function rules()
    {
        return [
            'addType'=> 'required',
            'display_name' => 'required',
            'key' => 'required|unique:settings|string',
        ];
    }

    public function attributes()
    {
        return [
            'addType'=> 'Setting Type',
            'group' => 'Group Name',
            'display_name' => 'Name',
            'key' => 'Key',
            'type'=>'Field Type'
        ];
    }

    public function submit()
    {
        $data = $this->validate($this->rules(), [], $this->attributes());
        try {
       
            DB::beginTransaction();
            Setting::createSettings(
                $this->addType,
                $this->group,
                $this->display_name,
                $this->key,  
                $this->type,
                $this->status              
            );
            DB::commit();
            $this->tab=$this->group;
            $this->reset(['addType', 'group', 'display_name', 'key', 'type']);
            // refresh settings data component
            $this->dispatch('refreshData')->to(GeneralUpdate::class);
            session()->flash('success', __('admin.success_create'));
            return redirect()->route('app.settings.index',$this->tab);
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
        return view('livewire.admin.settings.setting-create',['allGroup'=>$this->allGroup]);
    }
}
