<?php

namespace App\Models\BlogHashtagPivot;

use App\Models\Blog\Blog;
use App\Models\BlogCategory\BlogCategory;
use App\Models\BlogHashtag\BlogHashtag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogHashtagPivot extends Model
{
    use HasFactory;
    protected $table = 'blog_hashtag_pivot';

    protected $fillable = [
        'blog_id',
        'blog_hashtag_id',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function blogHashtag()
    {
        return $this->belongsTo(BlogHashtag::class);
    }
}
