<?php

namespace App\Models\ChooseUsFeature;

use App\Models\ChooseUsHome\ChooseUsHome;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ChooseUsFeature extends Model implements TranslatableContract
{
    protected $table = 'choose_us_features';

    use Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'image',
        'organization_id',
        'created_by',
        'choose_us_home_id',
    ];

    public function chooseUsHome()
    {
        return $this->belongsTo(ChooseUsHome::class);
    }


}
