<?php

namespace App\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Exports\UsersExport;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class UsersData extends Component
{
    use WithPagination;

    public $search;
    public $status;
    public $role_id;
    public $publish_date;
    public $sortColumn = "id";
    public $sortDirection = "desc";
    public $checkedUsers = [];
    public $roles = [];
    public $paginate = 10;
    public $checked = [];
    public $selectPage = false;
    public $selectAll = false;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh','deleteCheckedUsers','resetSelected'];

    public function mount()
    {
        Gate::authorize('app.users.index');
        $this->roles = Role::getAllForSelect();
    }

    public function updatedPage($page)
    {
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false; 
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->users->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        $this->selectPage = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->checked = $this->usersQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function getUsersProperty()
    {
        return $this->usersQuery->paginate($this->paginate);
    }

    public function getUsersQueryProperty()
    {
        $keyword = $this->search;
        $status = $this->status;
        $role_id = $this->role_id;
        $publish_date = $this->publish_date;
        $sortColumn= $this->sortColumn;
        $sortDirection = $this->sortDirection;
        return User::getAllUsers($keyword,$status,$role_id,$publish_date,$sortColumn,$sortDirection,$this->paginate);
    }

    public function deleteRecords()
    {
        User::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        $this->dispatch('successDelete');
    }

    public function exportSelected()
    {
        return (new UsersExport($this->checked))->download('users.xlsx');
    }

    public function deleteSingleRecord($student_id)
    {
        $student = User::findOrFail($student_id);
        $student->delete();
        $this->checked = array_diff($this->checked, [$student_id]);
        $this->dispatch('successDelete');
    }

    public function isChecked($user_id)
    {
        return in_array($user_id, $this->checked) ? 'bg-light-info text-dark' : '';
    }

    public function updatedSelectedClass($class_id)
    {
        $this->sections = Section::where('class_id', $class_id)->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->checkedUsers = [];
        $this->dispatch('resetActions');
    }

    public function updatingStatus()
    {
        $this->resetPage();
        $this->checkedUsers = [];
        $this->dispatch('resetActions');
    }

    public function updatingPublishDate()
    {
        $this->resetPage();
        $this->checkedUsers = [];
        $this->dispatch('resetActions');
    }
    
    public function updatingRoleId()
    {
        $this->resetPage();
        $this->checkedUsers = [];
        $this->dispatch('resetActions');
    }
    
    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->resetPage();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function render()
    {
        return view('livewire.admin.users.users-data', ['data' => $this->users]);
    }

    public function deleteUsers(){
        $this->dispatch('swal:deleteUsers',[
            'title'=>__('admin.Delete'),
            'html'=>__('admin.confirm_delete_text'),
            'yes'=>__('admin.cancel_no'),
            'no'=>__('admin.yes_delete'),
            'checkedIDs'=>$this->checkedUsers,
        ]);
    }

    public function deleteCheckedUsers($ids){
        User::whereKey($ids)->delete();
        $this->checkedUsers = [];
        $this->dispatch('resetActions');
        $this->dispatch('successDelete');
    }

    public function resetSelected()
    {
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false; 
    }
   
}
