<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Settings\UpdateAppearanceRequest;
use App\Http\Requests\Settings\UpdateGeneralSettingsRequest;
use App\Http\Requests\Settings\UpdateSocialiteSettingsRequest;

class SettingController extends Controller
{
    /**
     * Show General Settings Page
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Gate::authorize('app.settings.index');
        return view('backend.admin.settings.general');
    }

    /**
     * Update General Settings
     * @param UpdateGeneralSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGeneralSettingsRequest $request)
    {
        Gate::authorize('app.settings.update');
        if($request->enable_en == null){
            Setting::updateSettings($request->validated()+['enable_en'=>'off']);
        }else{
            Setting::updateSettings($request->validated());
        }
        session()->flash('success', __('admin.settings.success_update'));
        return back();
    }

    /**
     * Show Appearance Settings Page
     * @return \Illuminate\View\View
     */
    public function appearance()
    {
        Gate::authorize('app.settings.index');
        return view('backend.admin.settings.appearance');
    }

    /**
     * Update Appearance
     * @param UpdateAppearanceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAppearance(UpdateAppearanceRequest $request)
    {
        Gate::authorize('app.settings.update');
        if ($request->hasFile('site_logo')) {
            if(config('settings.site_logo') != null)
                $this->deleteOldLogo(config('settings.site_logo'));
            Setting::set('site_logo',Storage::disk('public')->putFile('logos', $request->file('site_logo')));
        }
        if ($request->hasFile('site_favicon')) {
            if(config('settings.site_favicon') != null)
                $this->deleteOldLogo(config('settings.site_favicon'));
            Setting::set('site_favicon', Storage::disk('public')->putFile('logos', $request->file('site_favicon')));
        }
        Cache::forget('site_logo');
        Cache::forget('site_favicon');
        session()->flash('success', __('admin.settings.success_update'));
        return back();
    }

    /**
     * Delete old logos from storage
     * @param $path
     */
    private function deleteOldLogo($path)
    {
        Storage::disk('public')->delete($path);
    }

    /**
     * Show Socialite Settings Page
     * @return \Illuminate\View\View
     */
    public function socialite()
    {
        Gate::authorize('app.settings.index');
        return view('backend.admin.settings.socialite');
    }

    /**
     * Update Socialite Settings
     *
     * @param UpdateSocialiteSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSocialiteSettings(UpdateSocialiteSettingsRequest $request)
    {
        Gate::authorize('app.settings.update');
        Setting::updateSettings($request->validated());
        session()->flash('success', __('admin.settings.success_update'));
        return back();
    }
}
