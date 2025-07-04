<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

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
        'created_at' => 'date',
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
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    ##--------------------------------- ATTRIBUTES

    ##--------------------------------- CUSTOM FUNCTIONS
    public static function getAllTags($keyword=null,$status=null,$sortColumn='id',$sortDirection='desc',$limit){
        $tags = self::select('id','slug','is_active','order','updated_at','created_at');
        if($keyword != null)
            $tags = $tags->where('slug','like','%'.$keyword.'%');
        if($status != null){
            if($status == 'active')
                $tags = $tags->where('is_active', 1);
            else
                $tags = $tags->where('is_active', 0);
        }
        return $tags->orderBy($sortColumn,$sortDirection)->paginate($limit);
    }
    public static function storeTag($slug,$is_active){
        $tag = new Tag();
        $tag->slug = $slug;
        $tag->is_active = $is_active;
        $tag->save();
        return $tag;
    }
    public static function updateTag($tag,$slug,$is_active){
        $tag->slug = $slug;
        $tag->is_active = $is_active;
        $tag->save();
        return $tag;
    }

    /**
     * Get roles for select
     *
     * @return mixed
     */
    public static function getForSelect()
    {
        if(Cache::has('tags.getForSelect')){
            return Cache::get('tags.getForSelect');
        }else{
            $tags = self::Active()->select('id','slug')->get();
            Cache::put('tags.getForSelect', $tags, Carbon::now()->addHours(12));
            return $tags;
        }
    }

    public static function getTagsByIds($ids)
    {
        return self::whereIn('id',$ids)->get();
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('tags.all');
        Cache::forget('tags.getForSelect');
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
