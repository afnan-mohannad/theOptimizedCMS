<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // General Settings
        //Tab
        Setting::updateOrCreate(['display_name' => 'General','status' => 1,'settingType'=>'group','key'=>'general']);
        Setting::updateOrCreate(['display_name' => 'Appearance','status' => 1,'settingType'=>'group','key'=>'appearance']);
        Setting::updateOrCreate(['display_name' => 'Social Account','status' => 1,'settingType'=>'group','key'=>'socialite']);

        // Title --> 35-65
        Setting::updateOrCreate(['display_name' => 'Site Title in English','value' => 'CCMS','status' => 1,'settingType'=>'field','fieldType' => 'text','key'=>'site_title_en','group' => 'general']);
        Setting::updateOrCreate(['display_name' => 'Site Title','value' => 'CCMS','status' => 1,'settingType'=>'field','fieldType' => 'text','key'=>'site_title_ar','group' => 'general']);
        // Description --> 120-320 
        Setting::updateOrCreate(['display_name' => 'Site Description in English','value' => 'description','status' => 1,'settingType'=>'field','fieldType' => 'text_area','key'=>'site_description_en','group' => 'general']);
        Setting::updateOrCreate(['display_name' => 'Site Description','value' => 'description','status' => 1,'settingType'=>'field','fieldType' => 'text_area','key'=>'site_description_en','group' => 'general']);
        // Social Media
        Setting::updateOrCreate(['display_name' => 'Facebook','value' => '','status' => 1,'settingType'=>'field','fieldType' => 'text','key'=>'social_facebook','group' => 'socialite']);
        Setting::updateOrCreate(['display_name' => 'Twitter','value' => '','status' => 1,'settingType'=>'field','fieldType' => 'text','key'=>'social_twitter','group' => 'socialite']);
        Setting::updateOrCreate(['display_name' => 'Instagram','value' => '','status' => 1,'settingType'=>'field','fieldType' => 'text','key'=>'social_instagram','group' => 'socialite']);       
        Setting::updateOrCreate(['display_name' => 'Youtube','value' => '','status' => 1,'settingType'=>'field','fieldType' => 'text','key'=>'social_youtube','group' => 'socialite']);

        // Branding Settings
        Setting::updateOrCreate(['display_name' => 'Logo Light','value' => null,'status' => 1,'settingType'=>'field','fieldType' => 'file','key'=>'site_logo_light','group' => 'appearance']);
        Setting::updateOrCreate(['display_name' => 'Logo Dark','value' => null,'status' => 1,'settingType'=>'field','fieldType' => 'file','key'=>'site_logo_dark','group' => 'appearance']);
        Setting::updateOrCreate(['display_name' => 'Fav Icon','value' => null,'status' => 1,'settingType'=>'field','fieldType' => 'file','key'=>'site_favicon','group' => 'appearance']);
       
    }
}
