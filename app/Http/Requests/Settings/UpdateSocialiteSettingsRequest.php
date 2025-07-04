<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSocialiteSettingsRequest extends FormRequest
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
            'social_facebook' => 'nullable|string|min:2|max:255|url',
            'social_twitter' => 'nullable|string|min:2|max:255|url',
            'social_instagram' => 'nullable|string|min:2|max:255|url',
            'social_youtube' => 'nullable|string|min:2|max:255|url',
            'google_analytics_id' => 'nullable|string|min:2|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'social_facebook' => __('admin.settings.Facebook'),
            'social_twitter' => __('admin.settings.Twitter'),
            'social_instagram' => __('admin.settings.Instagram'),
            'social_youtube' => __('admin.settings.Youtube'),
            'google_analytics_id' => __('admin.settings.Google'),
        ];
    }
}
