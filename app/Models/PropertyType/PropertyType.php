<?php

namespace App\Models\PropertyType;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class PropertyType extends Model implements TranslatableContract
{
    protected $table = 'property_types';

    use Translatable;

    public $translatedAttributes = ['title'];
    protected $fillable = [
        'image',
        'is_active',
    ];


}
