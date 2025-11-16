<?php

namespace App\Models\ChooseUsFeature;

use Illuminate\Database\Eloquent\Model;

class ChooseUsFeatureTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
}
