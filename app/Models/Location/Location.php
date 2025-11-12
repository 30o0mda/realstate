<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Location extends Model implements TranslatableContract
{
    protected $table = 'locations';

    use Translatable;

    public $translatedAttributes = ['title',];
    protected $fillable = [
        'image',
        'parent_id',
        'code',
        'is_active',
        'organization_id',
        'created_by',
    ];

    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

}
