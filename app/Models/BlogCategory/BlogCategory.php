<?php

namespace App\Models\BlogCategory;

use App\Models\Blog\Blog;
use App\Models\BlogCategoryPivot\BlogCategoryPivot;
use App\Models\PropertyType\PropertyType;
use App\Models\SectionPropertyType\SectionPropertyType;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class BlogCategory extends Model implements TranslatableContract
{
    protected $table = 'blog_categories';
    use Translatable;
    public $translatedAttributes = ['title',];

    protected $fillable = [
        'slug',
        'image',
        'alt',
        'is_active'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_category_pivot', 'blog_category_id', 'blog_id');
    }
}
