<?php

use Carbon\Carbon;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {

    /**
     * Get setting value by key.
     *
     * @param $key
     * @param $default
     *
     * @return string
     */
    function setting($key, $default=null)
    {
        if(Cache::has($key)){
            return Cache::get($key);
        }else{
            $setting = Setting::get($key, $default);
            Cache::put($key, $setting, Carbon::now()->addHours(1));
            return $setting;
        }
    }
}
