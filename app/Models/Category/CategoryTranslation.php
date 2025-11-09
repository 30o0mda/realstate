<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $table = 'category_translations';
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
}
