<?php

namespace App\Modules\Course\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class Course extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title', 'description'];
    public $translationForeignKey='course_id';
    protected $table = 'courses';

    protected $fillable = [
        'image',
    ];
}
