<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateGeneralSettingsRequest extends FormRequest
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
            'site_title_en' => 'string|min:35|max:65',
            'site_title_ar' => 'string|min:35|max:65',
            'site_description_en' => 'string|nullable|min:120|max:320',
            'site_description_ar' => 'string|nullable|min:120|max:320',
            'site_address_line1_en' => 'nullable|string|min:10|max:150',
            'site_address_line1_ar' => 'nullable|string|min:10|max:150',
            'site_mobile1' => 'nullable|string|min:9|max:15',
            'site_phone' => 'nullable|string|min:8|max:15',
            'site_fax' => 'nullable|string|min:8|max:15',
            'site_email' => 'nullable|string|min:6|max:50',
            'site_po_box' => 'nullable|string|min:2|max:50',
            'site_postal_code' => 'nullable|string|min:2|max:50',
            'enable_en'=>'nullable'
        ];
    }

    public function attributes()
    {
        return [ 
            'site_title_en' => __('admin.settings.Site Title').' '.__('admin.(en)'),
            'site_title_ar' => __('admin.settings.Site Title').' '.__('admin.(ar)'),
            'site_description_en' => __('admin.settings.Site Description').' '.__('admin.(en)'),
            'site_description_ar' => __('admin.settings.Site Description').' '.__('admin.(ar)'),
            'site_address_line1_en' => __('admin.settings.Site Address 1').' '.__('admin.(en)'),
            'site_address_line1_ar' => __('admin.settings.Site Address 1').' '.__('admin.(ar)'),
            'site_mobile1' => __('admin.settings.Site Mobile').' 1',
            'site_phone' => __('admin.settings.Site Phone'),
            'site_fax' => __('admin.settings.Site Fax'),
            'site_email' => __('admin.settings.Site Email'),
            'site_po_box' => __('admin.settings.PO Box'),
            'site_postal_code' => __('admin.settings.Postal Code'),
            'enable_en' => __('admin.Enable En')
        ];
    }
}
