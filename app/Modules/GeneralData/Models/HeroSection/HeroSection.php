<?php

namespace App\Modules\GeneralData\Models\HeroSection;

use App\Modules\Organization\Models\Organization\Organization;
use App\Modules\Organization\Models\organizationEmployee\OrganizationEmployee;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class HeroSection extends Model implements TranslatableContract
{
    protected $table = 'hero_sections';

    use Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'image',
        'organization_id',
        'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(OrganizationEmployee::class,'created_by');
    }


}
