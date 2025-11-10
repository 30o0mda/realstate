<?php

namespace App\Service\SectionPropertyType;
use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Requests\Location\FetchAllLocationRequest;
use App\Http\Resources\CategorySection\CategorySectionResource;
use App\Http\Resources\Location\LocationResource;
use App\Models\CategorySection\CategorySection;
use App\Models\Location\Location;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SectionPropertyTypeService
{
    public function __construct() {}

    public function attachCategorySectionPropertyType($data)
    {
        $section = CategorySection::find($data['category_section_id']);
        $section->propertyTypes()->sync($data['property_type_ids']);
        return new DataSuccess('Property type attached to category section successfully', CategorySectionResource::make($section));
    }
}
