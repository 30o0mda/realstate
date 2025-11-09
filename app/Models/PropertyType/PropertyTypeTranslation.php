<?php

namespace App\Models\PropertyType;

use Illuminate\Database\Eloquent\Model;

class PropertyTypeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
}
