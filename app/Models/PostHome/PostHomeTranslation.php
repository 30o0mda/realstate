<?php

namespace App\Models\PostHome;

use Illuminate\Database\Eloquent\Model;

class PostHomeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
}
