<?php

namespace App\Models\BlogCategoryPivot;

use App\Models\Blog\Blog;
use App\Models\BlogCategory\BlogCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryPivot extends Model
{
    use HasFactory;
    protected $table = 'blog_category_pivot';

    protected $fillable = [
        'blog_id',
        'blog_category_id',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }
}
