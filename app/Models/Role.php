<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get all roles
     *
     * @return mixed
     */
    public static function getAllRoles()
    {
        return Cache::rememberForever('roles.all', function() {
            return self::withCount('permissions')->latest('id')->get();
        });
    }

    /**
     * Get roles for select
     *
     * @return mixed
     */
    public static function getForSelect()
    {
        return Cache::rememberForever('roles.getForSelect', function() {
            return self::select('id', 'name', 'slug')->whereNot('slug', 'super-admin')->get();
        });
    }

    public static function getAllForSelect()
    {
        if(Cache::has('roles.getAllForSelect')){
            return Cache::get('roles.getAllForSelect');
        }else{
            $roles = self::select('id','name')->whereNot('slug', 'super-admin')->get();
            Cache::put('roles.getAllForSelect', $roles, Carbon::now()->addHours(12));
            return $roles;
        }
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('roles.all');
        Cache::forget('roles.getForSelect');
        Cache::forget('roles.getAllForSelect');
        Cache::tags('permissions')->flush();
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
