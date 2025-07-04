<?php

namespace App\Http\Requests\Menus;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('app.menus.create');
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
            'title.*' => 'required|string|unique:menu_items',
            'url' => 'nullable|string|unique:menu_items',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ];
    }
}
