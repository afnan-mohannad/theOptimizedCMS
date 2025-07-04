<?php

namespace App\Livewire\Admin\Settings;
use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;

class GeneralUpdate extends Component
{
    use WithFileUploads; 
    public $fields,$status,$group;
    
    public $inputs=[];

    protected $listeners = ['refreshData' => '$refresh'];  

    public function mount()
    {
        Gate::authorize('app.settings.update');
        $this->fields=Setting::where('settingType','field')->where('group',last(request()->segments()))->get();
        $this->group=Setting::where('settingType','group')->where('key',last(request()->segments()))->first();
        $this->status=$this->group?->status;
        
        foreach($this->fields as $field){
           $this->inputs[$field->key]= $field->value;
        }
       
    }
    public function removeField($id)
    {
       Setting::find($id)->delete();
       $this->dispatch('refreshData')->to(GeneralUpdate::class);
    }
   

    public function submit(Request $request)
    {
        foreach($this->inputs as $key=> $input){
            $setting_file = null;
            
            $setting=Setting::where('settingType','field')->where('key',$key)->first();
            if($setting->fieldType == 'file')
            { 
                if(gettype($input) == 'object'){
                    $setting_file = Str::random(5). '.' . $input->getClientOriginalExtension();
                    logger($setting);
                    $input->storeAs('settings/general', $setting_file, 'public');
                    
                    $setting->update(['value'=>'settings/general/' . $setting_file]);
                } 
            }
            else{

                $setting->update(['value'=>$input]);
            }
           
        }
        $this->group->update(['status'=>$this->status]);
        $this->dispatch('swal:successUpdate', [
            'title'=>__('admin.settings.success_update'),
            'html'=>__('admin.settings.success_update'),
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'yes'=>__('admin.Close'),
        ]);
        
           
    }

    public function render()
    {
       
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatch('scrollToError');
        }
        if(count($this->fields)==0){
            $this->group->update(['status'=>0]);
            $this->status=0;
         }
        return view('livewire.admin.settings.general-update',['fields'=>$this->fields]);
    }
}
