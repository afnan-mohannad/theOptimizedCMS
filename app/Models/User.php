<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $softDelete = true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_date' => 'datetime',
        'created_at' => 'date',

    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeUser($query)
    {
        return $query->whereHas('role', function($query) { $query->where('slug', 'user');});
    }

    public function scopeAuthor($query)
    {
        return $query->whereHas('role', function($query) { $query->where('slug', 'author');});
    }

    /**
     * Get all users
     *
     * @return mixed
     */
    public static function getAllUsers($keyword,$status,$role_id,$publish_date,$sortColumn="id",$sortDirection="asc",$limit=20)
    {
        $users = User::select('id','avatar','role_id','name','email','status','updated_at','last_login_date','created_at');

        if(isset($keyword)||isset($status) || isset($publish_date) || isset($role_id))
        {
            if($keyword != null){
                $users = $users->where('name','LIKE','%'.$keyword.'%');
            }
            if($status != ''){
                if($status ==  'active')
                    $users = $users->where('status',1);
                else 
                    $users = $users->where('status',0);
            }
            if($role_id != ''){
                    $users = $users->where('role_id',$role_id);
            }
            if($publish_date != null){
                $users = $users->whereRaw('DATE(created_at) = ?', [$publish_date]);
            }
        }

        if($sortColumn == "role")
            $sortColumn = "role_id";

        return $users->with(['role'])
                        ->where('id', '!=', Auth::user()->id)
                        ->whereHas('role',function($query){
                            $query->where('slug', '!=', 'super-admin');
                        })
                        ->orderBy($sortColumn, $sortDirection);
    }

    public static function storeUser($role,$name,$email,$password,$status,$bio){
        return self::create([
            'role_id' => $role,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'status' => $status,
            'bio' => $bio,
            'created_ip' => ip()
        ]);
    }

    public static function updateUser($user,$role,$name,$email,$status,$bio){
        return $user->update([
            'role_id'  => $role,
            'name'     => $name,
            'email'    => $email,
            'status'   => $status,
            'bio' => $bio
        ]);
    }

    public static function updatePassword($user,$password){
        return $user->update(['password'=>Hash::make($password)]);
    }

    public static function getForSelect(){
        if(Cache::has('users.getForSelect')){
            return Cache::get('users.getForSelect');
        }else{
            $users = self::Active()
                            ->select('id','name')
                            ->where('id', '!=', Auth::user()->id)
                            ->whereHas('role',function($query){
                                $query->where('slug', '!=', 'super-admin');
                            })
                            ->latest('id')
                            ->get();
            Cache::put('users.getForSelect', $users, Carbon::now()->addHours(12));
            return $users;
        }
    }
    

    public static function getUsersIncreaseOverYear()
    { 
        // Define an array with month names for reference
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
            7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December',
        ];

        // Initialize the result array with zero values for each month
        $result = array_fill_keys($months, 0);

        // Get the count of users for each month in the current year
        $userCounts = self::User()
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as user_count'))
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Populate the result array with actual user counts
        foreach ($userCounts as $userCount) {
            $result[$months[$userCount->month]] = $userCount->user_count;
        }

        // Assuming $result is your array with month values

        $values = array_values($result);

        // Convert the PHP array to a JSON string
        return $jsonValues = json_encode($values);
    }

    public static function getAuthors($limit){
        if(Cache::has('authors')){
            return Cache::get('authors');
        }else{
            $authors = self::Active()
                            ->Author()
                            ->select('id','role_id','name','bio','avatar')
                            ->inRandomOrder()
                            ->take($limit)
                            ->get();
            Cache::put('authors', $authors, Carbon::now()->addDays(7));
            return $authors;
        }
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('users.all');
        Cache::forget('authors');
        Cache::forget('users.getForSelect');
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
