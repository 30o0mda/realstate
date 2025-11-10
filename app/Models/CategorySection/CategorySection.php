<?php

namespace App\Models\CategorySection;

use App\Models\PropertyType\PropertyType;
use App\Models\SectionPropertyType\SectionPropertyType;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class CategorySection extends Model implements TranslatableContract
{
    protected $table = 'category_sections';

    use Translatable;

    public $translatedAttributes = ['title', 'description'];

    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class, 'category_section_property_types', 'category_section_id', 'property_type_id');
    }

}
