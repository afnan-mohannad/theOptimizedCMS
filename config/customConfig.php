<?php

return [
    'name' => env('APP_NAME', 'CCMS'),
    'cdn_assets_url' => env('CDN_ASSET_URL'),
    'tiny_mce_api_key'=> env('TINY_MCE_API_KEY'),
    'locales' => ['en', 'ar'],
    'locales_text_display' => ['en' => 'English', 'ar' => 'العربية'],
    'fallback_locale' => 'ar',
    'google_recaptcha_key'=> env('GOOGLE_RECAPTCHA_KEY_V3',''),
    'google_recaptcha_secret'=> env('GOOGLE_RECAPTCHA_SECRET_V3',''),
    'enable_en'=> env('ENABLE_EN',0),
    'env' => env('APP_ENV', 'stg')
]

?>
