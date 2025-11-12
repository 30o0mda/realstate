<?php

namespace App\Models\BlogHashtag;

use App\Models\Blog\Blog;
use App\Models\BlogHashtagPivot\BlogHashtagPivot;
use App\Models\PropertyType\PropertyType;
use App\Models\SectionPropertyType\SectionPropertyType;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class BlogHashtag extends Model implements TranslatableContract
{
    protected $table = 'blog_hashtags';
    use Translatable;
    public $translatedAttributes = ['title',];

    protected $fillable = [
        'slug',
        'image',
        'alt',
        'is_active',
        'organization_id',
        'created_by',
    ];
    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_hashtag_pivot', 'blog_hashtag_id', 'blog_id');
    }
}
