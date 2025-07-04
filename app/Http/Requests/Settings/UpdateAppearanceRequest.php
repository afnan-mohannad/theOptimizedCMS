<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateAppearanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('app.settings.update');
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
            'site_logo_light' => ['nullable', 'image'],
            'site_logo_dark' => ['nullable', 'image'],
            'site_favicon' => ['nullable', 'image']
        ];
    }


    public function attribues()
    {
        return [
            'site_logo_light' => __('admin.Logo'),
            'site_logo_dark' => __('admin.Logo'),
            'site_favicon' => __('admin.Fav Icon')
        ];
    }
}
