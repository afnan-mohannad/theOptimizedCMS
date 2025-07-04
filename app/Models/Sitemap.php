<?php

namespace App\Models;

use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sitemap extends Model
{
    use HasFactory;

    public static function getPagesSiteMap(){
        return Page::Active()->get();
    }
}
