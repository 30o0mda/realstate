<?php

namespace App\Models\PostHome;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class PostHome extends Model implements TranslatableContract
{
    protected $table = 'post_homes';

    use Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'image',
        'organization_id',
        'created_by',
    ];


}
