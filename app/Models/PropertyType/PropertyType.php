<?php

namespace App\Models\PropertyType;

use App\Models\CategorySection\CategorySection;
use App\Models\SectionPropertyType\SectionPropertyType;
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
        'organization_id',
        'created_by',
    ];

    public function categorySections()
    {
        return $this->belongsToMany(CategorySection::class, 'category_section_property_types', 'property_type_id', 'category_section_id');
    }

}
