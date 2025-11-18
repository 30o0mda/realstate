<?php

namespace App\Modules\GeneralData\Models\HeroSection;
use Illuminate\Database\Eloquent\Model;

class HeroSectionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
}
