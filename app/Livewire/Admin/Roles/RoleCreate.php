<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Module;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;

class RoleCreate extends Component
{
    public $modules,$name;
    public $permissions = [];

    public function mount(){
        Gate::authorize('app.roles.create');
        $this->modules = Module::getWithPermissions();
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:roles,name,'
            ],
            'permissions.*' => [
                'integer',
            ],
            'permissions' => [
                'required',
                'array',
            ],
        ];
    }

    public function submit()
    {
        try {
            $data=$this->validate();
            // dd($data);
            DB::beginTransaction();

            Role::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ])->permissions()->sync($this->permissions);
            session()->flash('success',  __('admin.success_create',['item'=>__('admin.Role')]));

            DB::commit();
            return redirect()->route('app.roles.index');
            // refresh role data component
            $this->dispatch('refreshData')->to(RoleData::class);
        }catch(QueryException $e){
            DB::rollback();
            Log::error($e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.admin.roles.role-create',['modules'=>$this->modules]);
    }
}
