<?php

namespace App\Models\ChooseUsHome;

use App\Models\ChooseUsFeature\ChooseUsFeature;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ChooseUsHome extends Model implements TranslatableContract
{
    protected $table = 'choose_us_homes';

    use Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'image',
        'organization_id',
        'created_by',
    ];

    public function features()
    {
        return $this->hasMany(ChooseUsFeature::class);
    }
}
