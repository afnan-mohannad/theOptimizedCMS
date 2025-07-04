<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    public $fillable = ['heading1_text', 'heading2_text', 'button_text'];
    public $timestamps = false;
}
