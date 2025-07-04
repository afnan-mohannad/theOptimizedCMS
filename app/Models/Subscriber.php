<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscribers';

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
   
    ##--------------------------------- ATTRIBUTES

    ##--------------------------------- CUSTOM FUNCTIONS
    public static function getAllSubscribers($keyword=null,$status=null,$sortColumn='id',$sortDirection='desc',$limit){
        $subscribers = self::select('id','email','country_code','is_active','updated_at','created_at');
        if($keyword != null)
            $subscribers = $subscribers->where('email','like','%'.$keyword.'%')
                         ->orWhere('country_code','like','%'.$keyword.'%');
        if($status != null){
            if($status == 'active')
                $subscribers = $subscribers->where('is_active', 1);
            else
                $subscribers = $subscribers->where('is_active', 0);
        }
        return $subscribers->orderBy($sortColumn,$sortDirection)->paginate($limit);
    }

    public static function storeSubscriber($email,$country_code){
        return self::create([
            'email'=>$email,
            'country_code'=>$country_code
        ]);
    }

    public static function getCount(){
        if(Cache::get('subscriber.count')){
            return Cache::get('subscriber.count');
        }else{
            $count = self::Active()->count();
            Cache::put('subscriber.count', $count, Carbon::now()->addDays(7));
            return $count;
        }
    }

    public static function getCountries(){
        return self::Active()
                    ->get()
                    ->unique('country_code')
                    ->pluck('country_code')
                    ->toArray();
    }
    
    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('subscriber.count');
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
