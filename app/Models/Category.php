<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;


class Category extends Model implements TranslatableContract
{
    use Translatable;
     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public $translatedAttributes = ['name', 'description'];

    public function posts()
    {
        return $this->hasMany(Post::class,'category_id');
    }
    
    public function children()
    {
    return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeMain($query)
    {
        return $query->where('parent_id', null);
    }

    /**
     * Get all roles
     *
     * @return mixed
     */
    public static function getAllCategories($keyword=null,$status=null,$main_category_id=null,$sortColumn='id',$sortDirection='desc',$limit=10)
    {
        $categories = self::select('id','is_active','slug','picture','parent_id','updated_at','created_at')->with(['translations','parent']);

        if($keyword != null)
            $categories = $categories->whereHas('translations', function ($query) use($keyword) {
                $query->where('name','like','%'.$keyword.'%')
                      ->orWhere('description','like','%'.$keyword.'%');
            });

        if($status != null){
            if($status == 'active')
                $categories = $categories->where('is_active', 1);
            else
                $categories = $categories->where('is_active', 0);
        }

        if($main_category_id != null){
            $categories = $categories->where('parent_id', $main_category_id);
        }

        if($sortColumn == "name" || $sortColumn == "description")
            $categories = $categories->orderByTranslation($sortColumn,$sortDirection)->paginate($limit);
        else
            $categories = $categories->orderBy($sortColumn,$sortDirection)->paginate($limit);

        return $categories;         
    }

    /**
     * Get roles for select
     *
     * @return mixed
     */
    public static function getForSelect()
    {
        if(Cache::has('categories.getForSelect')){
            return Cache::get('categories.getForSelect');
        }else{
            $categories = self::Active()->Main()->select('id','slug')->with('translations')->get();
            Cache::put('categories.getForSelect', $categories, Carbon::now()->addHours(12));
            return $categories;
        }
    }

    public static function getAllForSelect()
    {
        if(Cache::has('categories.getAllForSelect')){
            return Cache::get('categories.getAllForSelect');
        }else{
            $categories = self::Active()->select('id','slug')->with('translations')->get();
            Cache::put('categories.getAllForSelect', $categories, Carbon::now()->addHours(12));
            return $categories;
        }
    }

    public static function getCategoryById($id)
    {
        if(Cache::tags('category')->has('category_'.$id)){
            return Cache::tags('category')->get('category_'.$id);
        }else{
            $category = self::where('id',$id)->select('id')->with('translations')->first();
            Cache::tags('category')->put('category_'.$id, $category, Carbon::now()->addHours(12));
            return $category;
        }
    }

    public static function getCategoryBySlug($slug)
    {
        if(Cache::tags('category')->has('category_'.$slug)){
            return Cache::tags('category')->get('category_'.$slug);
        }else{
            $category = self::Active()
                            ->where('slug',$slug)
                            ->select('id','slug','picture')
                            ->with('translations')
                            ->first();
            Cache::tags('category')->put('category_'.$slug, $category, Carbon::now()->addHours(12));
            return $category;
        }
    }

    public static function checkCategoryBySlug($slug)
    {
        return self::where('slug',$slug)->first() ? true : false;
    }

    public static function storeCategory($slug,$name_en,$name_ar,$description_en,$description_ar,$parent_id,$is_active)
    {
        $category = new Category();
        $category->translateOrNew('en')->name = $name_en;
        $category->translateOrNew('en')->description = $description_en;
        $category->translateOrNew('ar')->name = $name_ar;
        $category->translateOrNew('ar')->description = $description_ar;
        $category->is_active = $is_active;
        $category->parent_id = $parent_id;
        $category->slug = $slug;
        $category->save();
        return $category;
    }

    public static function updateCategory($category,$slug,$name_en,$name_ar,$description_en,$description_ar,$parent_id,$is_active)
    {
        $category->translateOrNew('en')->name = $name_en;
        $category->translateOrNew('en')->description = $description_en;
        $category->translateOrNew('ar')->name = $name_ar;
        $category->translateOrNew('ar')->description = $description_ar;
        $category->is_active = $is_active;
        $category->parent_id = $parent_id;
        $category->slug = $slug;
        $category->save();
    }

    public static function getCount(){
        if(Cache::get('categories.count')){
            return Cache::get('categories.count');
        }else{
            $count = self::Active()->count();
            Cache::put('categories.count', $count, Carbon::now()->addDays(7));
            return $count;
        }
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('categories.all');
        Cache::forget('categories.count');
        Cache::forget('categories.getForSelect');
        Cache::forget('categories.getAllForSelect');
        Cache::tags('category')->flush();
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
