<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

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
        // 'status' => Status::class,
    ];

    ##--------------------------------- RELATIONSHIPS
    // public function branches() {
    //     return $this->hasMany(Branch::class);
    // }


    ##--------------------------------- ATTRIBUTES


    ##--------------------------------- CUSTOM FUNCTIONS

    public static function getAllMessages($keyword=null,$status=null,$sortColumn='id',$sortDirection='desc',$limit){
        $messages = self::select('id','name','email','message','is_active','created_at');
        if($keyword != null)
            $messages = $messages->where('name','like','%'.$keyword.'%')
                                 ->orWhere('email','like','%'.$keyword.'%');
        if($status != null){
            if($status == 'active')
                $messages = $messages->where('is_active', 1);
            else
                $messages = $messages->where('is_active', 0);
        }
        return $messages->orderBy($sortColumn,$sortDirection)->paginate($limit);
    }

    public static function storeMessage($name,$email,$message){
        return self::create([
            'name'=>$name,
            'email'=>$email,
            'message'=>$message,
            'subject'=>'contact-us',
        ]);
    }

    public static function getCount()
    {
        if(Cache::get('messages.count')){
            return Cache::get('messages.count');
        }else{
            $count = self::Active()->count();
            Cache::put('messages.count', $count, Carbon::now()->addDays(7));
            return $count;
        }
    }


    ##--------------------------------- SCOPES
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }


    ##--------------------------------- ACCESSORS & MUTATORS

     /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::flush('messages.count');
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
