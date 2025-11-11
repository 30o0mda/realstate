<?php

namespace App\Models\BlogHashtag;

use Illuminate\Database\Eloquent\Model;

class BlogHashtagTranslation extends Model
{
    protected $table = 'blog_hashtag_translations';
    public $timestamps = false;
    protected $fillable = ['title',];
}
