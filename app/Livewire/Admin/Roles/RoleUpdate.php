<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use App\Models\Module;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;


class RoleUpdate extends Component
{
    public $modules,$role,$name;
    public array $permissions=[];

    public function mount($id){
        Gate::authorize('app.roles.edit');
        $this->modules = Module::all();
        $this->role=Role::find($id);
        $this->name=$this->role->name;
        $this->permissions= array_merge($this->permissions,$this->role->permissions->pluck('id')->toArray());
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                
            ],
            'permissions.*' => [
                'integer',
            ],
            'permissions' => [
                'required',
            ],
        ];
    }

    public function submit(){
         $data=$this->validate();
         $this->role->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);
        $this->role->permissions()->sync($this->permissions);
        $this->role->flushCache();
        session()->flash('success',  __('admin.success_update',['item'=>__('admin.Role')]));
        return redirect()->route('app.roles.index');
    }

    public function render()
    {
        return view('livewire.admin.roles.role-update',['modules'=>$this->modules,'role'=>$this->role]);
    }
}