<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function getMeta($type = 'landing'){
        $meta = embedMeta($type);
        return $meta;
    }
    protected function getGeoCountry(){
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARTDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        if(config('customConfig.env') != 'production' && config('customConfig.debug')){
            Log::info('IP is : '.$ip);
        }

        if(config('customConfig.env') == 'production' || config('customConfig.env') == 'stg'){
            if (Cache::has('ip_'. $ip)){
                $country = Cache::get('ip_'. $ip);
            }else{
                $location = GeoIP::getLocation($ip);
                if(isset($location) && !empty($location)){
                    $country = $location->iso_code;
                    if(isset($country) && !empty($country)){
                        Log::info('Country is : '.$country);
                        Cache::put('ip_'. $ip, $country,Carbon::now()->addDays(2));
                    }
                }else{
                    $country = 'PS';
                }
            }
        }else{
            $country = 'PS';
        }

        return $country;
    }
}
