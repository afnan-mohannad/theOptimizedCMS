<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    public $fillable = ['title','excerpt','body'];
    public $timestamps = false;
}
