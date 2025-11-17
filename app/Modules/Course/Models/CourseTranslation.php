<?php

namespace App\Modules\Course\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class CourseTranslation extends Model
{
    protected $table = 'course_translations';
    protected $fillable = ['title', 'description'];
}
