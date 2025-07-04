<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id')->with('translations');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope a query to only include active pages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function incrementReadCount()
    {
        $this->reads++;
        return $this->save();
    }

    public static function storePost($locale,$title,$excerpt,$body,$category_id,$author_id,$status,$featured,$is_active,$created_at)
    {
        return self::create([
            'locale'=> $locale,
            'title'=> $title,
            'excerpt'=> $excerpt,
            'body'=> $body,
            'category_id'=> $category_id,
            'author_id'=> $author_id,
            'status'=> $status,
            'featured'=> $featured,
            'is_active' => $is_active,
            'created_at'=> $created_at
        ]);
    }

    public static function updatePost($post,$locale,$title,$excerpt,$body,$category_id,$author_id,$status,$featured,$is_active,$created_at)
    {
        return $post->update([
            'locale'=> $locale,
            'title' => $title,
            'excerpt' => $excerpt,
            'body' => $body,
            'category_id'=> $category_id,
            'author_id'=> $author_id,
            'status' => $status,
            'featured'=> $featured,
            'is_active' => $is_active,
            'created_at'=> $created_at,
            'updated_at'=> Carbon::now()
        ]);
    }

    public static function getAllPosts($keyword=null,$status=null,$is_active=null,$locale=null,$publish_date=null,$category_id,$category_slug,$limit=20,$sort='id',$direction='asc')
    {
        
        $posts = self::select('id','locale','title','status','is_active','updated_at','created_at','category_id','author_id')->with('category');

        if($keyword != null){
            $posts = $posts->where('title','like','%'.$keyword.'%')
                        ->orWhere('excerpt','like','%'.$keyword.'%')
                        ->orWhere('body','like','%'.$keyword.'%');
        }
        if($is_active != null){
            $posts = $posts->where('is_active',$is_active);
        }
        if($status != null){
            $posts = $posts->where('status',$status);
        }
        if($locale != null){
            $posts = $posts->where('locale',$locale);
        }
        if($publish_date != null){
            $posts = $posts->whereRaw('DATE(created_at) = ?', [$publish_date]);
        }
        if($category_id != null){
            $parentCategory = Category::with('children')->find($category_id);

            $allCategories = $parentCategory->children->pluck('id')->prepend($parentCategory->id)->toArray();

            $posts = $posts->whereIn('category_id',$allCategories);
        }
        if($category_slug != null){
            $parentCategory = Category::with('children')->where('slug',$category_slug)->first();

            $allCategories = $parentCategory->children->pluck('id')->prepend($parentCategory->id)->toArray();

            $posts = $posts->whereHas('category',function($query) use($allCategories){
                $query->whereIn('category_id', $allCategories);
            });
        }
        return $posts->orderBy($sort,$direction)->paginate($limit);
    }

    public static function getPublishedPostById($id)
    {
        if(Cache::tags('posts')->has('post_'.$id)){
            return Cache::tags('posts')->get('post_'.$id);
        }else{
            $post = self::Active()
                        ->Published()
                        ->where('id',$id)
                        ->with(['tags', 'category', 'author'])
                        ->first();
            Cache::tags('posts')->put('post_'.$id, $post, Carbon::now()->addHours(1));
            return $post;
        }
    }

    public static function getPostById($id)
    {
        if(Cache::tags('posts')->has('post_'.$id)){
            return Cache::tags('posts')->get('post_'.$id);
        }else{
            $post = self::where('id',$id)
                        ->with(['tags', 'category', 'author'])
                        ->first();
            Cache::tags('posts')->put('post_'.$id, $post, Carbon::now()->addHours(1));
            return $post;
        }
    }

    public static function getLatestPostsByCategory($slug,$limit=4)
    {
        $parentCategory = Category::with('children')->where('slug',$slug)->first();

        $allCategories = $parentCategory->children->pluck('id')->prepend($parentCategory->id)->toArray();

        if(Cache::tags('posts')->has('latest_posts_'.$slug)){
            return Cache::tags('posts')->get('latest_posts_'.$slug);
        }else{
            $posts = self::select('id','title','picture','cover_picture','created_at','category_id')
                            ->Active()
                            ->Published()
                            ->where('locale',lang())
                            ->whereHas('category', function($query) use($allCategories){
                                $query->whereIn('category_id', $allCategories);
                            })
                            ->latest('id')
                            ->with('category')
                            ->take($limit)
                            ->get();
            Cache::tags('posts')->put('latest_posts_'.$slug, $posts, Carbon::now()->addMinutes(10));
            return $posts;
        }
    }

    public static function getPostsByCategory($slug,$limit=4,$page=1,$excluded_ids=[])
    {
        $parentCategory = Category::with('children')->where('slug',$slug)->first();

        $allCategories = $parentCategory->children->pluck('id')->prepend($parentCategory->id)->toArray();

        if(Cache::tags('posts')->has('page_'.$page.'_latest_posts_'.$slug)){
            return Cache::tags('posts')->get('page_'.$page.'_latest_posts_'.$slug);
        }else{
            $posts = self::select('id','title','picture','cover_picture','created_at','category_id')
                        ->Active()
                        ->Published()
                        ->whereNotIn('id', $excluded_ids)
                        ->where('locale',lang())
                        ->whereHas('category', function($query) use($allCategories){
                            $query->whereIn('category_id', $allCategories);
                        })
                        ->latest('id')
                        ->with('category')
                        ->paginate($limit);
            Cache::tags('posts')->put('page_'.$page.'_latest_posts_'.$slug, $posts, Carbon::now()->addHours(1));
            return $posts;
        }
    }

    public static function getMostPopular($limit)
    {
        if(Cache::has('most_popular_posts')){
             return Cache::get('most_popular_posts');
        }else{
            $posts = self::select('id','title','category_id','created_at')
                            ->Active()
                            ->Published()
                            ->where('locale',lang())
                            ->orderBy('reads', 'desc')
                            ->whereYear('created_at', Carbon::now()->year)
                            //->whereMonth('created_at', Carbon::now()->month)
                            ->with('category')
                            ->take($limit)
                            ->get();
            Cache::add('most_popular_posts', $posts, Carbon::now()->addMinutes(10));
            return $posts;
        }
    }

    public static function getEditorsPicks($limit)
    {
        if(Cache::has('editors_picks')){
            return Cache::get('editors_picks');
        }else{
            $posts = self::select('id','category_id','title','picture','created_at')
                        ->Active()
                        ->Published()
                        ->Featured()
                        ->where('locale',lang())
                        ->whereHas('category', function($query){ $query->where('slug', 'articles');})
                        ->inRandomOrder()
                        ->with('category')
                        ->take($limit)
                        ->get();
            Cache::add('editors_picks', $posts, Carbon::now()->addMinutes(1));
            return $posts;
        }
    }

    public static function getCount()
    {
        if(Cache::get('posts.count')){
            return Cache::get('posts.count');
        }else{
            $count = self::Active()->count();
            Cache::put('posts.count', $count, Carbon::now()->addDays(7));
            return $count;
        }
    }

    public static function getOtherPosts($id,$category,$type)
    {
        if($type=='previous'){
            return self::Active()
                        ->Published()
                        ->where('id', '<' , $id)
                        ->whereHas('category',function($query) use($category){$query->where('slug', $category);})
                        ->select('id', 'title', 'category_id', 'created_at')
                        ->first();
        }else{
            return self::Active()
                        ->Published()
                        ->where('id', '>' , $id)
                        ->whereHas('category',function($query) use($category){$query->where('slug', $category);})
                        ->select('id', 'title', 'category_id','created_at')
                        ->first();
        }
    }

    public static function getSearchResult($keyword,$limit){
        $searchValues = preg_split('/\s+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);
        return self::select('id','locale','title','category_id','created_at')
                    ->where(function ($query) use ($searchValues) {
                        foreach ($searchValues as $value) {
                        $query->where('title', 'like', "%{$value}%")
                            ->orWhere('excerpt', 'like', "%{$value}%")
                            ->orWhere('body', 'like', "%{$value}%");
                        }
                    })
                    ->orWhereHas('category', function($query) use($keyword){
                        $query->where('slug')
                              ->orWhereHas('translations', function($query) use($keyword){
                                    $query->where('name', 'like', "%{$keyword}%")
                                          ->orWhere('description', 'like', "%{$keyword}%");
                              });
                    })
                    ->orWhereHas('tags', function($query) use($keyword){
                        $query->where('slug', 'like', "%{$keyword}%");
                    })
                    ->with('category')
                    ->paginate($limit);
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::flush('posts.count');
        Cache::flush('most_popular_posts');
        Cache::tags('posts')->flush();
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
