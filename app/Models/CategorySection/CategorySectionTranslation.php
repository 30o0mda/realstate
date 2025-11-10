<?php

namespace App\Models\CategorySection;

use Illuminate\Database\Eloquent\Model;

class CategorySectionTranslation extends Model
{
    protected $table = 'category_section_translations';
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
}
