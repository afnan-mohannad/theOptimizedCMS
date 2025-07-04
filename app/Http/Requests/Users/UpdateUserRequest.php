<?php

namespace App\Http\Requests\Users;

use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('app.users.edit');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . request()->route('user')->id],
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'role' => ['required'],
            'avatar' => ['nullable', 'image'],
        ];
    }

    public function attribues()
    {
        return [
            'name' => __('admin.Name'),
            'email' => __('admin.users.Email'),
            'password' => __('admin.users.Password'),
            'role' => __('admin.Role'),
            'avatar' => __('Avatar')
        ];
    }
}
