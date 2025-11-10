<?php

namespace App\Models\SectionPropertyType;

use App\Models\CategorySection\CategorySection;
use App\Models\PropertyType\PropertyType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionPropertyType extends Model
{
    use HasFactory;
    protected $table = 'category_section_property_types';

    protected $fillable = [
        'property_type_id',
        'category_section_id',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function categorySection()
    {
        return $this->belongsTo(CategorySection::class);
    }
}
