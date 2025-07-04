<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Page extends Model implements TranslatableContract
{
    use Translatable;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $with = ['translations'];
    
    public $translatedAttributes = ['title','excerpt','body'];

    /**
     * Find page by slug.
     *
     * @param $slug
     * @return mixed
     */
    public static function findBySlug($slug)
    {
        return self::where('slug',$slug)->firstOrFail();
    }

    /**
     * Scope a query to only include active pages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public static function storePage($slug,$title_en,$title_ar,$excerpt_en,$excerpt_ar,$body_en,$body_ar,$status)
    {
        $page = new Page();
        $page->translateOrNew('en')->title = $title_en;
        $page->translateOrNew('en')->excerpt = $excerpt_en;
        $page->translateOrNew('en')->body = $body_en;
        $page->translateOrNew('ar')->title = $title_ar;
        $page->translateOrNew('ar')->excerpt = $excerpt_ar;
        $page->translateOrNew('ar')->body = $body_ar;
        $page->status = $status;
        $page->slug   = $slug;
        $page->save();
        return $page;
    }

    public static function updatePage($page,$slug,$title_en,$title_ar,$excerpt_en,$excerpt_ar,$body_en,$body_ar,$status)
    {
        $page->translate('en')->title = $title_en;
        $page->translate('en')->excerpt = $excerpt_en;
        $page->translate('en')->body = $body_en;
        $page->translate('ar')->title = $title_ar;
        $page->translate('ar')->excerpt = $excerpt_ar;
        $page->translate('ar')->body = $body_ar;
        $page->status = $status;
        $page->slug   = $slug;
        $page->save();
    }

    public static function getAllPages($keyword=null,$status=null,$sortColumn='id',$sortDirection='asc',$limit=10)
    {
        $pages = self::select('id','slug','status','updated_at','created_at')
                        ->with('translations');

        if($keyword != null)
            $pages = $pages->whereHas('translations', function ($query) use($keyword) {
                $query->where('title','like','%'.$keyword.'%')
                        ->orWhere('excerpt','like','%'.$keyword.'%')
                        ->orWhere('body','like','%'.$keyword.'%');
            });

        if($status != null){
            if($status == 'active')
                $pages = $pages->where('status', 1);
            else
                $pages = $pages->where('status', 0);
        }

        if($sortColumn == "title")
            $pages = $pages->orderByTranslation($sortColumn,$sortDirection)->paginate($limit);
        else
            $pages = $pages->orderBy($sortColumn,$sortDirection)->paginate($limit);

        return $pages;  
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('pages.all');
    }

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
