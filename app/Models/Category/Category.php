<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    protected $table = 'categories';

    use Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'image',
    ];


}
