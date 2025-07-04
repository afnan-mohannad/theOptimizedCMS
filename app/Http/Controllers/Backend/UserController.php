<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        Gate::authorize('app.users.index');
        $keyword = $request->search;
        $status=$request->is_active;
        $users = User::getAllUsers($keyword,$status,20);
        return view('backend.admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.users.create');
        $roles = Role::getForSelect();
        return view('backend.admin.users.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::storeUser(
                $request->role,
                $request->name,
                $request->email,
                $request->password,
                $request->filled('status')
            );

            // upload avatar
            if ($request->hasFile('avatar')) {
                $avatarName = $request->file('avatar')->store('avatars', ['disk' => 'public']);
                $user->update(['avatar'=>$avatarName]);
                $user->save();
            }

            DB::commit();

            session()->flash('success', __('admin.success_create', ['item'=>$user->name]));
            return redirect()->route('app.users.index');

        }catch(QueryException $e){
            DB::rollback();
            Log::error($e->getMessage());
             session()->flash('error', __('admin.something_wrong'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('backend.admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('app.users.edit');
        $roles = Role::getForSelect();
        return view('backend.admin.users.form', compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $name = $request->name;
            $email= $request->email;
            $role = $request->role;
            $password = $request->password ?? null;
            $status = $request->filled('status');
            $user::updateUser($user,$role,$name,$email,$password,$status);

            // upload avatar
            if ($request->hasFile('avatar')) {
                $avatarName = $request->file('avatar')->store('avatars', ['disk' => 'public']);
                $user->update(['avatar'=>$avatarName]);
                $user->save();
            }

            DB::commit();
            session()->flash('success',__('admin.success_update', ['item'=>$user->name]));
            
            if(auth()->user()->hasPermission('app.users.index'))
                return redirect()->route('app.users.index');
            else
                return redirect()->back();

        }catch(QueryException $e){
            DB::rollback();
            Log::error($e->getMessage());
            session()->flash('error', __('admin.something_wrong'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        Gate::authorize('app.users.destroy');

        if($user->role_id == 1)
        {
            session()->flash('success', __('admin.users.not_deleted'));
        }

        $user->delete();
        session()->flash('success',__('admin.success_delete'));
        return back();
    }
}
