<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    protected $table = 'blog_translations';
    public $timestamps = false;
    protected $fillable = ['title','meta_title','meta_description','description','subtitle'];
}
