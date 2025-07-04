<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Banner extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['heading1_text', 'heading2_text', 'button_text'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banners';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
       
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    ##--------------------------------- RELATIONSHIPS
    // public function branches() {
    //     return $this->hasMany(Branch::class);
    // }
    ##--------------------------------- ATTRIBUTES

    ##--------------------------------- CUSTOM FUNCTIONS
    public static function getAllBanners($keyword=null,$status=null,$sortColumn='id',$sortDirection='desc',$limit){

        $banners = self::select('id','picture','is_active','order','updated_at','created_at')->with('translations');

        if($keyword != null)
            $banners = $banners->whereHas('translations', function ($query) use($keyword) {
                $query->where('locale', lang())
                        ->where('heading1_text','like','%'.$keyword.'%')
                        ->orWhere('heading2_text','like','%'.$keyword.'%');
            });

        if($status != null){
            if($status == 'active')
                $banners = $banners->where('is_active', 1);
            else
                $banners = $banners->where('is_active', 0);
        }
            
        if($sortColumn == "heading1_text" || $sortColumn == "heading2_text" || $sortColumn == "button_text")
            $banners = $banners->orderByTranslation($sortColumn,$sortDirection)->paginate($limit);
        else
            $banners = $banners->orderBy($sortColumn,$sortDirection)->paginate($limit);

        return $banners;
    }
    public static function storeBanner($heading1_text_en,$heading1_text_ar,$heading2_text_en,$heading2_text_ar,$button_text_en,$button_text_ar,$button_href,$button_target,$is_active){
        $banner = new Banner();
        $banner->translateOrNew('en')->heading1_text = $heading1_text_en;
        $banner->translateOrNew('en')->heading2_text = $heading2_text_en;
        $banner->translateOrNew('en')->button_text = $button_text_en;
        $banner->translateOrNew('ar')->heading1_text = $heading1_text_ar;
        $banner->translateOrNew('ar')->heading2_text = $heading2_text_ar;
        $banner->translateOrNew('ar')->button_text = $button_text_ar;
        $banner->button_href = $button_href;
        $banner->button_target = $button_target;
        $banner->is_active = $is_active;
        $banner->save();
        return $banner;
    }
    public static function updateBanner($banner,$heading1_text_en,$heading1_text_ar,$heading2_text_en,$heading2_text_ar,$button_text_en,$button_text_ar,$button_href,$button_target,$is_active){
        $banner->translateOrNew('en')->heading1_text = $heading1_text_en;
        $banner->translateOrNew('en')->heading2_text = $heading2_text_en;
        $banner->translateOrNew('en')->button_text = $button_text_en;
        $banner->translateOrNew('ar')->heading1_text = $heading1_text_ar;
        $banner->translateOrNew('ar')->heading2_text = $heading2_text_ar;
        $banner->translateOrNew('ar')->button_text = $button_text_ar;
        $banner->button_href = $button_href;
        $banner->button_target = $button_target;
        $banner->is_active = $is_active;
        $banner->save();
        return $banner;
    }
    public static function getBannersForLanding($limit){
        if(Cache::has('banners.landing')){
            return Cache::get('banners.landing');
        }else{
            $banners = self::Active()->select('id','picture','button_href','button_target')->with('translations')->limit($limit)->get();
            Cache::put('banners.landing', $banners, Carbon::now()->addHours(12));
            return $banners;
        }
    }
    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('banners.all');
        Cache::forget('banners.landing');
    }

    ##--------------------------------- SCOPES
    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }

    ##--------------------------------- ACCESSORS & MUTATORS

    ##--------------------------------- BOOT

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function() {
            self::flushCache();
        });

        static::deleted(function() {
            self::flushCache();
        });
    }
}
