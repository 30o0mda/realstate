<?php

namespace App\Models\Blog;

use App\Models\BlogCategory\BlogCategory;
use App\Models\BlogCategoryPivot\BlogCategoryPivot;
use App\Models\BlogHashtag\BlogHashtag;
use App\Models\BlogHashtagPivot\BlogHashtagPivot;
use App\Models\PropertyType\PropertyType;
use App\Models\SectionPropertyType\SectionPropertyType;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Blog extends Model implements TranslatableContract
{
    protected $table = 'blogs';
    use Translatable;
    public $translatedAttributes = ['title','description','subtitle','meta_title','meta_description'];

    protected $fillable = [
        'slug',
        'image',
        'alt',
        'is_active',
        'organization_id',
        'created_by',
    ];
    public function blogCategories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_pivot', 'blog_id', 'blog_category_id');
    }

    public function blogHashtags()
    {
        return $this->belongsToMany(BlogHashtag::class, 'blog_hashtag_pivot', 'blog_id', 'blog_hashtag_id');
    }

}
